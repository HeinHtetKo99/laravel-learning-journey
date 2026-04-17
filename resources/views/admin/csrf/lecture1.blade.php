@extends('admin.layouts.app')

@section('title','lecture1')

@section('style')
    <style>
        h1{
            background-color : orange;
            color : white ; 
            text-align : center;
            padding : 10px
        }
    </style>

@section('header','lecture1')

@section('content')
    <h1>This is CSRF lecture1.</h1>
    <form action="{{ url('/admin/csrf/create') }}" method="post">
        @csrf()
        <div class="mb-2">
            <label class="form-label" >Enter Name</label>
            <input class="form-control" type="text" name="name" required>
        </div>
         <div class="mb-2">
            <label class="form-label" >Enter Age</label>
            <input class="form-control" type="text" name="age" required>
        </div>
        <button class="btn btn-primary mt-2">Submit</button>
    </form>
@endsection

@section('script')
        <script>
            console.log('This is lecture1.')
        </script>
@endsection