<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Order::select('*')->get();

        return view('admin.orders.index')
                ->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::select('id', 'item_name', 'item_image', 'item_code', 'price')->get();

        return view('admin.orders.create')
                ->with('items', $items);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_date' => 'required|date',
            'item_id' => 'required|array|min:1',
            'item_id.*' => 'required|integer|exists:items,id',
            'quantity' => 'required|array|min:1',
            'quantity.*' => 'required|integer|min:1|max:1000000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $ids = $request->item_id;
        $quantities = $request->quantity;
        $pivotData = [];

        $prices = Item::whereIn('id', $ids)->pluck('price', 'id');
        $totalPrice = 0;

        foreach ($ids as $index => $id) {
            $qty = (int) ($quantities[$index] ?? 1);
            $price = (float) ($prices[$id] ?? 0);
            $totalPrice += $price * $qty;
            $pivotData[$id] = ['quantity' => $qty];
        }

        $order = new Order();
        $order->order_date = $request->order_date;
        $order->total_price = $totalPrice;
        $order->created_at = Carbon::now();
        $order->save();

        $order->items()->sync($pivotData);

        session()->flash('message', 'Order created successfully');
        return redirect('/admin/orders');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load([
            'items' => function ($query) {
                $query->select('items.id', 'items.item_name', 'items.item_code', 'items.item_image', 'items.price');
            },
        ]);

        return view('admin.orders.show')
                ->with('data', $order);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $items = Item::select('id', 'item_name', 'item_image', 'item_code', 'price')->get();

        return view('admin.orders.edit')
                ->with('data', $order)
                ->with('items', $items)
                ->with('orderItems', $order->items()->select('items.id', 'items.item_name', 'items.item_image', 'items.item_code', 'items.price')->get());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validator = Validator::make($request->all(), [
            'order_date' => 'required|date',
            'item_id' => 'required|array|min:1',
            'item_id.*' => 'required|integer|exists:items,id',
            'quantity' => 'required|array|min:1',
            'quantity.*' => 'required|integer|min:1|max:1000000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $ids = $request->item_id;
        $quantities = $request->quantity;
        $pivotData = [];

        $prices = Item::whereIn('id', $ids)->pluck('price', 'id');
        $totalPrice = 0;

        foreach ($ids as $index => $id) {
            $qty = (int) ($quantities[$index] ?? 1);
            $price = (float) ($prices[$id] ?? 0);
            $totalPrice += $price * $qty;
            $pivotData[$id] = ['quantity' => $qty];
        }

        $order->order_date = $request->order_date;
        $order->total_price = $totalPrice;
        $order->updated_at = Carbon::now();
        $order->save();

        $order->items()->sync($pivotData);

        session()->flash('message', 'Order updated successfully');
        return redirect('/admin/orders');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Order $order)
    {
        Order::where('id', $order->id)->delete();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['message' => 'Order deleted successfully']);
        }

        session()->flash('message', 'Order deleted successfully');
        return redirect('/admin/orders');
    }

    public function delete(Order $order)
    {
        return view('admin.orders.delete')
                ->with('data', $order);
    }
}
