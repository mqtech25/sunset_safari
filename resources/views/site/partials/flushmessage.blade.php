<div class="row mt-3">
    <div class="col-sm-12">
        @if(Session::has('message'))
        <p class="alert alert-success">{{ Session::get('message') }}</p>
        @elseif(Session::has('error'))
        <p class="alert alert-danger">{{ Session::get('error') }}</p>
        @endif
    </div>
</div>