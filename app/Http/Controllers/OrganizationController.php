<?php

namespace App\Http\Controllers;

use App\Organization;
use App\UserOrganization;
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
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return null;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $this->validate($request, [
            'name' => 'required|min:3',
            'description' => 'required|min:140'
        ]);

        $organization = new Organization();
        $organization->name = $request->name;
        $organization->description = $request->description;
        $organization->save();

        $userOrganization = new UserOrganization();
        $userOrganization->user_id = auth()->id();
        $userOrganization->organization_id = $organization->id;
        $userOrganization->save();

        return redirect('home')->with('success', 'You added Organizational information. Yay!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        return null;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        return view('organizations.edit', compact('organization'));
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
        $this->validate($request, [
            'name' => 'required|min:3',
            'description' => 'required|min:140'
        ]);

        $organization->name = $request->name;
        $organization->description = $request->description;
        $organization->update();

        return redirect('home')->with('success', 'You updated your Organization. Great job!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        return null;
    }
}
