<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Brand::select('*')->get();
        return view('admin.brands.index')
                ->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(),[
            'brand_name' => 'required|string|unique:brands|max:255',
            'description' => 'required|string|max:255',
        ]);
        if($validator->fails()){
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }
        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->description = $request->description;
        $brand->created_at = Carbon::now();
        $brand->save();
        session()->flash('message', 'Brand created successfully');
        return redirect('/admin/brands');
    }   

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
        return view('admin.brands.show')
                ->with('data', $brand);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        //
        return view('admin.brands.edit')
                ->with('data', $brand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $validator = Validator::make($request->all(),[
            'brand_name' => 'required|string|unique:brands,brand_name,'.$brand->id.'|max:255',
            'description' => 'required|string|max:255',
        ]);
        if($validator->fails()){
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }
        $brand->brand_name = $request->brand_name;
        $brand->description = $request->description;
        $brand->updated_at = Carbon::now();
        $brand->save();
        session()->flash('message', 'Brand updated successfully');
        return redirect('/admin/brands');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        //
        Brand::where('id', $brand->id)->delete();
        return redirect()->route('admin.brands.index')
                ->with('message', 'Brand deleted successfully');
    }
}
