@extends('admin.app')
@section('title') {{ $pageTitle}} @endsection
@section('content')

<div class="app-title">
	<div>
		<h1><i class="fa fa-tags mr-2"></i>{{ $pageTitle}}</h1>
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
					<hr>

						<div class="tile-body">
							<div class="row">
								<div class="col-md-10"></div>
							</div>
							<label class="control-label" for="title"> Title <span class="m-l-5 text-danger"> *</span></label>
							<div class="input-group">
								<input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="" placeholder="Enter Menu Title"/>
								<button class="btn btn-primary"><i class="fa fa-plus fa-lg fa-check-circle"></i>Create Menu</button>
								@error('title') {{ $message }} @enderror
							</div>
						</div>
				</div>
			</div>
	</div>
</form>
<div class="row">
	<div class="col-md-12">
		<div class="tile">
			<h3 class="tile-title">{{ $subTitle }} </h3>
			<div class="tile-body table-responsive">
				<table class="table table-hover table-bordered" id="sampleTable">
					<thead>
						<tr>
							<th class="text-center"> # </th>
							<th class="text-center"> Title </th>
							<th class="text-center"> Items </th>
							<th class="text-center"> Created At </th>
							<th class="text-center"> Updated At </th>
							<th style="width: 100px; min-width: 100px;" class="text-center text-danger"><i class="fa fa-bolt"></i></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($menu as $menus)
								<tr>
									<td class="text-center">{{$menus->id}}</td>
									<td class="text-center">{{$menus->title}}</td>
									<td class="text-center">
										@if($menus->items > 0)
										<span class="badge badge-success">{{$menus->items}}</span>
										@else
										<span class="badge badge-danger">No</span>
										@endif
									</td>
									<td class="text-center">{{$menus->created_at}}</td>
									<td class="text-center">{{$menus->updated_at}}</td>
									<td class="text-center">
										<div class="btn-group" role="group" aria-label="Second group">
											<a href="{{ route('admin.createmenu.edit', $menus->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
											<a href="{{ route('admin.createmenu.delete', $menus->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
										</div>
									</td>
								</tr>
						@endforeach
						{{-- <tr>
							<td class="text-center">2</td>
							<td class="text-center">Primary Menu</td>
							<td class="text-center">Published</td>
							<td class="text-center">
								<span class="badge badge-success">Primary</span>
							</td>
							<td class="text-center">
								<span class="badge badge-success">Home</span>
							</td>
							<td class="text-center">
								Time 
							</td>
							<td class="text-center">
								Time 
							</td>
							<td class="text-center">
								<div class="btn-group" role="group" aria-label="Second group">
									<a href="" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
									<a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
								</div>
							</td>
						</tr> --}}
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush