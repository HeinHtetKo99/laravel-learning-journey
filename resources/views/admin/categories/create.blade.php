@extends('admin.layouts.app')

@section('title','Create Category')

@section('style')
    <style>
    </style>

@section('header','Create Category')

@section('content')
    <a href="{{ url('/admin/categories') }}" class="btn btn-primary">
        <i class="bi bi-arrow-left me-1"></i>
        Back
     </a>
     
    <form action="{{ url('/admin/categories') }}" method="post" novalidate>
        @csrf()
        <div class="mb-3">
            <label class="form-label">Category Name</label>
            <input type="text" class="form-control" name="category_name" autofocus value="{{ old('category_name') }}">
            @if($errors->has('category_name'))
                <p class="text-danger">{{ $errors->first('category_name') }}</p>
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