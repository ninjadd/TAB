@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('shared.errors')

                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Add Organizational Information
                        </h3>
                    </div>

                    <div class="panel-body">

                        <form class="form-horizontal" action="/organizations" method="POST" autocomplete="off">
                            {{ csrf_field() }}
                            <fieldset>
                                <div class="form-group">
                                    <label for="inputName" class="col-lg-2 control-label">Organization Name</label>
                                    <div class="col-lg-10">
                                        <input type="text" required="required" name="name" value="{{ old('name') }}" class="form-control" id="inputName" placeholder="Some Awesome Company">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="textAreaDescription" class="col-lg-2 control-label">Organization Description</label>
                                    <div class="col-lg-10">
                                        <textarea name="description" required="required" class="form-control" id="textAreaDescription" placeholder="Please provide a short description of your organization" rows="3">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <button type="submit" class="btn btn-info">Save</button>
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