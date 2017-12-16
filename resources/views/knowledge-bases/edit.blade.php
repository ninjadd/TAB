@extends('layouts.app')

@include('shared.editor')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('shared.errors')
                @include('shared.session')

                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Updating {{ $knowledgeBase->title }}
                        </h3>
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal" action="/knowledge-bases/{{ $knowledgeBase->id }}" method="POST" autocomplete="off">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Organization Sections</label>
                                    <div class="col-lg-10">
                                        <ul style="list-style: none;">
                                            @foreach($divisions->load('departments') as $division)
                                                <li>
                                                    <label>
                                                        <input type="radio" {!! ($knowledgeBase->levelable_type.'|'.$knowledgeBase->levelable_id == 'App\Division|'.$division->id) ? 'checked="checked"' : null !!} required="required" name="level_id" value="App\Division|{{ $division->id }}">
                                                        {{ $division->title }} > {{ $division->assignedTo->name }}
                                                    </label>
                                                </li>
                                                @if($division->departments->count() > 0)
                                                    <ul style="list-style: none;">
                                                        @foreach($division->departments->load(['assignedTo', 'sections']) as $department)
                                                            <li>
                                                                <label>
                                                                    <input type="radio" {!! ($knowledgeBase->levelable_type.'|'.$knowledgeBase->levelable_id == 'App\Department|'.$department->id) ? 'checked="checked"' : null !!} required="required" name="level_id" value="App\Department|{{ $department->id }}">
                                                                    {{ $department->title }} > {{ $department->assignedTo->name }}
                                                                </label>
                                                            </li>
                                                            @if($department->sections->count() > 0)
                                                                <ul style="list-style: none;">
                                                                    @foreach($department->sections->load('assignedTo') as $section)
                                                                        <li>
                                                                            <label>
                                                                                <input type="radio" {!! ($knowledgeBase->levelable_type.'|'.$knowledgeBase->levelable_id == 'App\Section|'.$section->id) ? 'checked="checked"' : null !!} required="required" name="level_id" value="App\Section|{{ $section->id }}">
                                                                                {{ $section->title }} > {{ $section->assignedTo->name }}
                                                                            </label>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputTitle" class="col-lg-2 control-label">Title</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="title" required="required" value="{{ $knowledgeBase->title }}" class="form-control" id="inputTitle" placeholder="This is a great best practice">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="textAreaDescription" class="col-lg-2 control-label">Body</label>
                                    <div class="col-lg-10">
                                        <textarea required="required" name="body" class="form-control" id="textArea" placeholder="">{{ $knowledgeBase->body }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <input type="submit" name="submit" value="Update" class="btn btn-success">
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection