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
                            <p class="lead">You Dashboard</p>
                            <p>This is where the account form will be.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
