@extends('layouts.app')
@section('title', 'Banner Details')
@section('content')
<div id="page-top">
    <div id="wrapper">
        <div class="container mt-5">
            <h2>Banner Details</h2>
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
                                    <td><strong>Description</strong></td>
                                    <td>{{ $banner->description }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Button Text</strong></td>
                                    <td>{{ $banner->btn_text }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Button Link</strong></td>
                                    <td>{{ $banner->btn_link }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Image</strong></td>
                                    <td>
                                        @if($banner->image)
                                            <img src="{{ asset('uploads/banner/' . $banner->image) }}" alt="Banner Image" class="img-fluid" style="width: 50px; height: 50px; object-fit: cover;">
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
                <a href="{{ route('banners.index') }}" class="btn btn-success">Back to Banners</a>
            </div>
        </div>
    </div>
</div>
@endsection
