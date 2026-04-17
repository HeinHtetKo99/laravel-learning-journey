@extends('admin.layouts.app')

@section('title','Delete Item')

@section('style')
    <style>
    </style>

@section('header','Delete Item')

@section('content')
    <a href="{{ url('/admin/items') }}" class="btn btn-primary">
        <i class="bi bi-arrow-left me-1"></i>
        Back
     </a>

    <div class="card mt-3">
        <div class="card-header">
            Confirm Delete
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
                    <img src="{{ $src }}" alt="{{ $data->item_name }}" width="160" style="max-height: 140px; object-fit: cover;">
                </div>
            @endif

            <p class="card-text"><strong>Item Name:</strong> {{ $data->item_name }}</p>
            <p class="card-text"><strong>Item Code:</strong> {{ $data->item_code }}</p>
            <p class="card-text"><strong>Price:</strong> {{ $data->price }}</p>
            <p class="card-text"><strong>Description:</strong> {{ $data->description }}</p>

            <form action="{{ url('/admin/items/'.$data->id) }}" method="post" class="mt-3">
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
