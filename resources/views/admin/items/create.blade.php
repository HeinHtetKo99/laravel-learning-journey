@extends('admin.layouts.app')

@section('title','Create Item')

@section('style')
    <style>
    </style>

@section('header','Create Item')

@section('content')
    <a href="{{ url('/admin/items') }}" class="btn btn-primary">
        <i class="bi bi-arrow-left me-1"></i>
        Back
     </a>

    <form action="{{ url('/admin/items') }}" method="post" enctype="multipart/form-data" novalidate class="mt-3">
        @csrf()

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Item Name</label>
                    <input type="text" class="form-control" name="item_name" autofocus value="{{ old('item_name') }}">
                    @if($errors->has('item_name'))
                        <p class="text-danger">{{ $errors->first('item_name') }}</p>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Item Code</label>
                    <input type="text" class="form-control" name="item_code" value="{{ old('item_code') }}">
                    @if($errors->has('item_code'))
                        <p class="text-danger">{{ $errors->first('item_code') }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Brand</label>
                    <select class="form-select" name="brand_id">
                        <option value="">Select brand</option>
                        @foreach(($brands ?? []) as $brand)
                            <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                {{ $brand->brand_name }}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('brand_id'))
                        <p class="text-danger">{{ $errors->first('brand_id') }}</p>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select class="form-select" name="category_id">
                        <option value="">Select category</option>
                        @foreach(($categories ?? []) as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('category_id'))
                        <p class="text-danger">{{ $errors->first('category_id') }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" class="form-control" name="price" step="0.01" value="{{ old('price') }}">
                    @if($errors->has('price'))
                        <p class="text-danger">{{ $errors->first('price') }}</p>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Item Image</label>
                    <input type="file" class="form-control" name="item_image" accept="image/*">
                    @if($errors->has('item_image'))
                        <p class="text-danger">{{ $errors->first('item_image') }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
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
