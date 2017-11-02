@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            View User {{ $user->name }}
                        </h3>
                    </div>

                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <span class="badge">Name</span>
                                {{ $user->name }}
                            </li>
                            <li class="list-group-item">
                                <span class="badge">Email</span>
                                {{ $user->email }}
                            </li>
                            <li class="list-group-item">
                                <span class="badge">Since</span>
                                {{ $user->created_at->toDayDateTimeString() }}
                            </li>
                        </ul>
                        <form action="/user/{{ $user->id }}" method="POST">
                            <a href="/user/{{ $user->id }}/edit" class="btn btn-success">Edit User</a>

                            <button type="submit" class="btn btn-danger">Delete User</button>
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection