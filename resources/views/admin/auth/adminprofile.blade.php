@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection

@section('content')
<div class="app-title">
	<div>
		<h1><i class="fa fa-user"></i> {{ $pageTitle }}</h1>
	</div>
</div>
@include('admin.partials.flash')
<div class="row">
	<div class="col-md-8 mx-auto">
		<div class="tile">
			<h3 class="tile-title">{{ $subTitle }}</h3>
			<form action="{{ route('admin.updateprofile') }}" method="POST" role="form" enctype="multipart/form-data">
				@csrf
				<div class="title-body">
					<div class="form-row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name" class="control-label">Name</label>
                                <input type="text" value="{{\Auth::user()->name}}" class="form-control @error('name') is-invalid @enderror" name="name">
                                <input type="hidden" value="{{\Auth::user()->id}}" name="id">

                                @error('name')
                                <div class="invalid-feedback">
                                    <strong> {{ $message }} </strong>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name" class="control-label">Email</label>
                                <input type="text" value="{{\Auth::user()->email}}" class="form-control @error('email') is-invalid @enderror" name="email">

                                @error('email')
                                <div class="invalid-feedback">
                                    <strong> {{ $message }} </strong>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="password" class="control-label">Password <small><span class="text-danger"> (Leave empty if you dont want to change)</span></small></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                @error('password')
                                <div class="invalid-feedback">
                                    <strong> {{ $message }} </strong>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="password_confirmation" class="control-label">Confirm Password</label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation">

                                @error('password_confirmation')
                                <div class="invalid-feedback">
                                    <strong> {{ $message }} </strong>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
				</div>
				<div class="tile-footer">
					<button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>	
				</div>
			</form>
		</div>
	</div>
</div>

@endsection