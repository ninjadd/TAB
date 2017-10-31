@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('shared.errors')

                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Edit User
                        </h3>
                    </div>

                    <div class="panel-body">

                        <form class="form-horizontal" action="/user/{{ $user->id }}" method="POST" autocomplete="off">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <fieldset>
                                <div class="form-group">
                                    <label for="inputName" class="col-lg-2 control-label">Name</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="name" required="required" value="{{ $user->name }}" class="form-control" id="inputName" placeholder="User Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                                    <div class="col-lg-10">
                                        <input type="email" required="required" name="email" value="{{ $user->email }}" class="form-control" id="inputEmail" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                                    <div class="col-lg-10">
                                        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Update Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword" class="col-lg-2 control-label">Confirmation</label>
                                    <div class="col-lg-10">
                                        <input type="password" name="password_confirmation" class="form-control" id="inputPassword" placeholder="Update Password Confirmation">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputRole" class="col-lg-2 control-label">Role</label>
                                    <div class="col-lg-10">
                                        <select class="form-control" name="role" id="inputRole">
                                            <option>Select Role</option>
                                            <option {!! ($user->role == 'admin') ? 'selected="selected"' : null !!} value="admin">Administrator</option>
                                            <option {!! ($user->role == 'owner') ? 'selected="selected"' : null !!} value="owner">Account Admin</option>
                                            <option {!! ($user->role == 'staff') ? 'selected="selected"' : null !!} value="staff">Account User</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <button type="submit" class="btn btn-success">Update User</button>
                                        <button type="reset" class="btn btn-default">Cancel</button>
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
