@extends('admin.layouts.app')

@section('title','View Only')

@section('style')
    <style>
        h1{
            background-color : black;
            color : white ; 
            text-align : center;
            padding : 10px
        }
    </style>

@section('header','View Only')

@section('content')
    <h1>This is View Only.</h1>
@endsection

@section('script')
        <script>
            console.log('This is View Only.')
        </script>
@endsection