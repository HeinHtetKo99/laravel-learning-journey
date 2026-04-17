@extends('admin.layouts.app')

@section('title','lecture3')

@section('style')
    <style>
        h1{
            background-color : orange;
            color : white ; 
            text-align : center;
            padding : 10px
        }
    </style>

@section('header','lecture3')

@section('content')
    <h1>This is lecture3.</h1>
    <button class="btn btn-primary" id="btn-get-items">Get Items</button>
    <hr>
    <ul class="list-group">

    </ul>
@endsection

@section('script')
        <script>
            $(document).ready(()=>{
                $('#btn-get-items').click(()=>{
                    $.ajax({
                        url: "/admin/csrf/get-items",
                        type: "POST",
                        data:{
                            "_token" : "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            const items = response;
                            $('.list-group').empty();
                            items.forEach(item => {
                                $('.list-group').append(`<li class="list-group-item">${item}</li>`)
                            });
                        }
                    })
                })
            })
        </script>
@endsection