@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('shared.errors')

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Viewing {{ $knowledgeBase->title }}
                        </h3>
                    </div>

                    <div class="panel-body">
                        {!! $knowledgeBase->body !!}
                    </div>

                    <div class="panel-footer">
                        <form action="/knowledge-bases/{{ $knowledgeBase->id }}" method="POST">
                            <a class="btn btn-xs btn-success" href="/knowledge-bases/{{ $knowledgeBase->id }}/edit">Update</a>
                            <button type="submit" class="btn btn-danger btn-xs"  data-toggle="tooltip">
                                Delete
                            </button>
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection