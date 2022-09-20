<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Email | {{config('settings.site_name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

</head>

<body style="margin: 0; padding: 0;">
    <div style="width: 60%; margin:0px auto">
        <p><strong>Hi,</strong><br> You have a new Order - <strong>#{{$order->order_number}}</strong></p><br>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-left: 1px solid gray; border-right: 1px solid gray;">
            <tr>
                <td colspan=" 3 " align="center " style="background-color: #ece9e9; padding: 10px">
                    <h3>Order#: {{$order->order_number}}</h3>
                </td>
            </tr>
            <tr>
                <td style="border: none; ">

                    <table align="center " border="none " cellpadding="0 " cellspacing="0 " width="100% " style="border-collapse: collapse; border: none; ">
                        <tr>
                            <td style="border: none; ">
                                <h4 style="margin:0; padding-left:10px"><img width="200" style="width:200px !important" src="{{url('/storage//'.config('settings.site_logo'))}}" alt=""></h4>
                            </td>
                            <td style="border: none;" align="right" colspan="2">
                                <h3 style="margin:0; padding-right:10px">Date: {{date('d M, Y', strtotime($order->created_at))}}</h3>
                            </td>
                        </tr>
                        <tr>
                            <td width="33% " style="vertical-align: top; border:none; padding-left:10px; padding-bottom:15px;">
                                <strong>Billing Address</strong>
                                <address><strong>{{ $order->first_name }} {{ $order->last_name }}</strong><br>{{ $order->address}}<br>{{ $order->addressline2}} {{ $order->city }}<br>{{ $order->state }} {{ $order->country }}<br>Email: {{ $order->email }}<br> PH #: {{ $order->phone_number }}</address>
                            </td>
                            <td width="33% " style="vertical-align: top; border:none; padding-bottom:15px;">
                                <strong>Shipping Address</strong>
                                @php $shipping = json_decode($order->shipping_address) @endphp
                                <address><strong>{{$shipping->first_name.' '.$shipping->last_name}}</strong><br>{{$shipping->address}}<br>{{$shipping->addressline2.', '.$shipping->city}}<br>{{$shipping->state}} {{$shipping->country}}<br>PH #: {{$shipping->phone_number}}<br></address>
                            </td>
                            <td width="34% " style="vertical-align: top; border:none; padding-bottom:15px;">
                                <strong>Order Details</strong><br>Order#: {{$order->order_number}}
                                <br>Status: {{$order->status}}<br>Payment Method: {{$order->payment_method}}<br> Subtotal: {{$order->sub_total}}<br> Discount: {{$order->discount}}<br> Shipping: {{$order->shipping}}<br> Total: {{$order->grand_total}}
                            </td>
                        </tr>
                        <tr style="border-top:1px solid gray;">
                            <td colspan="3 " style="border: none;">
                                <table cellspacing="0 " cellpadding="0 " width="100% " style="border: none; ">
                                    <tr height="50px">
                                        <th align="left" style="padding-left:10px">Product</th>
                                        <th align="center">QTY</th>
                                        <th align="center">Price</th>
                                        <th align="left">Additional Info</th>
                                        <th align="center">Subtotal</th>
                                    </tr>
                                    @foreach ($order->items as $key=>$item)
                                    <tr height="50px" style="{{$key%2==0 ? 'background-color: #dad8d8' : ''}}">
                                        <td style="padding-left:10px; padding-top:7px; padding-bottom:7px;">{{$item->product->name}}</td>
                                        <td align="center" style="padding-top:7px; padding-bottom:7px;">{{$item->quantity}}</td>
                                        <td align="center" style="padding-top:7px; padding-bottom:7px;">{{$item->price/$item->quantity}}</td>
                                        <td  style="padding-top:7px; padding-bottom:7px;">{{$item->product_details != '[]' ? $item->product_details : 'N/A'}}</td>
                                        <td align="center"  style="padding-top:7px; padding-bottom:7px;">{{$item->price}}</td>
                                    </tr>
                                    @endforeach
                                    <tr height="50px">
                                        <td colspan="5">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
            <tr>
                <td colspan=" 3 " align="center " style="background-color: #ece9e9; padding: 10px">
                    <p>&copy; {{date('Y').' '.config('settings.site_name')}}</p>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>