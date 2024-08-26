@extends('layouts.app')
@section('title', 'Inventory')
@section('content')
<div class = "container">
    <h2>Inventory Listing</h2>
    <div class = "text-end">
        <a href = "{{ route('inventory.create') }}" class = "btn btn-primary">Add New Inventory</a>
    </div>
    <br>
    <div>
        <table id = "inventory-table" class = "table table-bordered display stripe" cellspacing = "0" width = "100%" style = "text-align: center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inventories as $index => $inventory)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $inventory->quantity }}</td>
                    <td>
                        @if($inventory->status == 1)
                            <span class = "badge badge-success" >Active</span>
                        @else
                            <span class = "badge badge-danger">In-Acive</span>
                        @endif
                    </td>
                    <td>
                        <a href = "{{ route('inventory.show', $inventory->id) }}" class = "btn btn-sm btn-info" title = "Details"><i class = "fa fa-eye"></i></a> <span style = "color:grey">|</span>
                        <a href = "{{ route('inventory.edit', $inventory->id) }}" class = "btn btn-sm btn-primary" title = "Edit"><i class ="fa fa-pen"></i></a> <span style = "color:grey">|</span>
                        <form action = "{{ route('inventory.destroy', $inventory->id) }}" method = "POST" style = "display: inline">
                            @csrf
                            @method('DELETE')
                            <button type = "submit" class = "btn btn-sm btn-danger" title = "Delete" onclick = "return confirm('Are you sure you want to delete this inventory?');">
                                <i class = "fa fa-trash"></i>
                            </button>
                        </form> <span style="color: grey">|</span>
                        @if($inventory->status == 1)
                            <a href = "{{ route('inventory.updateStatus', ['$id' => $inventory->$id, 'status' => 0]) }}" class = "btn btn-sm btn-danger" title = "In-Active" onclick = "return confirm('Are you sure you want to de-active this inventory?')"
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>