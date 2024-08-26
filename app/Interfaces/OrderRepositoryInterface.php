<?php

namespace App\Interfaces;

interface OrderRepositoryInterface
{
    public function getAllOrders();
    public function getOrderById($id);
    public function createOrder(array $data);
    public function updateOrder($id, array $data);
    public function deleteOrder($id);
    public function updateOrderStatus($id, $status);
}