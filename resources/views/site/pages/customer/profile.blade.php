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
            <form action="{{route('update.customer.profile')}}" method="POST" class="px-4 w-100">
                @csrf
                <div class="profile-tile">
                    <h5 class="font-weight-bold py-4 px-4">Customer Profile</h5>
                    <hr class="m-0">
                    <div class="row px-4 pt-4">
                        <div class="col-12">
                            <div class="form-row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">First Name</label>
                                        <input type="text" name="first_name" id="first_name" class="form-control"
                                        value="{{Auth::user()->primaryAddress->first_name}}">
                                        @error('first_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">Last Name</label>
                                        <input type="text" name="last_name" id="last_name" class="form-control"
                                        value="{{Auth::user()->primaryAddress->last_name}}">
                                        @error('last_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">Email</label>
                                        <input type="" name="mail" id="email" class="form-control"
                                        value="{{Auth::user()->email}}">
                                        @error('mail')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">Phone</label>
                                        <input type="tel" name="phone" id="phone" class="form-control"
                                        value="{{Auth::user()->primaryAddress->phone}}">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Address</label>
                                <input type="tel" name="address" id="address" class="form-control"
                                value="{{Auth::user()->primaryAddress->address}}">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Address line 2</label>
                                <input type="tel" name="addressline2" id="addressline2" class="form-control"
                                value="{{Auth::user()->primaryAddress->addressline2}}">
                            </div>
                            <div class="form-row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">Zip Code</label>
                                        <input type="" name="zip_code" id="ezip_code" class="form-control"
                                        value="{{Auth::user()->primaryAddress->zip_code}}">
                                        @error('zip_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="country_options">Country</label>
                                        <input type="hidden" name="country" id="country" required>
                                        <select id="country_options" class="form-control @error('country') is-invalid @enderror" name="country_options">
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
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="add_shipping_state">State</label>
                                        <select required id="state" class="form-control @error('state') is-invalid @enderror" name="state">
                                            <option value="{{Auth::user()->primaryAddress->state}}">{{Auth::user()->primaryAddress->state}}</option>
                                        </select>
                                        @error('state')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">City</label>
                                        <input type="tel" name="city" id="city" class="form-control"
                                        value="{{Auth::user()->primaryAddress->city}}">
                                        @error('city')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="m-0">
                    <p class="px-4 pt-3 pb-3 text-right"><a href="#" id="change_pass" class="btn btn-outline-danger">Change Password</a> <input type="submit" class="btn btn-info" value="Update Profile"></p>
                </div>
            </form>
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
<script>
    $("#country_options option:contains(" + "{{Auth::user()->primaryAddress->country}}" + ")").attr('selected', 'selected');

    $("#change_pass").on('click',function(){
        $("#passwordModel").modal('show');
    });

    $("#confirm_password").on('keyup',function(){
        if($("#new_password").val() == $("#confirm_password").val())
        {
            $("#mismatch-error").show();
            $("#mismatch-error").addClass('text-success');
            $("#mismatch-error").removeClass('text-danger');
            $("#mismatch-error").html('Match');
        }else{
            $("#mismatch-error").show();
            $("#mismatch-error").addClass('text-danger');
            $("#mismatch-error").removeClass('text-success');
            $("#mismatch-error").html('Mismatch');
        }
    })

    $("#country_options").change(function(){
        var country_id = $(this).val();
		var country_name = $("#country_options option:selected").text();
        $("#country").val(country_name);
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
				$("#state").html(stateOptions);
            }
		});
		
	});

    $("#pass_form").submit(function(e){
        if($("#new_password").val().trim() != $("#confirm_password").val().trim() && $("#new_password").val().trim()==''){
            e.preventDefault();
        }
    });
</script>
@stop