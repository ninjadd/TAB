@extends('layouts.app')

@section('head')
    @include('shared.datatables')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('shared.errors')
                @include('shared.session')

                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left">
                            Users
                        </h3>
                        <a href="/user/create" class="btn btn-info btn-sm pull-right">New User</a>
                    </div>

                    <div class="panel-body">

                        <table class="table table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Member Since</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        {{ ucfirst($user->role) }}
                                    </td>
                                    <td>
                                        {{ $user->created_at->toDayDateTimeString() }}
                                    </td>
                                    <td>
                                        <div class="hidden">{{ $user->id }}</div>
                                        <form action="/user/{{ $user->id }}" method="POST">
                                            <div class="btn-group">
                                                <a href="/user/{{ $user->id }}/edit" class="btn btn-success btn-xs"  data-toggle="tooltip" title="Edit User">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                </a>

                                                <button type="submit" class="btn btn-danger btn-xs"  data-toggle="tooltip" title="Delete User">
                                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                </button>
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
