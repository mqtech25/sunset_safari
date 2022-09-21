{{-- <script src="{{ asset('frontend/js/jquery-2.0.0.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('frontend/plugins/fancybox/fancybox.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontend/plugins/owlcarousel/owl.carousel.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontend/js/script.js') }}" type="text/javascript"></script> --}}
{{-- bootstrap --}}
<script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}" type="text/javascript"></script>
{{-- common script --}}
<script src="{{ asset('frontend/js/common_scripts_min.js') }}" type="text/javascript"></script>
{{-- validate script --}}
<script src="{{ asset('frontend/js/validate.js') }}" type="text/javascript"></script>
{{-- jquery tweet script --}}
<script src="{{ asset('frontend/js/jquery.tweet.min.js') }}" type="text/javascript"></script>
{{-- functions script --}}
<script src="{{ asset('frontend/js/functions.js') }}" type="text/javascript"></script>
<!-- SPECIFIC SCRIPTS -->
<script src="{{ asset('frontend/js/video_header.js')}}"></script>

@stack('custom-scripts')
{!! config('settings.google_analytics') !!}
{!! config('settings.facebook_pixels') !!}