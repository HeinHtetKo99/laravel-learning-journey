@extends('admin.layouts.app')

@section('title','page1')

@section('style')

@section('header','page1')

@section('content')
    <h1>Put Session</h1>
    <p>Name : {{ session()->has('name')? session()->get('name') : "\u{274C}" }}</p>
    <p>Age : {{ session()->has('age')? session()->get('age') : "\u{274C}" }}</p>
    <p>Address : {{ session()->has('address')? session()->get('address') : "\u{274C}" }}</p>
    <form action="{{ url('/admin/session/put')}}" method="post">
        @csrf()
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">age</label>
            <input type="number" name="age" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">address</label>
            <textarea name="address" class="form-control" ></textarea>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary">Put Session</button>
        </div>
    </form>

    <h1>Delete Session</h1>
    <form action="{{ url('/admin/session/delete/name')}}" method="post" class="mb-3">
        @csrf()
        <div class="mb-3">
            <button class="btn btn-primary">Delete Age</button>
        </div>
    </form>

    <form action="{{ url('/admin/session/delete/age')}}" method="post" class="mb-3">
        @csrf()
        <div class="mb-3">
            <button class="btn btn-primary">Delete Age</button>
        </div>
    </form>

    <form action="{{ url('/admin/session/delete/address')}}" method="post" class="mb-3">
        @csrf()
        <div class="mb-3">
            <button class="btn btn-primary">Delete Address</button>
        </div>
    </form>

    <form action="{{ url('/admin/session/delete/delete-all')}}" method="post" class="mb-3">
        @csrf()
        <div class="mb-3">
            <button class="btn btn-primary">Delete All</button>
        </div>
    </form>
@endsection

@section('script')
        <script>
            console.log('This is page1.')
        </script>
@endsection