<?php

namespace App\Http\Controllers;

use App\Organization;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class OrganizationUserController extends Controller
{
    /**
     * OrganizationUserController constructor.
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['master', 'admin', 'manager']);

        $user = auth()->user();

        $roles = Role::where('id', '!=', 1)->orderBy('id')->get();

        return view('organizations.users.create', compact( 'user', 'roles'));
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

        if ($request->submit == 'Add') {
            $this->validate($request, [
                'name' => 'required|string|max:255|min:3',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'title' => 'required|string|min:3',
                'description' => 'required|string|max:280',
                'role_id' => 'required|integer'
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'title' => $request->title,
                'description' => $request->description
            ]);
            $user->roles()->attach(Role::where('id', $request->role_id)->first());
            $organization = Organization::find(auth()->user()->organizations->first()->id);
            $organization->users()->attach($user);

            return back()->with('success', 'You added a new staff member or move on to the next step.');
        }

        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
