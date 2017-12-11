<?php

namespace App\Http\Controllers;

use App\Department;
use App\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * SectionController constructor.
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
    public function create(Request $request, Department $department)
    {
        $request->user()->authorizeRoles(['master', 'admin', 'manager']);
        $organization = auth()->user()->organizations()->first();
        $users = $organization->users;
        $sections = Section::with('assignedTo')->where('department_id', $department->id)->get();

        return view('sections.create', compact('department', 'users', 'sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Department $department)
    {
        $request->validate([
            'assigned_id' => 'required|integer',
            'title' => 'required|string|min:3',
            'description' => 'required|string|max:280'
        ]);

        $section = new Section();
        $section->user_id = auth()->id();
        $section->department_id = $department->id;
        $section->assigned_id = $request->assigned_id;
        $section->title = $request->title;
        $section->description = $request->description;
        $section->save();

        return back()->with('success', 'You added a new section. Three levels into your Org, this is like the Inception of Organizational portions.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        return null;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Section $section)
    {
        $request->user()->authorizeRoles(['master', 'admin', 'manager']);
        $organization = auth()->user()->organizations()->first();
        $users = $organization->users;

        return view('sections.edit', compact('section', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        $request->validate([
            'assigned_id' => 'required|integer',
            'title' => 'required|string|min:3',
            'description' => 'required|string|max:280'
        ]);

        $section->user_id = auth()->id();
        $section->assigned_id = $request->assigned_id;
        $section->title = $request->title;
        $section->description = $request->description;
        $section->update();

        return redirect(route('departments.sections.create', $section->department_id))->with('success', 'You updated that part of your organization yeah!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Section $section
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Section $section)
    {
        $section->delete();

        return back()->with('warning', 'Deleted! It\'s okay I won\'t tell anyone.');
    }
}
