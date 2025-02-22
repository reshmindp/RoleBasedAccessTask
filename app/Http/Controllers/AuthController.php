<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class AuthController extends Controller
{
    public function adminLogin()
    {
        return response()
        ->view('auth.auth-login')
        ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->header('Expires', '0');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $authentication = Auth::attempt(['email' => $request->email,'password' => $request->password]);
       
        if($authentication)
        {
            Toastr::success("Welcome to Admin Panel","Success",["positionClass" => "toast-bottom-left"]);
            return redirect()->route('dashboard');   
        }
        else
        {
            Toastr::error("Invalid username or password","Error",["positionClass" => "toast-bottom-left"]);
            return redirect()->back();
        }
    }
}
