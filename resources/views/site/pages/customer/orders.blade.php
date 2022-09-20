@extends('site.app')
@section('title', 'Profile')

@section('content')

<div class="container">
    @include('site.partials.flushmessage')
    <div class="row mt-4">
        <div class="col-3">
            @include('site.partials.usersidebar')
        </div>
        <div class="col-9">
            <div class="profile-tile py-4">
                <div class="title-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th> Order # </th>
                                <th> Status </th>
                                <th class="text-center"> Shipping </th>
                                <th class="text-center"> Discount </th>
                                <th class="text-center"> Total Amount </th>
                                <th class="text-center"> Payment Status </th>
                                {{-- <th class="text-center text-danger">
                                    <i class="fa fa-bolt"></i>
                                </th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td> {{ $order->order_number }} </td>
                                <td> {{ $order->status}}</td>
                                <td class="text-center"> {{ config('settings.currency_symbol').$order->shipping }}</td>
                                <td class="text-center"> {{ config('settings.currency_symbol').$order->discount }}</td>
                                <td class="text-center"> {{ config('settings.currency_symbol').$order->grand_total }}</td>
                                <td class="text-center"> {{ $order->payment_status == 1 ? 'Paid' : 'Pending' }}</td>
                                {{-- <td class="text-center"> 
                                    <a title="View Order Details" href="#" class=""><i class="fa fa-eye text-primary"></i></i></a>
                                </td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Passowrd Modal -->
<div class="modal fade" id="passwordModel" tabindex="-1" role="dialog" aria-labelledby="passwordModelTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <form action="{{route('update.customer.password')}}" method="POST" id="pass_form">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-lock"></i> Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="" class="form-label">Current Password</label>
                            <input type="password" required class="form-control" name="current_password" id="current_password">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="" class="form-label">New Password</label>
                            <input type="password" required class="form-control" name="new_password" id="new_password">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="" class="form-label">Confirm</label>
                            <input type="password" required class="form-control" name="confirm_password" id="confirm_password">
                            <span id="mismatch-error"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="submit_pass" class="btn btn-success">Update</button>
            </div>
        </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<script type="text/javascript">

	$(document).ready(function() {
		
		$('#sampleTable').DataTable();
	} );
</script>
@stop