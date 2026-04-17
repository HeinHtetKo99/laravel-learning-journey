@extends('admin.layouts.app')

@section('title','Show Item')

@section('style')
    <style>
    </style>

@section('header','Show Item')

@section('content')
    <a href="{{ url('/admin/items') }}" class="btn btn-primary">
        <i class="bi bi-arrow-left me-1"></i>
        Back
     </a>

    <div class="card mt-3">
        <div class="card-header">
            Item Details
        </div>
        <div class="card-body">
            @php
                $image = $data->item_image;
                $src = null;

                if ($image) {
                    if (\Illuminate\Support\Str::startsWith($image, ['http://', 'https://', '//'])) {
                        $src = $image;
                    } elseif (\Illuminate\Support\Str::startsWith($image, ['/storage/', 'storage/'])) {
                        $src = asset(ltrim($image, '/'));
                    } else {
                        $src = \Illuminate\Support\Facades\Storage::disk('public')->url($image);
                    }
                }
            @endphp

            @if($src)
                <div class="mb-3">
                    <img src="{{ $src }}" alt="{{ $data->item_name }}" width="200" style="max-height: 160px; object-fit: cover;">
                </div>
            @endif

            <p class="card-text">
                <strong>Item Name:</strong> {{ $data->item_name }}
            </p>
            <p class="card-text">
                <strong>Item Code:</strong> {{ $data->item_code }}
            </p>
            <p class="card-text">
                <strong>Brand Name:</strong> {{ $data->brand_name }}
            </p>
            <p class="card-text">
                <strong>Category Name:</strong> {{ $data->category_name }}
            </p>
            <p class="card-text">
                <strong>Price:</strong> {{ $data->price }}
            </p>
            <p class="card-text">
                <strong>Description:</strong> {{ $data->description }}
            </p>
            <p class="card-text">
                <strong>Created At:</strong> {{ $data->created_at }}
            </p>
            <p class="card-text">
                <strong>Updated At:</strong> {{ $data->updated_at }}
            </p>
        </div>
    </div>
@endsection

@section('script')
        <script>
        </script>
@endsection
