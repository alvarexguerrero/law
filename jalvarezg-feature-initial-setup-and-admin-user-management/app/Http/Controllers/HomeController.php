<?php

namespace App\Http\Controllers;

use App\Http\Requests;
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
        $this->middleware('auth'); // Requires users to be logged in
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Later, we can redirect based on role from here
        // For example:
        // if ($request->user()->isAdmin()) {
        //     return redirect('/admin/dashboard');
        // } elseif ($request->user()->isLawyer()) {
        //     return redirect('/lawyer/dashboard');
        // } else {
        //     return redirect('/client/dashboard');
        // }
        return view('home');
    }
}
