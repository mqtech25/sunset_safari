@extends('admin.app')
@section('title')  @endsection
@section('content')

<div class="app-title">
	<div>
		<h1><i class="fa fa-tags mr-2"></i></h1>
	</div>
	{{-- <a href="{{ route('admin.createmenu.create') }}" class="btn btn-primary pull-right">Create New Menu</a> --}}
</div>

@include('admin.partials.flash')
<form action="{{ route('admin.createmenu.store') }}" method="POST" role="form" enctype="multipart/form-data">
	@csrf
	<div class="row">
			<div class="col-md-12">
				<div class="tile">
					<h3 class="tile-title">Create Menu</h3>
				</div>
			</div>
	</div>
</form>
<div class="row">
	<div class="col-md-6">
		<div class="tile">
			<h3 class="tile-title">Add Menu Items</h3>
            <hr>
        <div class="accordion" id="menuItems">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    Categories
                  </button>
                </h5>
              </div>
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    <form action="">
                        <div class="animated-checkbox">
                            <label>
                                  <input type="checkbox"><span class="label-text">Checkbox</span>
                            </label>
                            <label>
                                <input type="checkbox"><span class="label-text">Checkbox</span>
                            </label>
                        </div>
                    </form>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="false" aria-controls="collapseTwo">
                    Posts
                  </button>
                </h5>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
              Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingThree">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                    data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Custom Links
                  </button>
                </h5>
              </div>
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
              Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                </div>
              </div>
            </div>
          </div>
		</div>
	</div>
    <div class="col-md-6">
		<div class="tile">
			<h3 class="tile-title"></h3>

		</div>
	</div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush