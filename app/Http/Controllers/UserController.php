<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = DB::table('users')->select('*')->get(); (didn't use model method)
        $data = User::select('*')->get();  //(using model method)(MVC pattern)
        return view('admin.users.index',compact('data'))
                ->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
        if($validator->fails()){
            return redirect('/admin/users/create')
                    ->withErrors($validator)
                    ->withInput();
        }
        $data = [];
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);
        $data['created_at'] = Carbon::now();

        User::insert($data);
        session()->flash('message','User created successfully');
        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = User::select('id','name','email','created_at','updated_at')->where('id',$id)->first();
        return view('admin.users.show')
                ->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {   
        $data = User::select('id','name','email')->where('id',$id)->first();
        return view('admin.users.edit')
                ->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);
        if($validator->fails()){
            return redirect('/admin/users/'.$id.'/edit')
                    ->withErrors($validator)
                    ->withInput();
        }
        $data = [];
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['updated_at'] = Carbon::now();

        User::where('id',$id)->update($data);
        session()->flash('message','User updated successfully');
        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id',$id)->delete();
    }

    public function resetPassword(string $id)
    {
        $data = User::select('id')->find($id);
        return view('admin.users.reset-password')
                ->with('data',$data);
    }

    public function resetPasswordSubmit(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'password' => 'required|min:6|confirmed',
        ]);
        if($validator->fails()){
            return redirect('/admin/users/reset-password/'.$id)
                    ->withErrors($validator);
        }
        $data = [];
        $data['password'] = bcrypt($request->password);

        User::where('id',$id)->update($data);
        session()->flash('message','User password reset successfully');
        return redirect('/admin/users');
    }
}
