<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
        $this->middleware('verified')->only(['verificado']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        return view('home');
    }

    // El index no lo ve si no esta logueado, metemos una excepccion para que lo vea
    public function index()
    {
        return view('index');
    }


    function verificado()
    {
        return view('verificado');
    }

}
