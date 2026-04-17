<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::select('*')
                        ->get();
        return view('admin.categories.index')
                ->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(),[
            'category_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);
        if($validator->fails()){
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->description = $request->description;
        $category->created_at = Carbon::now();
        $category->save();
        session()->flash('message', 'Category created successfully');
        return redirect('/admin/categories');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
        return view('admin.categories.show')
                ->with('data',$category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        return view('admin.categories.edit')
                ->with('data',$category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        $validator = Validator::make($request->all(),[
            'category_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);
        if($validator->fails()){
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }
        $category->category_name = $request->category_name;
        $category->description = $request->description;
        $category->updated_at = Carbon::now();
        $category->save();
        session()->flash('message', 'Category updated successfully');
        return redirect('/admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Category::where('id', $category->id)->delete();
        return redirect()->route('admin.categories.index')
                ->with('message', 'Category deleted successfully');
    }
}
