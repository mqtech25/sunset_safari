@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<div class="app-title">
	<h1><i class="fa fa-shopping-bag"></i> {{ $pageTitle }} </h1>
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
							<th> Order # </th>
							<th> Status </th>
							<th> Order Status </th>
							<th class="text-center"> Total Amount </th>
							<th class="text-center"> Payment Status </th>
							<th class="text-center"> Payment Method </th>
							<th class="text-center"> First Name </th>
							<th class="text-center"> Last Name </th>
							<th class="text-center"> Phone # </th>
							<th class="text-center"> City </th>
							<th class="text-center"> Country </th>
							<th style="width: 100px; min-width: 100px;" class="text-center text-danger">
								<i class="fa fa-bolt"></i>
							</th>

						</tr>
					</thead>
					<tbody>
						@foreach($orders as $order)
						<tr>
							<td> {{ $loop->iteration }} </td>
							<td> {{ $order->order_number }} </td>
							<td> {{$order->status}} </td>
							<td class="text-center">{!! $order->order_status == 0 ? "<span class='badge badge-danger'>NEW</span>" : '' !!}</td>
							<td> {{ $order->grand_total }}</td>
							<td> {{ $order->payment_status == 1 ? 'Paid' : 'Pending' }}</td>
							<td> {{ $order->payment_method }}</td>
							<td> {{ $order->first_name }}</td>
							<td> {{ $order->last_name }}</td>
							<td> {{ $order->phone_number }}</td>
							<td> {{ $order->city }}</td>
							<td> {{ $order->country }}</td>
							<td class="text-center"> 
								<div class="btn-group">
									<a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
									<a href="{{ route('admin.order.delete', $order->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
<script type="text/javascript">

	$('#sampleTable').dataTable();
</script>
@endpush