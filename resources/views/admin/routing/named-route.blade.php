@extends('admin.layouts.app')

@section('title','Named Route')

@section('style')
    <style>
        h1{
            background-color : black;
            color : white ; 
            text-align : center;
            padding : 10px
        }
    </style>

@section('header','Named Route')

@section('content')
    <h1>{{ url('/admin/routing/named-route') }}</h1>
    <h1>{{ route('routing.named-route') }}</h1>
@endsection

@section('script')
        <script>
            console.log('This is Named Route.')
        </script>
@endsection