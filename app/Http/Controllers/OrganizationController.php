<?php

namespace App\Http\Controllers;

use App\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * OrganizationController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['master', 'admin', 'manager']);

        return view('organizations.index');
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['master', 'admin', 'manager']);

        return view('organizations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->authorizeRoles(['master', 'admin', 'manager']);

        $this->validate($request, [
            'name' => 'required|min:3',
            'description' => 'max:280'
        ]);

        $organization = new Organization();
        $organization->user_id = auth()->id();
        $organization->name = $request->name;
        $organization->description = $request->description;
        $organization->save();
        $organization->users()->attach(auth()->id());

        return redirect(route('users.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        //
    }
}
