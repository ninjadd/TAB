@extends('layouts.app')

@section('head')
    @include('shared.datatables')
@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('shared.session')

                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left">
                            KnowledgeBase
                        </h3>
                        <a class="btn btn-xs btn-primary pull-right" href="/knowledge-bases/create">New</a>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Level</th>
                                <th>Managed by</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th width="150"></th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Level</th>
                                <th>Managed by</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th></th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @if($knowledgeBases->count() > 0)
                                @foreach($knowledgeBases as $knowledgeBase)
                                    <tr>
                                        <td>
                                            {{ $knowledgeBase->id }}
                                        </td>
                                        <td>
                                            {{ $knowledgeBase->title }}
                                        </td>
                                        <td>
                                            {{ $knowledgeBase->levelable->title }}
                                        </td>
                                        <td>
                                            {{ $knowledgeBase->levelable->assignedTo->name }}
                                        </td>
                                        <td>
                                            {{ $knowledgeBase->created_at->toDayDateTimeString() }}
                                        </td>
                                        <td>
                                            {{ $knowledgeBase->updated_at->toDayDateTimeString() }}
                                        </td>
                                        <td>
                                            <form action="/knowledge-bases/{{ $knowledgeBase->id }}" method="POST">
                                                <a class="btn btn-xs btn-success" href="/knowledge-bases/{{ $knowledgeBase->id }}/edit">Update</a>
                                                <a class="btn btn-xs btn-default" href="/knowledge-bases/{{ $knowledgeBase->id }}">View</a>
                                                <button type="submit" class="btn btn-danger btn-xs"  data-toggle="tooltip">
                                                    Delete
                                                </button>
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection