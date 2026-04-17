@extends('admin.layouts.app')

@section('title','lecture2')

@section('style')
    <style>
        h1{
            background-color : orange;
            color : white ; 
            text-align : center;
            padding : 10px
        }
    </style>

@section('header','lecture2')

@section('content')
    <h1>This is lecture2.</h1>
    <form action="{{ url('/admin/csrf/create') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
            console.log('This is lecture2.')
        </script>
@endsection