<?php

namespace App\Http\Controllers;

use App\Organization;
use App\UserOrganization;
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

        return view('home.index');
    }
}
