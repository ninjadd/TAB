@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('shared.errors')
                @include('shared.session')

                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Add divisions to {{ $organization->name }}
                        </h3>
                    </div>

                    <div class="panel-body">

                        <form class="form-horizontal" action="/divisions" method="POST" autocomplete="off">
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
                                        <input type="text" name="title" required="required" value="{{ old('name') }}" class="form-control" id="inputTitle" placeholder="Human Resources, Operations etc.">
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
                                        <a href="/home" class="btn btn-info">Next</a>
                                    </div>
                                </div>
                            </fieldset>
                        </form>

                        @if($divisions->count() > 0)
                            <ul class="list-group">
                                @foreach($divisions as $division)
                                    <li class="list-group-item {{ ($loop->first) ? 'active' : null }}">
                                        <span class="badge">{{ $division->assignedTo->title }}</span>
                                        {{ $division->title }}
                                        <br>
                                        {{ $division->assignedTo->name }}
                                        <br>
                                        {{ $division->description }}
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
