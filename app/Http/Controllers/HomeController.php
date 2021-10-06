<?php

namespace App\Http\Controllers;

use App\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('home', compact('permissions'));
    }

    public function denies()
    {
        return view('denies');
    }
}
