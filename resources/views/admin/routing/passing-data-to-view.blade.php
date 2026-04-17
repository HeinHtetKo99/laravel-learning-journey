@extends('admin.layouts.app')

@section('title','Passing Data To View')

@section('style')
    <style>
        h1{
            background-color : black;
            color : white ; 
            text-align : center;
            padding : 10px
        }
    </style>

@section('header','Passing Data To View')

@section('content')
    <h5>List Items</h5>
    <!-- normal array -->
    <ul class="list-group">
        @foreach($listItems as $listItem)
            <li class="list-group-items">{{ $listItem }}</li>
        @endforeach
    </ul>
    <hr>

    <h5>Buttons</h5>
    <!-- key value array -->
    @foreach($btns as $btn)
        <button class="btn btn-{{ $btn['type'] }}">{{ $btn['text'] }}</button>
    @endforeach
    <hr>

    <h5>Alerts</h5>
    <!-- object array -->
    @foreach($alerts as $alert)
        <div class="alert alert-{{ $alert->type}}" role="alert">{{ $alert->text }}</div>
    @endforeach
@endsection

@section('script')
        <script>
            console.log('This is Passing Data To View.')
        </script>
@endsection