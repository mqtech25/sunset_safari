@extends('site.app')
@section('title', 'Profile')

@section('content')

<div class="container">
    @include('site.partials.flushmessage')
    <div class="row mt-4">
        <div class="col-3">
            @include('site.partials.usersidebar')
        </div>
        <div class="col-9">
            <div class="profile-tile pb-4">
                <p class="text-right"><a href="#" class="btn btn-success m-3" id="add_new_address">Add Address</a></p>
                <div class="title-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th> Name </th>
                                <th> Address </th>
                                <th class="text-center text-danger">
                                    <i class="fa fa-bolt"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\Auth::user()->address()->where('is_primary',0)->get() as $address)
                            <tr>
                                <td> {{ $address->first_name.' '.$address->last_name }} </td>
                                <td> {{ $address->address}},{{ $address->city }},{{ $address->state }},{{ $address->country }}</td>
                                <td class="text-center"> 
                                    <a title="Edit address" href="#" class="" data-address_id="{{$address->id}}" id="edit_address"><i class="fas fa-edit text-success"></i></i></a>
                                    <a title="Delete address" href="{{route('customer.addresses.remove',$address->id)}}" class=""><i class="fas fa-trash text-danger"></i></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Passowrd Modal -->
<div class="modal fade" id="passwordModel" tabindex="-1" role="dialog" aria-labelledby="passwordModelTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <form action="{{route('update.customer.password')}}" method="POST" id="pass_form">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-lock"></i> Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="" class="form-label">Current Password</label>
                            <input type="password" required class="form-control" name="current_password" id="current_password">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="" class="form-label">New Password</label>
                            <input type="password" required class="form-control" name="new_password" id="new_password">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="" class="form-label">Confirm</label>
                            <input type="password" required class="form-control" name="confirm_password" id="confirm_password">
                            <span id="mismatch-error"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="submit_pass" class="btn btn-success">Update</button>
            </div>
        </form>
    </div>
  </div>
</div>
<!-- new shipping address model -->
<div class="modal fade" id="shippin_address_modal" tabindex="-1" role="dialog" aria-labelledby="shippin_address_modalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="shippin_address_modalTitle">Add Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form action="{{route('save.address')}}" method="POST" id="saveAddressForm">
		@csrf
		<input type="hidden" name="add_shipping_user_id" value="{{\Auth::user()->id}}">
		<input type="hidden" name="update_id" id="update_id">
		  <div class="modal-body">
			<div class="form-row">
				<div class="col form-group">
					<label for="add_shipping_first_name">First Name</label>
					<input type="text" class="form-control" name="add_shipping_first_name" id="add_shipping_first_name" value="" required>
				</div>

				<div class="col form-group">
					<label for="add_shipping_last_name">Last Name</label>
					<input type="text" class="form-control" name="add_shipping_last_name" id="add_shipping_last_name" value="" required>
				</div>
			</div>
			<div class="form-group">
				<label for="add_shipping_address">Address</label>
				<input type="text" class="form-control" name="add_shipping_address" id="add_shipping_address" value="" required>
			</div>
			<div class="form-group">
				<label for="add_shipping_address">Address Line 2</label>
				<input type="text" class="form-control" name="add_shipping_addressline2" id="add_shipping_addressline2" value="">
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="add_shipping_post_code">Zip Code</label>
					<input type="text" class="form-control" name="add_shipping_post_code" id="add_shipping_post_code"  value="" required>
				</div>
				<div class="lform-group col-md-6">
					<label for="add_shipping_phone_number">Phone Number</label>
					<input type="text" class="form-control" name="add_shipping_phone_number" id="add_shipping_phone_number" value="" required>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-4">
					<label for="add_shipping_country">Country</label>
					<input type="hidden" name="add_shipping_country" id="add_shipping_country" required>
					<select id="add_shipping_country_options" class="form-control @error('country') is-invalid @enderror" name="add_shipping_country_options">
						<option> Choose...</option>
						@foreach ($countries as $country)
							<option value="{{$country->id}}">{{$country->name}}</option>
						@endforeach
					</select>
					@error('country')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>
				<div class="form-group col-md-4">
					<label for="add_shipping_state">State</label>
					<select required id="add_shipping_state" class="form-control @error('state') is-invalid @enderror" name="add_shipping_state"></select>
					@error('state')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>
				<div class="form-group col-md-4">
					<label for="city">City</label>
					<input required type="text" class="form-control" name="add_shipping_city" id="add_shipping_city" value="">
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
<script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<script type="text/javascript">

	$(document).ready(function() {
		
		$('#sampleTable').DataTable();

        $("#add_new_address").on('click',function(){
            $("#update_id").val(0);
            $("#shippin_address_modal").modal('show');
        });

        $("#add_shipping_country_options").change(function(){
            var country_id = $(this).val();
            var country_name = $("#add_shipping_country_options option:selected").text();
            $("#add_shipping_country").val(country_name);
            $.ajax({
                type: "post",
                url: "{{route('getstates')}}",
                data: {id:country_id, _token:'{{csrf_token()}}'},
                success: function (data) { 
                    var states = JSON.parse(data);
                    var stateOptions ='<option>Choose State</option>';
                    states.forEach(function(item,index){
                        stateOptions+= "<option value='"+item.name+"'>"+item.name+"</option>"
                    });
                    $("#add_shipping_state").html(stateOptions);
                }
            });
            
        });

        $("#edit_address").on('click', function() {
            var address_id = $(this).data('address_id');
            $.ajax({
                type: "post",
                url: "{{route('get.user.address')}}",
                data: {id:address_id, _token:'{{csrf_token()}}'},
                success: function (data) {
                    console.log(data);
                    var address = JSON.parse(data);
                    $("#update_id").val(address_id);
                    $("#add_shipping_first_name").val(address.first_name);
                    $("#add_shipping_last_name").val(address.last_name);
                    $("#add_shipping_address").val(address.address);
                    $("#add_shipping_addressline2").val(address.addressline2);
                    $("#add_shipping_post_code").val(address.zip_code);
                    $("#add_shipping_phone_number").val(address.phone);
                    $("#add_shipping_country_options option:contains(" +address.country+ ")").attr('selected', 'selected');
                    $("#add_shipping_country").val(address.country);
                    $("#add_shipping_state").html('<option>'+address.state+'</option>');
                    $("#add_shipping_city").val(address.city);
                    $("#shippin_address_modal").modal('show');
                }
            });
        });
	});
</script>
@stop