<?php

namespace App\Http\Controllers;

use App\Division;
use App\Organization;
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
        $divisions = Division::with(['departments', 'assignedTo'])->where('organization_id', $organization->id)->get();

        return view('home.index', compact('user', 'organization', 'divisions'));
    }
}
