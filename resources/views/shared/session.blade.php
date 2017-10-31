@if (session('success'))

    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4>Sweet!</h4>
        <p>{{ session('success') }}</p>
    </div>

@endif


@if (session('warning'))

    <div class="alert alert-dismissible alert-warning">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4>Well there you go</h4>
        <p>{{ session('warning') }}</p>
    </div>

@endif

@if (session('info'))

    <div class="alert alert-dismissible alert-info">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4>Hmm</h4>
        <p>{{ session('info') }}</p>
    </div>

@endif
