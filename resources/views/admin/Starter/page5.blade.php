@extends('admin.layouts.app')

@section('title','page5')

@section('style')
    <style>
        h1{
            background-color : orange;
            color : white ; 
            text-align : center;
            padding : 10px
        }
    </style>

@section('header','page5')

@section('content')
    <h1>This is page5.</h1>
@endsection

@section('script')
        <script>
            console.log('This is page5.')
        </script>
@endsection