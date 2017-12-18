@extends('layouts.app')

@include('shared.editor')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('shared.errors')
                @include('shared.session')

                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Add some departments to {{ $division->title }}
                        </h3>
                    </div>

                    <div class="panel-body">

                        <form class="form-horizontal" action="/divisions/{{ $division->id }}/departments" method="POST" autocomplete="off">
                            {{ csrf_field() }}
                            <fieldset>
                                <div class="form-group">
                                    <label for="selectUser" class="col-lg-2 control-label">Assigned Staff</label>
                                    <div class="col-lg-10">
                                        <select required="required" name="assigned_id" class="form-control" id="selectUser">
                                            <option>Select</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->name }} &mdash; {{ $user->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputTitle" class="col-lg-2 control-label">Title</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="title" required="required" value="{{ old('title') }}" class="form-control" id="inputTitle" placeholder="Finance etc.">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="textAreaDescription" class="col-lg-2 control-label">Description</label>
                                    <div class="col-lg-10">
                                        <textarea required="required" name="description" class="form-control" id="textAreaDescription" placeholder="">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <input type="submit" name="submit" value="Add" class="btn btn-primary">
                                        <a href="/home" class="btn btn-info">Dashboard</a>
                                    </div>
                                </div>
                            </fieldset>
                        </form>

                        @if($departments->count() > 0)
                            <ul class="list-group">
                                @foreach($departments as $department)
                                    <li class="list-group-item {{ ($loop->first) ? 'active' : null }}">
                                        <span class="badge">{{ $department->assignedTo->title }}</span>
                                        {{ $department->title }}
                                        <br>
                                        {{ $department->assignedTo->name }}
                                        <br>
                                        {{ $department->description }}
                                        <form class="pull-right" action="/departments/{{ $department->id }}" method="POST">
                                            <a class="btn btn-xs btn-success" href="/departments/{{ $department->id }}/edit">Update</a>
                                            <a href="/departments/{{ $department->id }}/sections/create" class="btn btn-xs {{ ($loop->first  ) ? 'btn-default' : 'btn-primary' }}">
                                                Manage
                                                <span class="badge">{{ $department->sections->count() }}</span>
                                            </a>
                                            <button type="submit" class="btn btn-danger btn-xs">
                                                Delete
                                            </button>
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target=".{{ $department->id }}-modal">Best Practice</button>
                                        </form>
                                    </li>

                                    <div class="modal fade {{ $department->id }}-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">
                                                        Add Best Practice for {{ $department->title }}
                                                    </h4>
                                                </div>
                                                <form class="form-horizontal" action="/knowledge-bases" method="POST" autocomplete="off">
                                                    <div class="modal-body">
                                                        {{ csrf_field() }}
                                                        <fieldset>
                                                            <div class="form-group">
                                                                <div class="col-lg-12">
                                                                    <label for="inputTitle" class="control-label">Title</label>
                                                                    <input type="text" name="title" required="required" value="{{ old('title') }}" class="form-control" id="inputTitle" placeholder="This is a great best practice">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-lg-12">
                                                                    <label for="textAreaDescription" class="control-label">Body</label>
                                                                    <textarea required="required" name="body" class="form-control modalText" id="textArea" placeholder="">{{ old('body') }}</textarea>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="level_id" value="App\Department|{{ $department->id }}">
                                                        <input type="hidden" name="home" value="back">
                                                        <button type="submit" class="pull-left btn btn-primary">Add</button>
                                                        <button type="button" class="pull-left btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </ul>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
