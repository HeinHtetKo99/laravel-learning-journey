@extends('admin.layouts.app')

@section('title','Show Order')

@section('style')
    <style>
        .order-item-thumb{
            width: 44px;
            height: 44px;
            object-fit: cover;
            border-radius: .5rem;
            background: #f8f9fa;
        }
        .order-meta{
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        @media (max-width: 992px){
            .order-meta{
                grid-template-columns: 1fr;
            }
        }
    </style>

@section('header','Show Order')

@section('content')
    <a href="{{ url('/admin/orders') }}" class="btn btn-primary">
        <i class="bi bi-arrow-left me-1"></i>
        Back
     </a>

    @php
        $items = $data->items ?? collect();
        $computedTotal = 0;
        foreach ($items as $i) {
            $qty = (int) ($i->pivot->quantity ?? 1);
            $computedTotal += ((float) $i->price) * $qty;
        }
    @endphp

    <div class="row g-3 mt-2">
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <div class="fw-semibold">Order Summary</div>
                    <div class="text-muted small">Order #{{ $data->id }}</div>
                </div>
                <div class="card-body">
                    <div class="order-meta">
                        <div>
                            <div class="text-muted small">Order Date</div>
                            <div class="fw-semibold">{{ $data->order_date }}</div>
                        </div>
                        <div>
                            <div class="text-muted small">Items</div>
                            <div class="fw-semibold">{{ $items->count() }}</div>
                        </div>
                        <div>
                            <div class="text-muted small">Created At</div>
                            <div class="fw-semibold">{{ $data->created_at }}</div>
                        </div>
                        <div>
                            <div class="text-muted small">Updated At</div>
                            <div class="fw-semibold">{{ $data->updated_at }}</div>
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="d-flex align-items-center justify-content-between">
                        <div class="text-muted">Total</div>
                        <div class="fs-5 fw-bold">${{ number_format($computedTotal, 2) }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div>
                        <div class="fw-semibold">Items</div>
                        <div class="text-muted small">Quantity and subtotals</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th class="text-end">Price</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $item)
                                    @php
                                        $image = $item->item_image;
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

                                        $qty = (int) ($item->pivot->quantity ?? 1);
                                        $subtotal = ((float) $item->price) * $qty;
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                @if($src)
                                                    <img src="{{ $src }}" alt="{{ $item->item_name }}" class="order-item-thumb">
                                                @else
                                                    <div class="order-item-thumb d-flex align-items-center justify-content-center text-muted">
                                                        <i class="bi bi-image"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="fw-semibold">{{ $item->item_name }}</div>
                                                    <div class="text-muted small">{{ $item->item_code }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end">${{ number_format((float) $item->price, 2) }}</td>
                                        <td class="text-center">{{ $qty }}</td>
                                        <td class="text-end fw-semibold">${{ number_format($subtotal, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">No items in this order.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="d-flex align-items-center justify-content-end">
                        <div class="fs-6 fw-semibold">Total: ${{ number_format($computedTotal, 2) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
        <script>
        </script>
@endsection
