@extends('site.app')
@section('title', 'Unsubscribed')

@section('content')

<div class="container">
    <div class="row mt-4">
      <div class="col">
        <div class="w-100 bg-success p-4 mb-2">
          <h3 class="text-white text-center">Thank you for your time</h3>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="tile mt-5" id="print_invoice">
            @if($response_status)
              <p class="alert alert-success">{{ $responseMessage }}</p>
            @else
              <p class="alert alert-danger">{{ $responseMessage }}</p>
            @endif
          </div>
        </div>
    </div>
</div>
@push('custom-scripts')
<script src="{{ asset('frontend/js/printThis.js') }}" type="text/javascript"></script>
<script>
    function printInvoice(){
        $("#print_invoice").printThis();
    }
</script>
@endpush
@stop