@extends('layouts.app')
@section('title', 'Edit Product')
@section('content')
<div class="container">
            <h1>Edit Product</h1>
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <input type="hidden" name="id" value="{{ $product->id }}">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $product->description) }}">
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}">
                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="text" class="form-control" id="stock" name="stock" value="{{ old('stock', $product->stock) }}">
                    @error('stock')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> 
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" id="category" name="category_id">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="images">Image</label>
                    <input type="file" class="form-control" id="images" name="images">
                    @if ($product->images)
                        <div class="mt-2">
                            <img src="{{ asset('uploads/products/' . $product->images) }}" alt="Product Photo" class="img-fluid" style="max-width: 150px; height: auto;">
                        </div>
                    @endif
                    @error('images')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>                
                <button type="submit" class="btn btn-success">Update</button>
            </form>
</div>
@endsection
