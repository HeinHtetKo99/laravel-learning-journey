@extends('admin.layouts.app')

@section('title','Test-Middleware')

@section('style')

@section('header','Test-Middleware')

@section('content')
    <form action="{{ url('/admin/routing/test-middleware') }}" method="post">
        @csrf()
        <label class="form-label">Age</label>
        <input type="number" name="age" class="form-control mb-3">
        <button class="btn btn-primary" type="submit">Send Request</button>
    </form>
@endsection

@section('script')
        <script>
           
        </script>
@endsection