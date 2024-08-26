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
        $orders = $this->orderRepository->getAllOrders();
        return view('backend.order.order', compact('orders'));
    }
    public function create()
    {
        return view('backend.order.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'order_details' => 'required|max:255|string',
            'payment_information' => 'required|max:255|string',
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
        $order = $this->orderRepository->getOrderById($id);
        return view('backend.order.show',compact('order'));
    }
    public function edit($id)
    {
        $order = $this->orderRepository->getOrderById($id);
        return view('backend.order.edit',compact('order'));
    }
    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'order_details' => 'required|max:255|string',
            'payment_information' => 'required|max:255|string',
        ]);
        $this->orderRepository->updateOrder($id, $request->all());
        return redirect()->route('orders.index')->with('success', 'Order updated successfully!');
    }
    public function destroy($id)
    {
        $order = $this->orderRepository->deleteOrder($id);
        if(!$order)
        {
            return redirect()->route('orders.index')->with('error', 'Order not found.');
        }
        return redirect()->route('orders.index')->with('success', 'Order Deleted Successfully!');
    }
    public function updateStatus($id, $status)
    {
        $order = $this->orderRepository->updateOrderStatus($id, $status);
        return redirect()->route('orders.index')->with('success', $status == 1 ? 'Order Activated Successfully!':'Order Deactivated Successfully!');
    }
}
