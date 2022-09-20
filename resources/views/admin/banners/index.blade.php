@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<div class="app-title">
	<h1><i class="fa fa-shopping-bag"></i> {{ $pageTitle }} </h1>
	<a href="{{ route('admin.banners.create') }}" class="btn btn-primary">Add Banner </a>
</div>
@include('admin.partials.flash')
<div class="row">
	<div class="col-md-12">
		<div class="tile">
			<div class="title-body">
				<table class="table table-hover table-bordered" id="sampleTable">
					<thead>
						<tr>
							<th> # </th>
							<th> Image </th>
							<th> Title </th>
							<th class="text-center"> Sub Title </th>
							<th class="text-center"> Status </th>
							<th class="text-center"> Order </th>
							<th style="width: 100px; min-width: 100px;" class="text-center text-danger">
								<i class="fa fa-bolt"></i>
							</th>

						</tr>
					</thead>
					<tbody>
						@foreach($banners as $banner)
						<tr>
							<td> {{ $loop->iteration }} </td>
							<td> <img width="100px" src="{{asset('storage/'.$banner->banner_image)}}" alt=""> </td>
							<td> {{ $banner->banner_title }}</td>
							<td> {{ $banner->banner_subtitle}}</td>
							<td> {{ $banner->banner_status == '0' ? "Disabled" : "Enabled" }}</td>
							<td> {{ $banner->banner_order}}</td>
							
							<td class="text-center"> 
								<div class="btn-group">
									<a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a> 
									<a href="{{route('admin.banners.delete',$banner->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
<script type="text/javascript">$('#sampleTable').dataTable();</script>
@endpush