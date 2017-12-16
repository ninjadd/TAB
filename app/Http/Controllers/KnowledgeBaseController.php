<?php

namespace App\Http\Controllers;

use App\Division;
use App\Organization;
use App\KnowledgeBase;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KnowledgeBaseController extends Controller
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
        $knowledgeBases = KnowledgeBase::with('user')
            ->where('organization_id', auth()->user()->organizations->first()->id)->get();

        return view('knowledge-bases.index', compact('knowledgeBases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $user = auth()->user();
        $user->authorizeRoles(['master', 'admin', 'manager']);
        $organization = Organization::where('user_id', $user->id)->first();
        $divisions = Division::with('assignedTo')->where('organization_id', $organization->id)->get();

        return view('knowledge-bases.create', compact('organization', 'divisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:3',
            'body' => 'required|string|min:3',
            'level_id' => 'required|string'
        ]);
        $level_id = explode('|', $request->level_id);
        $levelable_type = $level_id[0];
        $levelable_id = $level_id[1];

        $knowledgeBase = new KnowledgeBase();
        $knowledgeBase->user_id = auth()->id();
        $knowledgeBase->organization_id = auth()->user()->organizations->first()->id;
        $knowledgeBase->title = $request->title;
        $knowledgeBase->slug = str_slug($request->title).'-'.Carbon::now()->timestamp;
        $knowledgeBase->body = $request->body;
        $knowledgeBase->levelable_id = $levelable_id;
        $knowledgeBase->levelable_type = $levelable_type;
        $knowledgeBase->save();

        return redirect(route('knowledge-bases.index'))->with('success', 'You just added a new Best Practice to your Organization. Huzzah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KnowledgeBase  $knowledgeBase
     * @return \Illuminate\Http\Response
     */
    public function show(KnowledgeBase $knowledgeBase)
    {
        return view('knowledge-bases.show', compact('knowledgeBase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KnowledgeBase  $knowledgeBase
     * @return \Illuminate\Http\Response
     */
    public function edit(KnowledgeBase $knowledgeBase)
    {
        $user = auth()->user();
        $user->authorizeRoles(['master', 'admin', 'manager']);
        $organization = Organization::where('user_id', $user->id)->first();
        $divisions = Division::with('assignedTo')->where('organization_id', $organization->id)->get();

        return view('knowledge-bases.edit', compact('knowledgeBase', 'organization', 'divisions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KnowledgeBase  $knowledgeBase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KnowledgeBase $knowledgeBase)
    {
        $request->validate([
            'title' => 'required|string|min:3',
            'body' => 'required|string|min:3',
            'level_id' => 'required|string'
        ]);
        $level_id = explode('|', $request->level_id);
        $levelable_type = $level_id[0];
        $levelable_id = $level_id[1];

        $knowledgeBase->user_id = auth()->id();
        $knowledgeBase->title = $request->title;
        $knowledgeBase->slug = str_slug($request->title).'-'.Carbon::now()->timestamp;
        $knowledgeBase->body = $request->body;
        $knowledgeBase->levelable_id = $levelable_id;
        $knowledgeBase->levelable_type = $levelable_type;
        $knowledgeBase->update();

        return back()->with('success', 'Updated Best Practice! Good Job.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param KnowledgeBase $knowledgeBase
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(KnowledgeBase $knowledgeBase)
    {
        $knowledgeBase->delete();

        return back()->with('warning', 'That one totally had to go. Am I right or am I right?');
    }
}
