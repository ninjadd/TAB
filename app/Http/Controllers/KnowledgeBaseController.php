<?php

namespace App\Http\Controllers;

use App\KnowledgeBase;
use Carbon\Carbon;
use foo\bar;
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
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['master', 'admin', 'manager']);
        $organization = auth()->user()->organizations->first();

        return view('knowledge-bases.create', compact('organization'));
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
            'body' => 'required|string|min:3'
        ]);

        $knowledgeBase = new KnowledgeBase();
        $knowledgeBase->user_id = auth()->id();
        $knowledgeBase->organization_id = auth()->user()->organizations->first()->id;
        $knowledgeBase->title = $request->title;
        $knowledgeBase->slug = str_slug($request->title).'-'.Carbon::now()->timestamp;
        $knowledgeBase->body = $request->body;
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
    public function edit(Request $request, KnowledgeBase $knowledgeBase)
    {
        $request->user()->authorizeRoles(['master', 'admin', 'manager']);

        return view('knowledge-bases.edit', compact('knowledgeBase'));
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
            'body' => 'required|string|min:3'
        ]);

        $knowledgeBase->user_id = auth()->id();
        $knowledgeBase->title = $request->title;
        $knowledgeBase->slug = str_slug($request->title).'-'.Carbon::now()->timestamp;
        $knowledgeBase->body = $request->body;
        $knowledgeBase->update();

        return back()->with('success', 'Updated Best Practice! Good Job.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KnowledgeBase  $knowledgeBase
     * @return \Illuminate\Http\Response
     */
    public function destroy(KnowledgeBase $knowledgeBase)
    {
        $knowledgeBase->delete();

        return back()->with('warning', 'That one totally had to go. Am I right or am I right?');
    }
}
