<?php

namespace App\Interfaces;

interface InventoryRepositoryInterface
{
    public function getAllInventory();
    public function getInventoryById($id);
    public function createInventory(array $data);
    public function updateInventory($id, array $data);
    public function deleteInventory($id);
    public function updateInventoryStatus($id, $status);
}