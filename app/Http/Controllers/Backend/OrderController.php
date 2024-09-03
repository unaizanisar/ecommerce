<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\OrderRepositoryInterface;
use App\Http\Requests\OrderSaveRequest;
use App\Http\Requests\OrderUpdateRequest;


class OrderController extends Controller

{
    protected $orderRepository;
    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
    public function list()
    {
        return $this->orderRepository->getAllOrders();
    }
    public function index()
    {
        if (!auth()->user()->hasPermission('Order Listing')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to view Orders Listing!');
        }
        $orders = $this->orderRepository->getAllOrders();
        return view('backend.order.order', compact('orders'));
    }
    public function create()
    {
        if (!auth()->user()->hasPermission('Order Add')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to Add new Orders!');
        }
        return view('backend.order.create');
    }
    public function store(OrderSaveRequest $request)
    {
        if (!auth()->user()->hasPermission('Order Add')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to Add new Orders!');
        }
        
        $data = $request->all();
        $this->orderRepository->createOrder($data);
        return redirect()->route('orders.index')->with('success', 'Order Added Successfully!');
    }
    public function show($id)
    {
        if (!auth()->user()->hasPermission('Order Detail')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to view Order Details!');
        }
        $order = $this->orderRepository->getOrderById($id);
        return view('backend.order.show',compact('order'));
    }
    public function edit($id)
    {
        if (!auth()->user()->hasPermission('Order Edit')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to Edit Orders!');
        }
        $order = $this->orderRepository->getOrderById($id);
        return view('backend.order.edit',compact('order'));
    }
    public function update($id, OrderUpdateRequest $request)
    {
        if (!auth()->user()->hasPermission('Order Edit')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to Edit Orders!');
        }

        $this->orderRepository->updateOrder($id, $request->all());
        return redirect()->route('orders.index')->with('success', 'Order updated successfully!');
    }
    public function destroy($id)
    {
        if (!auth()->user()->hasPermission('Order Delete')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to Delete Orders!');
        }
        $order = $this->orderRepository->deleteOrder($id);
        if(!$order)
        {
            return redirect()->route('orders.index')->with('error', 'Order not found.');
        }
        return redirect()->route('orders.index')->with('success', 'Order Deleted Successfully!');
    }
    public function updateStatus($id, $status)
    {
        if (!auth()->user()->hasPermission('Order Change Status')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to Change Order Status!');
        }
        $order = $this->orderRepository->updateOrderStatus($id, $status);
        return redirect()->route('orders.index')->with('success', 'Order status updated successfully!');
    }
}
