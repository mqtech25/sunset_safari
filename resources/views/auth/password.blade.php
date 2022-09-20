@extends('site.app')
@section('title', 'Reset Password')
@section('content')
<section class="section-pagetop bg-info">
    <div class="container clearfix">
        <h2 class="title-page">Forgot Password</h2>
    </div>
</section>
<section class="section-content bg padding-y">
    <div class="container">
        <div class="row justify-content-center">
            @if(Session::get('status') !=null)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success</strong> Reset Password link send to your registered email.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
        <div class="col-md-6 mx-auto">
            <div class="card">
                <header class="card-header">
                    <h4 class="card-title mt-2">Reset Password</h4>
                </header>
                <article class="card-body">
                    <form action="{{ route('password.email') }}" method="POST" role="form">
                        @csrf
                        <div class="form-group">
                            <label for="email">E-Mail Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block bg-info"> Send Reset Link </button>
                        </div>
                    </form>
                </article>
            </div>
        </div>
    </div>
</section>
@stop