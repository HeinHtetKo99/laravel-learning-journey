@extends('admin.layouts.app')

@section('title','Create User')

@section('style')
    <style>
    </style>

@section('header','Create User')

@section('content')
    <a href="{{ url('/admin/brands') }}" class="btn btn-primary">
        <i class="bi bi-arrow-left me-1"></i>
        Back
     </a>
     
    <form action="{{ url('/admin/brands') }}" method="post" novalidate>
        @csrf()
        <div class="mb-3">
            <label class="form-label">Brand Name</label>
            <input type="text" class="form-control" name="brand_name" autofocus value="{{ old('brand_name') }}">
            @if($errors->has('brand_name'))
                <p class="text-danger">{{ $errors->first('brand_name') }}</p>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <input type="text" class="form-control" name="description" autofocus value="{{ old('description') }}">
            @if($errors->has('description'))
                <p class="text-danger">{{ $errors->first('description') }}</p>
            @endif
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i>
                Save
            </button>
        </div>
    </form>
    
@endsection

@section('script')
        <script>
        </script>
@endsection