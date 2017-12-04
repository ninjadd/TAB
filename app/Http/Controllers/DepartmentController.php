<?php

namespace App\Http\Controllers;

use App\Department;
use App\Division;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
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
     * @param Request $request
     * @param Division $division
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request, Division $division)
    {
        $request->user()->authorizeRoles(['master', 'admin', 'manager']);

        $organization = auth()->user()->organizations()->first();
        $users = $organization->users;
        $departments = Department::where('division_id', $division->id);

        return view('departments.create', compact('division', 'users', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Division $division
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Division $division)
    {
        $request->validate([
            'assigned_id' => 'required|integer',
            'title' => 'required|string|min:3',
            'description' => 'required|string|max:280'
        ]);

        $department = new Department();
        $department->user_id = auth()->id();
        $department->division_id = $division->id;
        $department->assigned_id = $request->assigned_id;
        $department->title = $request->title;
        $department->description = $request->description;
        $department->save();

        return back()->with('success', 'You added a new department.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
    }
}
