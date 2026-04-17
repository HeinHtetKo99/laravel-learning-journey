@extends('admin.layouts.app')

@section('title','Edit User')

@section('style')
    <style>
    </style>

@section('header','Edit User')

@section('content')
    <a href="{{ url('/admin/users') }}" class="btn btn-primary">
        <i class="bi bi-arrow-left me-1"></i>
        Back
     </a>
     
    <form action="{{ url('/admin/users/'.$data->id) }}" method="post" novalidate>
        @method('PUT')
        @csrf()
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" autofocus value="{{ old('name',$data->name) }}">
            @if($errors->has('name'))
                <p class="text-danger">{{ $errors->first('name') }}</p>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" autofocus value="{{ old('email',$data->email) }}">
            @if($errors->has('email'))
                <p class="text-danger">{{ $errors->first('email') }}</p>
            @endif
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-pencil-fill me-1"></i>
                Save
            </button>
        </div>
    </form>
    
@endsection

@section('script')
        <script>
        </script>
@endsection