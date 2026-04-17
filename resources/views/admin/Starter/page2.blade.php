@extends('admin.layouts.app')

@section('title','page2')

@section('style')
    <style>
        h1{
            background-color : black;
            color : white ; 
            text-align : center;
            padding : 10px
        }
    </style>

@section('header','page2')

@section('content')
    <h1>This is page2.</h1>
@endsection

@section('script')
        <script>
            console.log('This is page2.')
        </script>
@endsection