@extends('admin.layouts.app')

@section('title','page3')

@section('style')
    <style>
        h1{
            background-color : orange;
            color : white ; 
            text-align : center;
            padding : 10px
        }
    </style>

@section('header','page3')

@section('content')
    <h1>This is page3.</h1>
@endsection

@section('script')
        <script>
            console.log('This is page3.')
        </script>
@endsectio3