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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userOrganization = UserOrganization::where('user_id', auth()->id())->first();
//        $organization = Organization::where('id', $userOrganization->organization_id)->first();

        return view('home.index', compact('organization'));
    }
}
