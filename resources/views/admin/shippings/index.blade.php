@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')

<div class="app-title">
	<div>
		<h1><i class="fa fa-truck"></i>{{ $pageTitle }}</h1>
		<p> {{ $subTitle }} </p>
	</div>
	<button id="addShippingCountryBtn" class="btn btn-primary pull-right">Add Shipping Country</button>
</div>

@include('admin.partials.flash')

<div class="row">
	<dev class="col-md-12">
		<div class="tile">
			<div class="tile-body">
				<table class="table table-hover table-bordered" id="sampleTable">
					<thead>
						<tr>
							<th> # </th>
							<th> Name </th>
							<th> Code </th>
							<th> Shipping Status </th>
							<th style="width: 200px; min-width: 100px" class="text-center text-danger"> <i class="fa fa-bolt"></i></th>
						</tr>
					</thead>
					<tbody>
						@foreach($shippingCountries as $key=>$ship_country)
						<tr>
							<td> {{ $key+1 }} </td>
							<td> {{ $ship_country->name }} </td>
							<td> {{ $ship_country->code }}</td>
							<td> 
								<div class="toggle">
									<label>
										<input value="{{$ship_country->id}}" class="toggle_status" type="checkbox" {{ $ship_country->shipping_status==1 ? 'checked' :'' }}><span class="button-indecator"></span>
									</label>
								</div>
							</td>
							<td class="text-center">
								<div class="btn-group" role="group" aria-label="Second group">
									<a href="{{ route('admin.shippingrules.index', $ship_country->id)}}" class="btn btn-sm btn-primary">Manage Rules</a>
									<a href="{{ route('admin.shippingcountry.delete', $ship_country->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</dev>
</div>

<!-- add shipping country Modal -->
<div class="modal fade" id="shipping_country_modal" tabindex="-1" role="dialog" aria-labelledby="shipping_country_modalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Shipping Country</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
	  </div>
	  <form action="{{route('admin.shipping.addcountry')}}" method="POST" id="addCountryForm">
		<div class="modal-body">
			@csrf
			<div class="form-row">
				<div class="col-4">
					<div class="form-group">
						<label class="form-label">Code</label>
						<input type="text" class="form-control" disabled name="code" id="code">
					</div>
				</div>
				<div class="col-8">
					<div class="form-group">
						<label class="form-label">Name</label>
						<select name="country_id" id="country_id" class="form-control">
							<option value="0">Select Country</option>
							@foreach ($countries as $country)
								<option data-code='{{$country->code}}' value="{{$country->id}}">{{$country->name}}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
			
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
			<button type="submit" class="btn btn-success">SAVE</button>
		</div>
	  </form>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>
<script>
	$('#addShippingCountryBtn').on('click',function(){
		$('#shipping_country_modal').modal('show');
	})

	$("#country_id").on('change', function(){
		$('#code').val($('option:selected',this).data('code'));
	});

	$('.toggle_status').on('change', function(){
		var status = $(this).is(":checked")? 1 : 0;
		var id = $(this).val();
		$.ajax({
			type: "post",
			url: "{{route('admin.shipping.countrystatus')}}",
			data: {country_id:id, status:status,_token:'{{csrf_token()}}'},
			success: function (response) {
				data = JSON.parse(response);
				if(data.request_status == 'success'){
					swal("Updated!", data.message, "success");
				}else{
					swal("Error!", data.message, "error");
				}
			}
		});
	});
</script>
@endpush