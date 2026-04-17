@extends('admin.layouts.app')

@section('title','Passing Parameter')

@section('style')
    <style>
        .box{
            width: 200px;
            height: 200px;
            background-color : {{ $backgroundColor }};
        }
        .text{
            color: {{ $textColor }}
        }
    </style>

@section('header','Passing Parameter')

@section('content')
    <h1 class="text">This color is passed by using route parameter</h1>
    <div class="box"></div>
@endsection

@section('script')
        <script>
            console.log('This is View Only.')
        </script>
@endsection