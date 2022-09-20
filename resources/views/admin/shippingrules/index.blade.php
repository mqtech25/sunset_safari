@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')

<div class="app-title">
	<div>
		<h1><i class="fa fa-truck"></i>{{ $pageTitle }}</h1>
		<p> {{ $subTitle }} </p>
	</div>
	<button id="addShippingRuleBtn" class="btn btn-primary pull-right">Add Shipping Rule</button>
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
							<th> Min Weight </th>
							<th> Max Weight </th>
							<th> Shipping Amount </th>
							<th> Status </th>
							<th style="width: 200px; min-width: 100px" class="text-center text-danger"> <i class="fa fa-bolt"></i></th>
						</tr>
					</thead>
					<tbody>
						@foreach($shippingRules as $key=>$ship_rule)
						<tr>
							<td> {{ $key+1 }} </td>
							<td> {{ $ship_rule->min_weight }} </td>
							<td> {{ $ship_rule->max_weight }}</td>
							<td> {{ $ship_rule->shipping_amount }}</td>
							<td> 
								<div class="toggle">
									<label>
										<input value="{{$ship_rule->id}}" class="toggle_status" type="checkbox" {{ $ship_rule->status==1 ? 'checked' :'' }}><span class="button-indecator"></span>
									</label>
								</div>
							</td>
							<td class="text-center">
								<div class="btn-group" role="group" aria-label="Second group">
									<a href="#" data-rule_edit_id = "{{ $ship_rule->id}}" class="btn btn-sm btn-primary edit_rule_btn"><i class="fa fa-edit"></i></a>
									<a href="#" data-rule_route = "{{ route('admin.shippingrule.delete', $ship_rule->id)}}" class="btn btn-sm btn-danger delete_rule_btn"><i class="fa fa-trash"></i></a>
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

<!-- add shipping rule Modal -->
<div class="modal fade" id="shipping_rule_modal" tabindex="-1" role="dialog" aria-labelledby="shipping_rule_modalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Shipping Rule</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
	  </div>
	  <form action="{{route('admin.shipping.addrule')}}" method="POST" id="rule_form">
		<div class="modal-body">
			@csrf
			<input type="hidden" name="country_id" id="country_id" value="{{$country_id}}">
			<input type="hidden" name="rule_id" id="rule_id" value="{{$country_id}}">
			<div class="form-row">
				<div class="form-row">
					<div class="col-4">
						<div class="form-group">
							<label for="" class="form-label">Min Weight</label>
							<input required type="number" step=".01" name="min_weight" id="min_weight" class="form-control appearance-text-field">
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="" class="form-label">Max Weight</label>
							<input required type="number" step=".01" name="max_weight" id="max_weight" class="form-control appearance-text-field">
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="" class="form-label">Shipping Amount</label>
							<input required type="number" step=".01" name="shipping_amount" id="shipping_amount" class="form-control appearance-text-field">
						</div>
					</div>
				</div>
			</div>
			
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
			<button type="submit" class="btn btn-success" id="save_btn">SAVE</button>
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
	$('#addShippingRuleBtn').on('click',function(){
		$('#min_weight').val('');
		$('#max_weight').val('');
		$('#shipping_amount').val('');
		$("#save_btn").text('SAVE');
		$("#exampleModalLongTitle").text('Add Shipping Rule');
		$('#shipping_rule_modal').modal('show');
	})

	$('.delete_rule_btn').on('click',function(e){
		e.preventDefault();
		swal({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to recover this data!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					window.location.href = $(this).data('rule_route');
				}
			});
	});

	$('.edit_rule_btn').on('click', function(e){
		e.preventDefault();
		var rule_id = $(this).data('rule_edit_id');
		$.ajax({
			type: "post",
			url: "{{route('admin.shipping.getruleedit')}}",
			data: {rule_id:rule_id,_token:'{{csrf_token()}}'},
			success: function (response) {
				data = JSON.parse(response);
				console.log(data);
				$('#country_id').val(data.shipping_country_id);
				$('#rule_id').val(rule_id);
				$('#min_weight').val(data.min_weight);
				$('#max_weight').val(data.max_weight);
				$('#shipping_amount').val(data.shipping_amount);
				$("#save_btn").text('UPDATE');
				$("#exampleModalLongTitle").text('Update Shipping Rule');
				$('#shipping_rule_modal').modal('show');
			}
		});
	});

	$('.toggle_status').on('change', function(){
		var status = $(this).is(":checked")? 1 : 0;
		var id = $(this).val();
		$.ajax({
			type: "post",
			url: "{{route('admin.shipping.rulestatus')}}",
			data: {rule_id:id, status:status,_token:'{{csrf_token()}}'},
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

	$("#save_btn").on('click',function(e){
		if($("#save_btn").text() == 'UPDATE'){
			e.preventDefault();
			var formData = $('#rule_form').serialize();
			$.ajax({
				type: "post",
				url: "{{route('admin.shipping.updateruledata')}}",
				data: formData,
				success: function (response) {
					data = JSON.parse(response);
					if(data.request_status == 'success'){
						swal("Updated!", data.message, "success")
						.then((value)=>{
							location.reload();
						});
					}else{
						swal("Error!", data.message, "error");
					}
				}
			});
			
			$('#shipping_rule_modal').modal('hide');
		}
	});
</script>
@endpush