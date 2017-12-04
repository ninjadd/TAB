@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('shared.errors')

                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Add your role in {{ auth()->user()->organizations->first()->name }}
                        </h3>
                    </div>

                    <div class="panel-body">

                        <form class="form-horizontal" action="/users/{{ auth()->user()->id }}" method="POST" autocomplete="off">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <fieldset>
                                <div class="form-group">
                                    <label for="inputName" class="col-lg-2 control-label">Name</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="name" required="required" value="{{ auth()->user()->name }}" class="form-control" id="inputName" placeholder="User Name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputTitle" class="col-lg-2 control-label">Title</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="title" required="required" value="{{ old('title')  }}" class="form-control" id="inputTitle" placeholder="CEO, Founder etc.">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="textAreaDescription" class="col-lg-2 control-label">Description</label>
                                    <div class="col-lg-10">
                                        <textarea required="required" name="description" class="form-control" id="textAreaDescription" placeholder="Um? What would you say you do here?">{{ old('description') }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <button type="submit" class="btn btn-info">Next</button>
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
