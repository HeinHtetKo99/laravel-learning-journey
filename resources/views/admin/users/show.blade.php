@extends('admin.layouts.app')

@section('title','Show User')

@section('style')
    <style>
    </style>

@section('header','Show User')

@section('content')
    <a href="{{ url('/admin/users') }}" class="btn btn-primary">
        <i class="bi bi-arrow-left me-1"></i>
        Back
     </a>
     
    <div class="card mt-3">
        <div class="card-header">
            User Details
        </div>
        <div class="card-body">
            <p class="card-text">
                <strong>Name:</strong> {{ $data->name }}
            </p>
            <p class="card-text">
                <strong>Email:</strong> {{ $data->email }}
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