@extends('admin.app')
@section('title') {{ $pageTitle}}@endsection
@section('content')

<div class="app-title">
	<div>
		<h1><i class="fa fa-sitemap mr-2"></i>{{ $pageTitle}}</h1>
		<p> {{ $subTitle }} </p>
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
							<th class="text-center"> Slug </th>
							<th class="text-center"> Created At </th>
							<th class="text-center"> Updated At </th>
							<th style="width: 100px; min-width: 100px;" class="text-center text-danger"><i class="fa fa-bolt"></i></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($menuItems as $item)
						<tr>
							<td class="text-center">{{$item->id}}</td>
							<td class="text-center">{{$item->title}}</td>
							<td class="text-center">
								<span class="badge badge-success">{{$item->slug}}</span>
							</td>
							<td class="text-center">
								{{$item->created_at}} 
							</td>
							<td class="text-center">
								{{$item->updated_at}} 
							</td>
							<td class="text-center">
								<div class="btn-group" role="group" aria-label="Second group">
									<a href="" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
									<a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
								</div>
							</td>
						</tr>
						@endforeach
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