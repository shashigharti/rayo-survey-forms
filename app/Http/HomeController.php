<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    //temp code
    public function login(Request $request)
    {
        $data = $request->all();
        $response = ['auth' => false,'user' => null];
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']]))
        {
            $response =[ 'auth' => True,'user' => Auth::user()];
        }
        return response()->json($response);
    }
}
