@extends('layouts.app')
@section('title', 'Add Banner')
@section('content')
    <div class="container">
        <h2> Add New Banner</h2>
        <form id="registerForm" method="POST" action="{{ route('banners.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}">
                @if ($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="btn_text">Button Text</label>
                <input type="text" class="form-control" id="btn_text" name="btn_text" value="{{ old('btn_text') }}">
                @if ($errors->has('btn_text'))
                    <span class="text-danger">{{ $errors->first('btn_text') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="btn_link">Button Link</label>
                <input type="text" class="form-control" id="btn_link" name="btn_link" value="{{ old('btn_link') }}">
                @if ($errors->has('btn_link'))
                    <span class="text-danger">{{ $errors->first('btn_link') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" name="image">
                @if ($errors->has('image'))
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
@endsection
