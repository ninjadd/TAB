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
                        <div class="col-md-4">
                            @if(empty($organization))
                                <p class="lead">Organization Information</p>
                                <p>You need to set up your organization</p>
                                <p><a href="/organizations/create" class="btn btn-info btn-sm">Add</a></p>
                            @else
                                <p class="lead">Organization Information</p>
                                <p><em>Name:</em> {{ $organization->name }}</p>
                                <p><em>Description:</em><br>{!! $organization->description !!}</p>
                                <p><a href="/organizations/{{ $organization->id }}/edit" class="btn btn-success btn-sm">Edit</a></p>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <p class="lead">Account Information</p>
                            <p><em>Title:</em> {{ auth()->user()->role->name }}</p>
                            <p><em>Description:</em> {{ auth()->user()->role->description }}</p>
                            {{--<p><a href="/organizations/{{ auth()->user()->organization[0]->id }}/edit" class="btn btn-success btn-sm">Edit</a></p>--}}
                        </div>
                        <div class="col-md-4">
                            <p class="lead">Staff Listing</p>
                            <p>This is where the account form will be.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
