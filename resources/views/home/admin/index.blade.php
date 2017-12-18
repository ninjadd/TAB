@include('shared.editor')

<div class="container-fluid">
    <div class="col-md-4">
        <div class="panel panel-success">
            <div class="panel-heading">
                {{ $user->name }} Settings
            </div>

            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        {{ $user->email }}
                    </li>
                    <li class="list-group-item">
                        {{ $user->title }}
                    </li>
                    <li class="list-group-item">
                        Member Since:
                        {{ $user->created_at->toFormattedDateString() }}
                    </li>
                    <li class="list-group-item">
                        <a class="btn btn-xs btn-success" href="/users/{{ $user->id }}/edit">Update</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-success">
            <div class="panel-heading clearfix">
                <h3 class="panel-title pull-left">
                    Users Settings
                </h3>
                <span class="pull-right"><a class="btn btn-xs btn-primary" href="/organizations/users/create">Add User</a></span>
            </div>

            <div class="panel-body" style="max-height: 220px;overflow-y: scroll;">
                <ul class="list-group">
                    @foreach($organization->users as $user)
                        <li class="list-group-item">
                            {{ $user->name }}
                            <a class="btn btn-xs btn-success pull-right" href="/users/{{ $user->id }}/edit">Update</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-success">
            <div class="panel-heading clearfix">
                <h3 class="panel-title pull-left">
                    {{ $organization->name }} Settings
                </h3>
                <span class="pull-right"><a class="btn btn-xs btn-primary" href="/divisions/create">Add New</a></span>
            </div>

            <div class="panel-body" style="min-height: 220px; max-height: 220px;overflow-y: scroll;">
                <ul class="list-group">
                    @foreach($divisions as $division)
                        <li class="list-group-item">
                            {{ $division->title }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    @if(!empty($divisions))
        @foreach($divisions as $division)
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left">
                            {{ $division->title }}
                        </h3>
                        <span class="badge pull-right">
                            {{ $division->assignedTo->name }}
                        </span>
                    </div>

                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <p>{{ $division->description }}</p>
                                <form action="/divisions/{{ $division->id }}" method="POST">
                                    <a class="btn btn-xs btn-success" href="/divisions/{{ $division->id }}/edit">Update</a>
                                    <a href="/divisions/{{ $division->id }}/departments/create" class="btn btn-xs btn-primary">
                                        Manage
                                        <span class="badge">{{ $division->departments->count() }}</span>
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-xs">
                                        Delete
                                    </button>
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target=".{{ $division->id }}-modal">Best Practice</button>
                                </form>
                            </li>
                        </ul>

                        <div class="modal fade {{ $division->id }}-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">
                                            Add Best Practice for the {{ $organization->name }} > {{ $division->title }}
                                        </h4>
                                    </div>
                                    <form class="form-horizontal" action="/knowledge-bases" method="POST" autocomplete="off">
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            <fieldset>
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <label for="inputTitle" class="control-label">Title</label>
                                                        <input type="text" name="title" required="required" value="{{ old('title') }}" class="form-control" id="inputTitle" placeholder="This is a great best practice">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <label for="textAreaDescription" class="control-label">Body</label>
                                                        <textarea required="required" name="body" class="form-control modalText" id="textArea" placeholder="">{{ old('body') }}</textarea>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="level_id" value="App\Division|{{ $division->id }}">
                                            <input type="hidden" name="home" value="true">
                                            <button type="submit" class="pull-left btn btn-primary">Add</button>
                                            <button type="button" class="pull-left btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>