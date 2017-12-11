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