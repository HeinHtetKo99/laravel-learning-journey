@extends('admin.layouts.app')

@section('title','Reset Password User')

@section('style')
    <style>
    </style>

@section('header','Reset Password User')

@section('content')
    <a href="{{ url('/admin/users') }}" class="btn btn-primary">
        <i class="bi bi-arrow-left me-1"></i>
        Back
     </a>
     
    <form action="{{ url('/admin/users/reset-password/'.$data->id) }}" method="post" novalidate>
        @csrf()
        <input type="email" name="email" value="{{ $data->email }}" autocomplete="username" hidden>
        
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" autofocus autocomplete="new-password">
            @if($errors->has('password'))
                <p class="text-danger">{{ $errors->first('password') }}</p>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Password Confirmation</label>
            <input type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
            @if($errors->has('password_confirmation'))
                <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
            @endif
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-shield-lock-fill"></i>
                Reset Password
            </button>
        </div>
    </form>
    
@endsection

@section('script')
        <script>
        </script>
@endsection