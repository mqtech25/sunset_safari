<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	{{-- <link href="{{ asset('storage/'.config('settings.site_favicon')) }}" rel="shortcut icon" type="image/x-icon">
	<title> @yield('title') | {{ config('settings.site_title') }} </title> --}}
	<meta name="description" content="@yield('meta_description')">
  	<meta name="keywords" content="@yield('meta_keyword')">
	@include('site.partials.styles')
	
</head>
<body>
	@include('site.partials.header')
	@yield('content')
	@include('site.partials.footer')
	@include('site.partials.scripts')
</body>
</html>