@extends('admin.layouts.app')

@section('title','Show Category')

@section('style')
    <style>
    </style>

@section('header','Show Category')

@section('content')
    <a href="{{ url('/admin/categories') }}" class="btn btn-primary">
        <i class="bi bi-arrow-left me-1"></i>
        Back
     </a>
     
    <div class="card mt-3">
        <div class="card-header">
            Category Details
        </div>
        <div class="card-body">
            <p class="card-text">
                <strong>Category Name:</strong> {{ $data->category_name }}
            </p>
            <p class="card-text">
                <strong>Description:</strong> {{ $data->description }}
            </p>
            <p class="card-text">
                <strong>Created At:</strong> {{ $data->created_at }}
            </p>
            <p class="card-text">
                <strong>Updated At:</strong> {{ $data->updated_at }}
            </p>
        </div>
    </div>
    
@endsection

@section('script')
        <script>
        </script>
@endsection