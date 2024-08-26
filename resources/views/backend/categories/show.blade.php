@extends('layouts.app')
@section('title', 'Category Details')
@section('content')
<div id="page-top">
    <div id="wrapper">
        <div class="container mt-5">
            <h2>Category Details</h2>
            <div class="row justify-content-center m-t-30">
                <div class="col-md-7">
                    <div class="table-responsive m-b-30">
                        <table class="table table-borderless table-data3 mx-auto">
                            <thead>
                                <th>Field</th>
                                <th>Value</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Name</strong></td>
                                    <td>{{ $category->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Description</strong></td>
                                    <td>{{ $category->description }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Image</strong></td>
                                    <td>
                                        @if($category->image)
                                            <img src="{{ asset('uploads/category/' . $category->image) }}" alt="Category Image" class="img-fluid" style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('categories.index') }}" class="btn btn-success">Back to categories</a>
            </div>
        </div>
    </div>
</div>
@endsection
