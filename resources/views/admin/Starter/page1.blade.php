@extends('admin.layouts.app')

@section('title','page1')

@section('style')
    <style>
        h1{
            background-color : orange;
            color : white ; 
            text-align : center;
            padding : 10px
        }
    </style>

@section('header','page1')

@section('content')
    <h1>This is page1.</h1>
    <p>Name: {{ session()->has('name')? session()->get('name') : '' }}</p>
@endsection

@section('script')
        <script>
            console.log('This is page1.')
        </script>
@endsection