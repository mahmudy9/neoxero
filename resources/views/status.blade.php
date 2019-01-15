@if(Session::has('info'))

    <div class="alert alert-info">
        <p>{{session('info')}}</p>
    </div>

@endif


@if(Session::has('error'))

    <div class="alert alert-danger">
        <p>{{session('error')}}</p>
    </div>

@endif