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
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['master', 'admin', 'manager', 'employee', 'staff']);

        $user = auth()->user();
        $organization = $user->organizations->first();

        return view('home.index', compact('user', 'organization'));
    }
}
