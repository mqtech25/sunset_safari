@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<div class="app-title">
	<h1><i class="fa fa-files-o"></i> {{ $pageTitle }} </h1>
	<a href="{{ route('admin.item.create') }}" class="btn btn-primary">Create New Menu-Item </a>
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
							<th class="text-center"> Title </th>
							<th class="text-center"> Parent </th>
							<th class="text-center"> Page Slug </th>
							<th class="text-center"> Created At </th>
							<th class="text-center"> Updated At </th>
							<th style="width: 100px; min-width: 100px;" class="text-center text-danger">
								<i class="fa fa-bolt"></i>
							</th>

						</tr>
					</thead>
					<tbody>
						@foreach($aboutItem as $menuItem)
						<tr>
							<td class="text-center"> {{ $loop->iteration }} </td>
							<td class="text-center"> {{ $menuItem->name }}</td>
							<td class="text-center"> <span class="badge badge-success">{{(isset($aboutItem[$menuItem->parent])) ? $aboutItem[$menuItem->parent]->name : "No Parent"}}</span></td>
							<td class="text-center"> <span class="badge badge-success">{{$menuItem->slug}}</span></td>
							<td class="text-center"> {{ $menuItem->created_at}}</td>
							<td class="text-center"> {{ $menuItem->updated_at}}</td>
							
							<td class="text-center"> 
								<div class="btn-group">
									<a href="{{ route('admin.item.edit', $menuItem->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a> 
									<a href="{{route('admin.item.delete',$menuItem->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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