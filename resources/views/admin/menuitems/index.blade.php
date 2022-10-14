@extends('admin.app')
@section('title')  @endsection
@section('content')

<div class="app-title">
	<div>
		<h1><i class="fa fa-sitemap mr-2"></i>Menu Items</h1>
		<p>  </p>
	</div>
	<a href="{{ route('admin.menuitems.create') }}" class="btn btn-primary pull-right">Create New Item</a>
</div>

@include('admin.partials.flash')

<div class="row">
	<div class="col-md-12">
		<div class="tile">
			<div class="tile-body table-responsive">
				<table class="table table-hover table-bordered" id="sampleTable">
					<thead>
						<tr>
							<th class="text-center"> # </th>
							<th class="text-center"> Title </th>
							<th class="text-center"> Parent </th>
							<th class="text-center"> Page Slug </th>
							<th class="text-center"> Created At </th>
							<th class="text-center"> Updated At </th>
							<th style="width: 100px; min-width: 100px;" class="text-center text-danger"><i class="fa fa-bolt"></i></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-center">2</td>
							<td class="text-center">Game</td>
							<td class="text-center">
								<span class="badge badge-success">Home</span>
							</td>
							<td class="text-center">
								<span class="badge badge-success">Sub page link</span>
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
						</tr>
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