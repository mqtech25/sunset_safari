<div class="tile">
    <form action="{{ route('admin.settings.update') }}" method="POST" role="form" enctype="multipart/form-data">
        @csrf
        <h3 class="tile-title mt-5">Banner</h3>
        <hr>
        <div class="tile-body">
            <div class="row">
                <div class="col-2">
                    <input class="form-control" type="number" name="banner_width" placeholder="Banner Width" value="{{ config('settings.banner_width') }}"/>
                </div>
                <div class="col-2">
                    <input class="form-control" type="number" name="banner_height" placeholder="Banner Height" value="{{ config('settings.banner_height') }}"/>
                </div>
            </div>
        </div>
        <div class="tile-footer">
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Settings</button>
                </div>
            </div>
        </div>
    </form>
</div>
@push('scripts')
    <script>
        loadFile = function(event, id) {
            var output = document.getElementById(id);
            output.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endpush