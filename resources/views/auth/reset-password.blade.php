@extends('site.app')
@section('title', 'Reset Password')
@section('content')
<section class="section-pagetop bg-info">
    <div class="container clearfix">
        <h2 class="title-page">Password Reset</h2>
    </div>
</section>
<section class="section-content bg padding-y">
    <div class="container">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <header class="card-header">
                    <h4 class="card-title mt-2">Enter New Password</h4>
                </header>
                <article class="card-body">
                    <form action="{{ route('password.update') }}" method="POST" role="form">
                        @csrf
                        <div class="form-group">
                            <label for="email">E-Mail Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email">
                            <input type="hidden" class="form-control @error('token') is-invalid @enderror" name="token" id="token" value="{{$token}}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation">
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block bg-info"> RESET </button>
                        </div>
                    </form>
                </article>
            </div>
        </div>
    </div>
</section>
@stop