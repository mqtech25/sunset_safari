@extends('site.app')
@section('title', 'Thank You')

@section('content')

<div class="container">
    <div class="row mt-4">
      <div class="col">
        <div class="w-100 bg-success p-4 mb-2">
          <h3 class="text-white text-center">Thank you for your order</h3>
          <p class="text-white text-center">Your order details are given bellow & also we have sent your reciept on {{ $order->email }}</p>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="tile mt-5" id="print_invoice">
            <section class="invoice">
              
              <div class="row mb-4">
                <div class="col-6">
                  <h2 class="page-header"><i class="fa fa-globe"></i> {{config('settings.site_title')}}</h2>
                </div>
                <div class="col-6">
                    <h5 class="text-right">{{'Order Date:'}} {{date('d-m-Y', strtotime($order->created_at))}}</h5>
                </div>
              </div>
              <div class="row invoice-info">
                <div class="col-4">Billing Address
                    <address><strong>{{ $order->first_name }} {{ $order->last_name }}</strong><br>{{ $order->address}}<br>{{ $order->addressline2}} {{ $order->city }}<br>{{ $order->state }} {{ $order->country }}<br>Email: {{ $order->email }}<br> PH #: {{ $order->phone_number }}</address>
                </div>
                <div class="col-4">Shipping Address
                    @php $shipping = json_decode($order->shipping_address) @endphp
                    <address><strong>{{$shipping->first_name.' '.$shipping->last_name}}</strong><br>{{$shipping->address}}<br>{{$shipping->addressline2.', '.$shipping->city}}<br>{{$shipping->state}} {{$shipping->country}}<br>PH #: {{$shipping->phone_number}}<br></address>
                </div>
                <div class="col-4"><b>Order #:</b> {{$order->order_number}}<br><b>Status:</b> {{$order->status}}<br><b>Sub Total:</b> {{config('settings.currency_symbol')}} {{$order->sub_total}}<br><b>Discount:</b> {{config('settings.currency_symbol')}} {{$order->discount}}<br><b>Shipping:</b> {{config('settings.currency_symbol')}} {{$order->shipping}}<br><b>Total:</b> {{config('settings.currency_symbol')}} {{$order->grand_total}}<br><b>Payment Method:</b> {{$order->payment_method}}</div>
              </div>
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Additional Info</th>
                        <th>SKU</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($order->items as $key => $item)
                      <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{$item->product->name}}</td>
                        <td>{{($item->product_details=='[]')?'N/A':$item->product_details}}</td>
                        <td>{{$item->product->sku}}</td>
                        <td>{{($item->price)/($item->quantity)}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{round($item->price,2)}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row d-print-none mt-2 py-3">
                <div class="col-12 text-right">
                  <a class="btn btn-primary" href="#" onclick="printInvoice();"><i class="fa fa-print"></i> Print</a>
                  <a class="btn btn-primary" href="{{url('/')}}"><i class="fa fa-shopping-cart"></i> Continue Shopping</a>
                </div>
              </div>
            </section>
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