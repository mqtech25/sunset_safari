@php
    $countries = \App\Models\Country::all();
@endphp
@extends('site.app')
@section('title', 'Register')
@section('content')
<section class="section-pagetop bg-info">
    <div class="container clearfix">
        <h2 class="title-page">Register</h2>
    </div>
</section>
<section class="section-content bg padding-y">
    <div class="container">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <header class="card-header">
                    <h4 class="card-title mt-2">Sign up</h4>
                </header>
                <article class="card-body">
                    <form action="{{ route('register') }}" method="POST" role="form">
                        @csrf
                        <div class="form-row">
                            <div class="col form-group">
                                <label for="first_name">First name</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" value="{{ old('first_name') }}">
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col form-group">
                                <label for="last_name">Last name</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" value="{{ old('last_name') }}">
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email">E-Mail Address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input class="form-control" type="text" name="phone" id="phone" value="{{ old('phone') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation">
                                    @error('password_confirmation')
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
                                    <label for="zip_code">Zip Code</label>
                                    <input class="form-control @error('zip_code') is-invalid @enderror" type="text" name="zip_code" id="zip_code" value="{{ old('zip_code') }}">
                                    @error('zip_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="hidden" name="country" id="country">
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
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" id="address" value="{{ old('address') }}">
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Address Line 2</label>
                            <input class="form-control" type="text" name="addressline2" id="addressline2" value="{{ old('addressline2') }}">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="state">State</label>
                                <select id="state" class="form-control @error('state') is-invalid @enderror" name="state"></select>
                                @error('state')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city">City</label>
                                <input type="city" name="city" id="city" class="form-control @error('city') is-invalid @enderror">
                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block bg-info"> Sign Up </button>
                        </div>
                        <small class="text-muted">By clicking the 'Sign Up' button, you confirm that you accept our <br> Terms of use and Privacy Policy.</small>
                    </form>
                </article>
                <div class="border-top card-body text-center">Have an account? <a href="{{ route('login') }}">Log In</a></div>
            </div>
        </div>
    </div>
</section>
<script>
    $("#country_options").change(function(){
        var country_id = $(this).val();
        var country_name = $("#country_options option:selected").text();
        $("#country").val(country_name);
        $.ajax({
            type: "post",
            url: "{{route('fetchstates')}}",
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
</script>
@endsection
