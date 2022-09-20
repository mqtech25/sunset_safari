<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title') - {{ config('app.name') }}</title>
	<link href="{{ asset('storage/'.config('settings.site_favicon')) }}" rel="shortcut icon" type="image/x-icon">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/css/tagsinput.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/css/datatablebtn.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/css/main.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/css/select2.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/css/font-awesome/4.7.0/css/font-awesome.min.css')}}">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	@yield('styles')
</head>
<body class="app sidebar-mini rtl">
	
	@include('admin.partials.header')
	@include('admin.partials.sidebar')

	<main class="app-content" id="app">
		@yield('content')
	</main>

	<!-- Essential javascripts for application to work-->
	<script type="text/javascript" src="{{ asset('backend/js/jquery-3.3.1.min.js') }} "></script>
	<script type="text/javascript" src="{{ asset('backend/js/popper.min.js') }} "></script>
	<script type="text/javascript" src="{{ asset('backend/js/bootstrap.min.js') }} "></script>
	<script type="text/javascript" src="{{ asset('backend/js/main.js') }}"></script>
	<script type="text/javascript" src="{{ asset('backend/ckeditor/ckeditor.js') }}"></script>
	<script type="text/javascript" src="{{ asset('backend/js/plugins/pace.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('backend/js/plugins/select2.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('backend/js/plugins/tagsinput.js') }}"></script>

	@stack('scripts')

</body>
</html>