<?php

namespace App\Repositories;

use App\Models\Order;
use App\Interfaces\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function getAllOrders()
    {
        $orders = Order::orderBy('id', 'desc')->get();
        return $orders;
    }
    public function getOrderById($id)
    {
        $order = Order::findOrFail($id);
        return $order;
    }
    public function createOrder(array $data)
    {
        $order = new Order();
        $order->order_details = $data['order_details'];
        $order->payment_information = $data['payment_information'];
        $order->save();
        return $order;
    }
    public function updateOrder($id, array $data)
    {
        $order = Order::findOrFail($id);
        $order->order_details = $data['order_details'];
        $order->payment_information = $data['payment_information'];
        $order->save();
        return $order;
    }
    public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);
        if($order)
        {
            $order->delete();
        }
        return $order;
    }
    public function updateOrderStatus($id, $status)
    {
        $order = Order::findOrFail($id);
        $order->status = $status;
        $order->save();
        return $order;
    }
}