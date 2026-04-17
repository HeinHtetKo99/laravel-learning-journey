@extends('admin.layouts.app')

@section('title','Delete Order')

@section('style')
    <style>
    </style>

@section('header','Delete Order')

@section('content')
    <a href="{{ url('/admin/orders') }}" class="btn btn-primary">
        <i class="bi bi-arrow-left me-1"></i>
        Back
     </a>

    <div class="card mt-3">
        <div class="card-header">
            Confirm Delete
        </div>
        <div class="card-body">
            <p class="card-text"><strong>Order Date:</strong> {{ $data->order_date }}</p>
            <p class="card-text"><strong>Total Price:</strong> {{ $data->total_price }}</p>
            <p class="card-text text-danger mb-0">This action cannot be undone.</p>

            <form action="{{ url('/admin/orders/'.$data->id) }}" method="post" class="mt-3">
                @method('DELETE')
                @csrf()
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-trash-fill me-1"></i>
                    Delete
                </button>
            </form>
        </div>
    </div>
@endsection

@section('script')
        <script>
        </script>
@endsection

