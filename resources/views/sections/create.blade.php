@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('shared.errors')
                @include('shared.session')

                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Add some teams or sections to {{ $department->title }}
                        </h3>
                    </div>

                    <div class="panel-body">

                        <form class="form-horizontal" action="/departments/{{ $department->id }}/sections" method="POST" autocomplete="off">
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

                        @if($sections->count() > 0)
                            <ul class="list-group">
                                @foreach($sections as $section)
                                    <li class="list-group-item {{ ($loop->first) ? 'active' : null }}">
                                        <span class="badge">{{ $section->assignedTo->title }}</span>
                                        {{ $section->title }}
                                        <br>
                                        {{ $section->assignedTo->name }}
                                        <br>
                                        {{ $section->description }}
                                        <form class="pull-right" action="/sections/{{ $section->id }}" method="POST">
                                            <a class="btn btn-xs btn-success" href="/sections/{{ $section->id }}/edit">Update</a>
                                            <button type="submit" class="btn btn-danger btn-xs"  data-toggle="tooltip" title="Delete Type">
                                                Delete
                                            </button>
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
