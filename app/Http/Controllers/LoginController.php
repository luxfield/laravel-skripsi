<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    //
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function login(Request $request)
    {


        return view('index',['title' => 'login']);
    }

    public function doLogin(LoginRequest $request)
    {

        if($this->userService->login($request->email, $request->password)){
            $request->session()->put('user',$request->email);

            return redirect()->route('home');
        }

        return back()->withErrors(['gagal' => 'Username atau password salah']);
        
    }

    public function doLogout(Request $request)
    {
        $request->session()->forget('user');
        $request->session()->flush();
        return redirect('/');
    }
}
