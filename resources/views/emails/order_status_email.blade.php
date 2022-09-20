<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Email | {{config('settings.site_name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

</head>

<body style="margin: 0; padding: 0;">
    <div style="width: 60%; margin:0px auto">
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
                            <td colspan="3 " style="border: none; padding:10px;">
                                <p>Hi, <strong>{{$order->first_name.' '.$order->last_name}}</strong><br> your order <strong>#{{$order->order_number}}</strong> status is updated</p>
                                <p>Status: {{$request->status}}<br>
                                Details: {{$request->comment}}<br></p><br>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
            <tr>
                <td colspan=" 3 " align="center " style="background-color: #ece9e9; padding: 10px">
                    <p style="text-align: center">Thank you for your order.<br>for any query please contact us on : {{config('settings.default_email_address')}}<br>
                    <br>&copy; {{date('Y').' '.config('settings.site_name')}}</p>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>