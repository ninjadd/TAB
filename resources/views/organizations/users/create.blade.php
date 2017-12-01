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
                            {{ $user->organizations->first()->name }} needs most staff
                        </h3>
                    </div>

                    <div class="panel-body">

                        <form class="form-horizontal" action="/organizations/users" method="POST" autocomplete="off">
                            {{ csrf_field() }}
                            <fieldset>
                                <div class="form-group">
                                    <label for="inputName" class="col-lg-2 control-label">Name</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="name" required="required" value="{{ old('name') }}" class="form-control" id="inputName" placeholder="Name of staff member">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                                    <div class="col-lg-10">
                                        <input type="email" required="required" name="email" value="{{ old('email') }}" class="form-control" id="inputEmail" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                                    <div class="col-lg-10">
                                        <input type="password" required="required" name="password" class="form-control" id="inputPassword" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword" class="col-lg-2 control-label">Confirmation</label>
                                    <div class="col-lg-10">
                                        <input type="password" required="required" name="password_confirmation" class="form-control" id="inputPassword" placeholder="Password Confirmation">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputTitle" class="col-lg-2 control-label">Title</label>
                                    <div class="col-lg-10">
                                        <input type="text" required="required" name="title" value="{{ old('title') }}" class="form-control" id="inputTitle" placeholder="COO, CTO etc.">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="textAreaDescription" class="col-lg-2 control-label">Description</label>
                                    <div class="col-lg-10">
                                        <textarea required="required" name="description" class="form-control" id="textAreaDescription" placeholder="How you would describe this role in your Company">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="selectRole" class="col-lg-2 control-label">Role</label>
                                    <div class="col-lg-10">
                                        <select required="required" name="role_id" class="form-control" id="selectRole">
                                            <option>Select</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">
                                                    {{ ucfirst($role->name) }} &mdash; {{ $role->description }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <input type="submit" name="submit" value="Add" class="btn btn-primary">
                                        <a href="/divisions/create" class="btn btn-info">Next</a>
                                    </div>
                                </div>
                            </fieldset>
                        </form>

                        @if(count(auth()->user()->organizations->first()->users) > 0)
                            <ul class="list-group">
                                @foreach(auth()->user()->organizations->first()->users as $user)
                                    <li class="list-group-item {{ ($loop->first) ? 'active' : null }}">
                                        <span class="badge">{{ $user->title }}</span>
                                        {{ $user->name }}
                                        <br>
                                        {{ $user->description }}
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
