@extends('layouts.app')
@section('title', 'Edit Banner')
@section('content')
<div class="container">
            <h1>Edit Banner</h1>
            <form action="{{ route('banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <input type="hidden" name="id" value="{{ $banner->id }}">
                
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $banner->description) }}">
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="btn_text">Button Text</label>
                    <input type="text" class="form-control" id="btn_text" name="btn_text" value="{{ old('btn_text', $banner->btn_text) }}">
                    @error('btn_text')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="btn_link">Button Link</label>
                    <input type="text" class="form-control" id="btn_link" name="btn_link" value="{{ old('btn_link', $banner->btn_link) }}">
                    @error('btn_link')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image">banner Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @if ($banner->image)
                        <div class="mt-2">
                            <img src="{{ asset('uploads/banner/' . $banner->image) }}" alt="banner Image" class="img-fluid" style ="max-width: 150px; height: auto;">
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
