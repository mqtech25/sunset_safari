@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<div class="app-title">
	<h1><i class="fa fa-files-o"></i> {{ $pageTitle }} </h1>
	<a href="{{ route('admin.pages.create') }}" class="btn btn-primary">Create New Page </a>
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
							<th> Title </th>
							<th class="text-center"> Status </th>
							<th class="text-center"> Created At </th>
							<th class="text-center"> Updated At </th>
							<th style="width: 100px; min-width: 100px;" class="text-center text-danger">
								<i class="fa fa-bolt"></i>
							</th>

						</tr>
					</thead>
					<tbody>
						@foreach($pages as $page)
						<tr>
							<td> {{ $loop->iteration }} </td>
							<td> {{ $page->page_title }}</td>
							<td> {{ $page->page_status == '1' ? "Published" : "Draft" }}</td>
							<td> {{ $page->created_at}}</td>
							<td> {{ $page->updated_at}}</td>
							
							<td class="text-center"> 
								<div class="btn-group">
									<a href="{{ route('pages.show', $page->page_slug) }}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a> 
									<a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a> 
									<a href="{{route('admin.pages.delete',$page->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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