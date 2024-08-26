@extends('layouts.app')
@section('title', 'Edit Category')
@section('content')
<div class="container">
            <h1>Edit Category</h1>
            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <input type="hidden" name="id" value="{{ $category->id }}">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $category->description) }}">
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image">Category Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @if ($category->image)
                        <div class="mt-2">
                            <img src="{{ asset('uploads/category/' . $category->image) }}" alt="Category Image" class="img-fluid" style ="max-width: 150px; height: auto;">
                        </div>
                    @endif
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Update</button>
            </form>
</div>
@endsection
