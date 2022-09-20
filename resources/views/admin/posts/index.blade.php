@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<div class="app-title">
	<h1><i class="fa fa-thumb-tack"></i> {{ $pageTitle }} </h1>
	<a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Add Post </a>
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
							<th class="text-center"> Description </th>
							<th class="text-center"> Posted by </th>
							<th class="text-center"> Created Date </th>
							<th class="text-center"> Modified Date </th>
							<th style="width: 100px; min-width: 100px;" class="text-center text-danger">
								<i class="fa fa-bolt"></i>
							</th>

						</tr>
					</thead>
					<tbody>
						@foreach($posts as $post)
						<tr>
							<td> {{ $loop->iteration }} </td>
							<td> {{ $post->title }}</td>
							<td> {{ str_limit($post->description, $limit = 100, $end = '.....') }}</td>
							<td> {{ $post->creater->name}}</td>
							<td> {{ $post->created_at->format('d-m-Y')}}</td>
							<td> {{ $post->updated_at->format('d-m-Y')}}</td>
							
							<td class="text-center"> 
								<div class="btn-group"> 
									<a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a> 
									<a href="{{route('admin.posts.delete',$post->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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