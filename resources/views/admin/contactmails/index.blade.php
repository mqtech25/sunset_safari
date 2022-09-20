@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<div class="app-title">
	<h1><i class="fa fa-gift"></i> {{ $pageTitle }} </h1>
</div>
@include('admin.partials.flash')

	<div class="tile">
        <div class="tile-body">
			<table class="table table-hover table-bordered" id="sampleTable" cellspacing="0" width="100%">
                <tbody>
                    @foreach($contactMessages as $key => $mail)
                        <tr>
                            <td width="20">{{$key+1}}</td>
                            <td width="120">{{$mail->name}}</td>
                            <td>{{$mail->email}}</td>
                            <td>{{$mail->message}}</td>
                            <td width="30" class="status_message{{$mail->id}}">{!!$mail->status == 0 ? '<span class="badge badge-pill badge-danger">NEW</span>': ''!!}</td>
                            <td>{{ $mail->created_at->diffForHumans() }}</td>
                            <td class="text-center"> 
								<div class="btn-group"> 
									<a href="#" data-id="{{$mail->id}}" class="btn btn-sm btn-primary view_message"><i class="fa fa-eye"></i></a>
									<a href="{{route('admin.contactmails.delete',$mail->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
								</div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
<!-- Message view Modal -->
<div class="modal fade" id="message_view_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="message_view_modalTitle"><i class="fa fa-envelope-open"></i> Contact Email</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>From: </strong><span id="from-name"><span></p>
        <p><strong>Email: </strong><span id="from-email"><span></p>
        <p><strong>Message: </strong><span id="from-message"><span></p>
      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        $(".view_message").on('click', function(){
            var id = $(this).data('id');

            $.ajax({
                type: "post",
                url: "{{route('admin.contactmails.update')}}",
                data: {id:id, _token:'{{csrf_token()}}'},
                success: function (response) {
                    console.log(response);
                    if(response != null){
                        var message = JSON.parse(response);
                        $("#from-name").html(message.name);
                        $("#from-email").html("<a href='mailto:'"+message.email+">"+message.email+"</a>");
                        $("#from-message").html(message.message);
                        $(".status_message"+id).html('');
                        $("#message_view_modal").modal('show');
                    }
                }
            });
        })
    });
</script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">$('#sampleTable').dataTable();</script>
@endpush