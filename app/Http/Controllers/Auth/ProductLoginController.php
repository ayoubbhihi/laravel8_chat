<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductLoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = 'product/dashboard';

    public function __construct()
    {
        $this->middleware('guest:product,product/dashboard')->except('logout');
    }



    public function showLoginForm()
    {
        return view('auth.product.login');
    }

    protected function guard()
    {
        return Auth::guard('product');
    }
}