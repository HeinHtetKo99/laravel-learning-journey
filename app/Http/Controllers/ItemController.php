<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Item::select('items.*','categories.category_name','brands.brand_name')
                ->leftJoin('brands','items.brand_id','=','brands.id')
                ->leftJoin('categories','items.category_id','=','categories.id')
                ->get();
        return view('admin.items.index')
              ->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::select('*')->get();
        $categories = Category::select('*')->get();

        return view('admin.items.create')
                ->with('brands', $brands)
                ->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_name' => 'required|string|max:255',
            'item_code' => 'required|string|max:255|unique:items,item_code',
            'brand_id' => 'required|integer|exists:brands,id',
            'category_id' => 'required|integer|exists:categories,id',
            'price' => 'required|numeric|min:0|max:999999999999.99',
            'description' => 'required|string',
            'item_image' => 'required|image|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $imagePath = $request->file('item_image')->store('items', 'public');

        $item = new Item();
        $item->item_name = $request->item_name;
        $item->item_image = $imagePath;
        $item->item_code = $request->item_code;
        $item->price = $request->price;
        $item->description = $request->description;
        $item->brand_id = $request->brand_id;
        $item->category_id = $request->category_id;
        $item->created_at = Carbon::now();
        $item->save();

        session()->flash('message', 'Item created successfully');
        return redirect('/admin/items');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        $data = Item::select('items.*', 'categories.category_name', 'brands.brand_name')
                ->leftJoin('brands', 'items.brand_id', '=', 'brands.id')
                ->leftJoin('categories', 'items.category_id', '=', 'categories.id')
                ->where('items.id', $item->id)
                ->first();

        return view('admin.items.show')
                ->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $brands = Brand::select('*')->get();
        $categories = Category::select('*')->get();

        return view('admin.items.edit')
                ->with('data', $item)
                ->with('brands', $brands)
                ->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $validator = Validator::make($request->all(), [
            'item_name' => 'required|string|max:255',
            'item_code' => 'required|string|max:255|unique:items,item_code,' . $item->id,
            'brand_id' => 'required|integer|exists:brands,id',
            'category_id' => 'required|integer|exists:categories,id',
            'price' => 'required|numeric|min:0|max:999999999999.99',
            'description' => 'required|string',
            'item_image' => 'nullable|image|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $item->item_name = $request->item_name;
        $item->item_code = $request->item_code;
        $item->price = $request->price;
        $item->description = $request->description;
        $item->brand_id = $request->brand_id;
        $item->category_id = $request->category_id;

        if ($request->hasFile('item_image')) {
            $oldImage = $item->item_image;
            if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }

            $item->item_image = $request->file('item_image')->store('items', 'public');
        }

        $item->updated_at = Carbon::now();
        $item->save();

        session()->flash('message', 'Item updated successfully');
        return redirect('/admin/items');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Item $item)
    {
        $image = $item->item_image;
        if ($image && Storage::disk('public')->exists($image)) {
            Storage::disk('public')->delete($image);
        }

        Item::where('id', $item->id)->delete();

        session()->flash('message', 'Item deleted successfully');
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['message' => 'Item deleted successfully']);
        }

        return redirect('/admin/items');
    }

    public function delete(Item $item)
    {
        return view('admin.items.delete')
                ->with('data', $item);
    }
}
