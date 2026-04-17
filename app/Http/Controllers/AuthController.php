<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getLogin () {
        return view('admin.auth.login');
    }

    public function login(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );
        
        if($validator->fails()){
            return redirect('/admin')
                    ->withErrors($validator)
                    ->withInput();
        }

        $credential = $request->only('email','password');

        if(Auth::attempt($credential)){
            return redirect('/admin/page1');
        }
        else{
            $validator->errors()->add('password','Your credential is not valid.');
            return redirect('/admin')
                    ->withErrors($validator)
                    ->withInput();
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/admin');
    }
}

