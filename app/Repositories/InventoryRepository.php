<?php

namespace App\Repositories;

use App\Models\Inventory;

class InventoryRepository implements InventoryRepositoryInterface
{
    public function getAllInventory()
    {
        $inventory = Inventory::orderBy('id', 'desc')->get();
        return $inventory;
    }
    public function getInventoryById($id)
    {
        $inventory = Inventory::findOrFail($id);
        return $inventory;
    }
    public function createInventory(array $data)
    {
        $inventory = new Inventory();
        $inventory->quantity = $data['quantity'];
        $inventory->save();
        return $inventory;
    }
    public function updateInventory($id, array $data)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->quantity = $data['quantity'];
        $inventory->save();
        return $inventory;
    }
    public function deleteInventory($id)
    {
        $inventory = Inventory::findOrFail($id);
        if($inventory)
        {
            $inventory->delete();
        }
        return $inventory;
    }
    public function updateInventoryStatus($id, $status)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->status = $status;
        $inventory->save();
        return $inventory;
    }
}