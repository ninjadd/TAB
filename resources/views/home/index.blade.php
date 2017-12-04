@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            @include('shared.session')

            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Dashboard
                    </h3>
                </div>

                <div class="panel-body">
                    <div class="row">
                        @if(empty($organization))
                            <div class="col-md-4">
                                <p class="lead">Your Dashboard</p>
                                <p>Thank you for creating an account with TAB</p>
                                <p>
                                    Let's get started with building your Company
                                </p>
                                <p>
                                    <a href="/organizations/create" class="btn btn-sm btn-info">Start</a>
                                </p>
                            </div>
                        @else
                            @switch($user->roles->first()->name)
                                @case('admin')
                                        @include('home.admin.index')
                                    @break
                                @default

                            @endswitch
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
