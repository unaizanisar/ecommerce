<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\OrderRepositoryInterface;
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
    public function store(Request $request)
    {
        if (!auth()->user()->hasPermission('Order Add')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to Add new Orders!');
        }
        $validator = Validator::make($request->all(),[
            'firstname' => 'required|max:255|string',
            'lastname' => 'required|max:255|string',
            'email' => 'required|max:255|string',
            'city' => 'required|max:255|string',
            'postal_code' => 'required|max:255|string',
            'address' => 'required|max:255|string',
            'phone' => 'required|max:255|string',
            'total' => 'required|max:255|string',
        ]);
        if($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
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
    public function update($id, Request $request)
    {
        if (!auth()->user()->hasPermission('Order Edit')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to Edit Orders!');
        }
        $validatedData = $request->validate([
            'firstname' => 'required|max:255|string',
            'lastname' => 'required|max:255|string',
            'email' => 'required|max:255|string',
            'city' => 'required|max:255|string',
            'postal_code' => 'required|max:255|string',
            'address' => 'required|max:255|string',
            'phone' => 'required|max:255|string',
            'total' => 'required|max:255|string',
        ]);
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
        return redirect()->route('orders.index')->with('success', $status == 1 ? 'Order Activated Successfully!':'Order Deactivated Successfully!');
    }
}
