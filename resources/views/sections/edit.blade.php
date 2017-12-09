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
                            Update {{ $section->title }}
                        </h3>
                    </div>

                    <div class="panel-body">

                        <form class="form-horizontal" action="/sections/{{ $section->id }}" method="POST" autocomplete="off">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <fieldset>
                                <div class="form-group">
                                    <label for="selectUser" class="col-lg-2 control-label">Assigned Staff</label>
                                    <div class="col-lg-10">
                                        <select required="required" name="assigned_id" class="form-control" id="selectUser">
                                            <option>Select</option>
                                            @foreach($users as $user)
                                                <option {{ ($section->assigned_id == $user->id) ? 'selected=\"selected\"' : null }} value="{{ $user->id }}">
                                                    {{ $user->name }} &mdash; {{ $user->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputTitle" class="col-lg-2 control-label">Title</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="title" required="required" value="{{ $section->title }}" class="form-control" id="inputTitle" placeholder="Finance etc.">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="textAreaDescription" class="col-lg-2 control-label">Description</label>
                                    <div class="col-lg-10">
                                        <textarea required="required" name="description" class="form-control" id="textAreaDescription" placeholder="">{{ $section->description }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <a href="/home" class="btn btn-primary">Dashboard</a>
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
