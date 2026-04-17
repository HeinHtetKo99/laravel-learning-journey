@extends('admin.layouts.app')

@section('title','page4')

@section('style')
    <style>
        h1{
            background-color : orange;
            color : white ; 
            text-align : center;
            padding : 10px
        }
    </style>

@section('header','page4')

@section('content')
    <h1>This is page4.</h1>
@endsection

@section('script')
        <script>
            console.log('This is page4.')
        </script>
@endsectio4