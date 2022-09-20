@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<div class="app-title">
	<h1><i class="fa fa-eye"></i> {{ $pageTitle }} </h1>
</div>
@include('admin.partials.flash')
    <div class="app-title">
        <div>
          <h1><i class="fa fa-file-text-o"></i> Invoice</h1>
          {{-- <p>A Printable Invoice Format</p> --}}
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Invoice</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
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
                    <address><strong>{{ $order->first_name }} {{ $order->last_name }}</strong><br>{{ $order->address}} {{ $order->city }} <br>{{ $order->state }} {{ $order->country }}<br>Email:{{$order->email}} <br> PH #: {{ $order->phone_number }}</address>
                </div>
                <div class="col-4">Shipping Address
                    @php $shipping = json_decode($order->shipping_address) @endphp
                    <address><strong>{{$shipping->first_name.' '.$shipping->last_name}}</strong><br>{{$shipping->address}}<br>{{$shipping->addressline2.', '.$shipping->city}}<br>{{$shipping->state}} {{$shipping->country}}<br>PH #: {{$shipping->phone_number}}<br></address>
                </div>
                <div class="col-4"><b>Order #:</b> {{$order->order_number}}<br><b>Status:</b> {{$order->status}}<br><b>Sub Total:</b> {{config('settings.currency_symbol')}} {{$order->sub_total}}<br><b>Discount:</b> {{config('settings.currency_symbol')}} {{$order->discount}}<br><b>Shipping:</b> {{config('settings.currency_symbol')}} {{$order->shipping}}<br><b>Grant Total:</b> {{config('settings.currency_symbol')}} {{$order->grand_total}}<br><b>Payment Method:</b> {{$order->payment_method}}</div>
              </div>
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>SKU</th>
                        <th>Addition Info</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($order->items as $key => $item)
                      <tr>
                        <td>{{ $key+1 }}</td>
                        <td><a href="{{route('product.show', $item->product->slug)}}" class="text-capitalize">{{$item->product->name}}</a></td>
                        <td>{{$item->product->sku}}</td>
                        <td>{{($item->product_details=='[]')?'N/A':$item->product_details}}</td>
                        <td>{{($item->price)/($item->quantity)}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{round($item->price,2)}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              {{-- <div class="row d-print-none mt-2">
                <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print();" target="_blank"><i class="fa fa-print"></i> Print</a></div>
              </div> --}}
            </section>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h2 class="page-header"><i class="fa fa-pencil-square-o"></i> Order History</h2>
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Status</th>
                      <th>Comment</th>
                      <th width="100">Date Time</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($order->orderStatus as $key => $status)
                    <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{$status->status}}</td>
                      <td>{{$status->comments}}</td>
                      <td>{{$status->created_at}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-12">
                <form id="order_status_form">
                  @csrf
                  <div class="form-row">
                    <div class="col-4">
                      <div class="form-group">
                        <label for="status">
                          Order Status
                        </label>
                        <select name="status" id="status" class="form-control">
                          <option value="pending">Pending</option>
                          <option value="processing">Processing</option>
                          <option value="completed">Shipped</option>
                          <option value="decline">Canceled</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-7">
                      <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea name="comment" id="comment" class="form-control" rows="2"></textarea>
                        <input type="hidden" name="order_id" id="order_id" value="{{$order->id}}">
                      </div>
                    </div>
                    <div class="col-1">
                      <div class="form-group">
                        <label for="commentbtn">&nbsp;</label>
                        <button type="submit" name="commentbtn" id="commentbtn" class="btn btn-success w-100">
                          <span id="loading-img" style="display: none"><img src="{{asset("/storage/img/wait.gif")}}" width="20"/>Updating..</span>
                          <span id="button-text">UPDATE</span>
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endsection
  @push('scripts')
  <script>
    $(document).ready(function(){
      $('#order_status_form').submit(function(e){
        $('#loading-img').show();
        $('#button-text').hide();
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '{{route('admin.order.updatestatus')}}',
            data: $(this).serialize()
          }).done(function( data ) {
            console.log(data);
            location.reload();
          });
      });
    });
  </script>
  @endpush

