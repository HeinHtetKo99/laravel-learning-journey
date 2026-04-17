@extends('admin.layouts.app')

@section('title','Create Order')

@section('style')
    <style>
        .order-item-card{
            cursor: pointer;
            transition: transform 0.12s ease-in-out, box-shadow 0.12s ease-in-out;
        }
        .order-item-card:hover{
            transform: translateY(-1px);
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.08);
        }
        .order-item-img{
            width: 100%;
            height: 380px;
            object-fit: cover;
            border-top-left-radius: .375rem;
            border-top-right-radius: .375rem;
        }
        .sticky-summary{
            position: sticky;
            top: 1rem;
        }
    </style>

@section('header','Create Order')

@section('content')
    <a href="{{ url('/admin/orders') }}" class="btn btn-primary">
        <i class="bi bi-arrow-left me-1"></i>
        Back
     </a>

    @php
        $itemsById = isset($items) ? $items->keyBy('id') : collect();
        $oldIds = old('item_id', []);
        $oldQty = old('quantity', []);
        $initialCart = [];
        foreach ($oldIds as $index => $id) {
            if ($itemsById->has($id)) {
                $i = $itemsById->get($id);
                $initialCart[] = [
                    'id' => $i->id,
                    'item_name' => $i->item_name,
                    'item_code' => $i->item_code,
                    'price' => (float) $i->price,
                    'quantity' => (int) ($oldQty[$index] ?? 1),
                ];
            }
        }
    @endphp

    <form action="{{ url('/admin/orders') }}" method="post" novalidate class="mt-3">
        @csrf()

        <div class="row g-3">
            <div class="col-lg-7">
                <div class="card shadow-sm">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div>
                            <div class="fw-semibold">Items</div>
                            <div class="text-muted small">Click an item to add it to the order</div>
                        </div>
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control" id="item-search" placeholder="Search items...">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3" id="items-grid">
                            @foreach(($items ?? []) as $item)
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
                                @endphp
                                <div class="col-sm-6 col-xl-4 item-card-wrap" data-name="{{ strtolower($item->item_name) }}" data-code="{{ strtolower($item->item_code) }}">
                                    <div class="card h-100 order-item-card item-card"
                                         data-id="{{ $item->id }}"
                                         data-name="{{ $item->item_name }}"
                                         data-code="{{ $item->item_code }}"
                                         data-price="{{ $item->price }}">
                                        @if($src)
                                            <img src="{{ $src }}" alt="{{ $item->item_name }}" class="order-item-img">
                                        @endif
                                        <div class="card-body">
                                            <div class="d-flex align-items-start justify-content-between gap-2">
                                                <div class="fw-semibold">{{ $item->item_name }}</div>
                                                <span class="badge bg-light text-dark">{{ $item->item_code }}</span>
                                            </div>
                                            <div class="mt-2 d-flex align-items-center justify-content-between">
                                                <div class="fw-semibold">${{ number_format((float) $item->price, 2) }}</div>
                                                <button type="button" class="btn btn-sm btn-outline-primary add-btn">
                                                    <i class="bi bi-plus-lg me-1"></i>
                                                    Add
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="sticky-summary">
                    <div class="card shadow-sm mb-3">
                        <div class="card-header">
                            <div class="fw-semibold">Order Summary</div>
                            <div class="text-muted small">Review selected items before saving</div>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6 col-lg-12">
                                    <label class="form-label">Order Date</label>
                                    <input type="date" class="form-control" name="order_date" value="{{ old('order_date', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                                    @if($errors->has('order_date'))
                                        <p class="text-danger">{{ $errors->first('order_date') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-3">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="fw-semibold">Selected Items</div>
                                    <div class="text-muted small"><span id="cart-count">0</span> items</div>
                                </div>

                                @if($errors->has('item_id'))
                                    <p class="text-danger">{{ $errors->first('item_id') }}</p>
                                @endif

                                <div class="table-responsive">
                                    <table class="table table-sm align-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th class="text-end">Price</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-end">Subtotal</th>
                                                <th class="text-end"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="cart-body">
                                        </tbody>
                                    </table>
                                </div>

                                <div id="cart-hidden-inputs"></div>

                                <hr class="my-3">

                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-semibold">Total</div>
                                    <div class="fs-5 fw-bold">$<span id="cart-total">0.00</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <button type="submit" class="btn btn-primary w-100" id="save-order-btn">
                                <i class="bi bi-save me-1"></i>
                                Save Order
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
        <script>
            const initialCart = @json($initialCart);

            const money = (value) => {
                const number = Number(value || 0);
                return number.toFixed(2);
            }

            const cart = new Map();

            const addToCart = (item) => {
                const existing = cart.get(item.id);
                if (existing) {
                    cart.set(item.id, { ...existing, quantity: existing.quantity + 1 });
                } else {
                    cart.set(item.id, { ...item, quantity: 1 });
                }
                renderCart();
            }

            const setQty = (id, quantity) => {
                const existing = cart.get(id);
                if (!existing) return;
                const qty = Math.max(1, Number(quantity || 1));
                cart.set(id, { ...existing, quantity: qty });
                renderCart();
            }

            const removeFromCart = (id) => {
                cart.delete(id);
                renderCart();
            }

            const renderCart = () => {
                const tbody = $('#cart-body');
                const hidden = $('#cart-hidden-inputs');
                tbody.empty();
                hidden.empty();

                let total = 0;
                let count = 0;

                Array.from(cart.values()).forEach((item) => {
                    const subtotal = Number(item.price) * Number(item.quantity);
                    total += subtotal;
                    count += 1;

                    tbody.append(`
                        <tr>
                            <td>
                                <div class="fw-semibold">${item.item_name}</div>
                                <div class="text-muted small">${item.item_code}</div>
                            </td>
                            <td class="text-end">$${money(item.price)}</td>
                            <td class="text-center" style="width: 92px;">
                                <input type="number" min="1" class="form-control form-control-sm text-center cart-qty" data-id="${item.id}" value="${item.quantity}">
                            </td>
                            <td class="text-end fw-semibold">$${money(subtotal)}</td>
                            <td class="text-end">
                                <button type="button" class="btn btn-sm btn-outline-danger cart-remove" data-id="${item.id}">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </td>
                        </tr>
                    `);

                    hidden.append(`
                        <input type="hidden" name="item_id[]" value="${item.id}">
                        <input type="hidden" name="quantity[]" value="${item.quantity}">
                    `);
                });

                $('#cart-total').text(money(total));
                $('#cart-count').text(count);

                $('#save-order-btn').prop('disabled', count === 0);
            }

            $(document).ready(() => {
                initialCart.forEach((item) => {
                    cart.set(item.id, item);
                });
                renderCart();

                $(document).on('click', '.add-btn', (e) => {
                    e.preventDefault();
                    e.stopPropagation();

                    const card = $(e.currentTarget).closest('.item-card');
                    const item = {
                        id: Number(card.data('id')),
                        item_name: String(card.data('name')),
                        item_code: String(card.data('code')),
                        price: Number(card.data('price')),
                    };
                    addToCart(item);
                });

                $(document).on('click', '.item-card', (e) => {
                    const card = $(e.target).closest('.item-card');
                    const item = {
                        id: Number(card.data('id')),
                        item_name: String(card.data('name')),
                        item_code: String(card.data('code')),
                        price: Number(card.data('price')),
                    };
                    addToCart(item);
                });

                $(document).on('input', '.cart-qty', (e) => {
                    const input = $(e.currentTarget);
                    setQty(Number(input.data('id')), input.val());
                });

                $(document).on('click', '.cart-remove', (e) => {
                    removeFromCart(Number($(e.currentTarget).data('id')));
                });

                $('#item-search').on('input', (e) => {
                    const query = String($(e.currentTarget).val() || '').toLowerCase().trim();
                    $('.item-card-wrap').each((_, el) => {
                        const wrap = $(el);
                        const name = String(wrap.data('name') || '');
                        const code = String(wrap.data('code') || '');
                        const visible = !query || name.includes(query) || code.includes(query);
                        wrap.toggleClass('d-none', !visible);
                    });
                });
            });
        </script>
@endsection
