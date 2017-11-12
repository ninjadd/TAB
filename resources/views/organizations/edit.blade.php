@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('shared.errors')

                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Edit Organizational Information
                        </h3>
                    </div>

                    <div class="panel-body">

                        <form class="form-horizontal" action="/organizations/{{ $organization->id }}" method="POST" autocomplete="off">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <fieldset>
                                <div class="form-group">
                                    <label for="inputName" class="col-lg-2 control-label">Organization Name</label>
                                    <div class="col-lg-10">
                                        <input type="text" required="required" name="name" value="{{ $organization->name }}" class="form-control" id="inputName" placeholder="Some Awesome Company">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="textAreaDescription" class="col-lg-2 control-label">Organization Description</label>
                                    <div class="col-lg-10">
                                        <textarea name="description" required="required" class="form-control" id="textAreaDescription" placeholder="Please provide a short description of your organization" rows="3">{{ $organization->description }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <button type="submit" class="btn btn-success">Update</button>
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