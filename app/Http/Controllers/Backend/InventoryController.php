<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\InventoryRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class InventoryController extends Controller
{
    protected $inventoryRepository;
    public function __construct(InventoryRepositoryInterface $inventoryRepository)
    {
        $this->inventoryRepository = $inventoryRepository;
    }

    public function list()
    {
        return $this->inventoryRepository->getAllInventory();
    }

    public function index()
    {
        $inventory = $this->inventoryRepository->getAllInventory();
        return view('backend.inventory.inventory');
    }

    public function create()
    {
        return view('backend.inventory.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'quantity' => 'numeric|integer|max:100',
        ]);
        if($validator->fails())
        {
            return back()->withErrors('$validator')->withInput();
        }
        $data = $request->all();
        $this->inventoryRepository->createInventory($data);
        return redirect()->route('inventory.index')->with('success','Inventory Added Successfully!');
    }

    public function edit($id)
    {
        return view('backend.inventory.edit');
    }
    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'quantity' => 'numeric|integer|max:100',
        ]);
        $data = $request->all();
        $this->inventoryRepository->updateInventory($id, $data);
        return redirect()->route('inventory.index')->with('success', 'Inventory Updated Successfully!');
    }
    public function show($id)
    {
        $inventory = $this->inventoryRepository->getInventoryById($id);
        return view('backend.inventory.show', compact('inventory'));
    }
    public function destroy($id)
    {
        $inventory = $this->inventoryRepository->getInventoryById($id);
        if(!$inventory)
        {
        return redirect()->route('inventory.index')->with('error', 'Inventory not found!');
        }
        return redirect()->route('inventory.index')->with('success', 'Inventory Deleted Successfully!');
    }
    public function updateStatus($id, $status)
    {
        $inventory = $this->inventoryRepository->getInventoryById($id);
        return redirect()->route('inventory.index')->with('success', $status==1 ? 'Status Activated Successfully!' : 'Status De-Activated Successfully!');
    }
}
