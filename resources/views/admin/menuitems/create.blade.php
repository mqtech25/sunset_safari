@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<div class="app-title">
    <h1><i class="fa fa-files-o"></i> {{ $pageTitle }}</h1>
</div>
@include('admin.partials.flash')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row user">
    <div class="col-md-12">
        <form action="{{ isset($menu) ? route('admin.item.update') : route('admin.item.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @if(isset($menu))
            <input type="hidden" value="{{$menu->id}}" name="id">
            @endif
            <div class="tab-content">
                <div class="tile">
                    <h3 class="tile-title"> Menu Information </h3>
                    <hr>
                    <div class="tile-body">
                        <div class="form-group">
                            <label for="menu_title" class="control-label">Title</label>
                            <input type="text" name="name" placeholder="Enter menu title"
                                value="{{ old('menu_title', isset($menu) ? $menu->name : '' ) }}"
                                class="form-control">
                        </div>
                        <div class="form-check" data-toggle="collapse" data-target="#megaMenuCheck" aria-expanded="false" aria-controls="megaMenuCheck">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                              MegaMenu Item
                            </label>
                            <br>
                            <small>Checked If it's a MegaMenu </small>
                          </div>
                          <div class="collapse" id="megaMenuCheck">
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="control-label">Item Description</label>
                                            <textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                            <img src="" id="megaMenuImg" class="img-fluid">
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label class="control-label">Item Image</label>
                                            <input class="form-control" type="file" name="site_logo" onchange="loadFile(event,'megaMenuImg')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>                          
                        <div class="form-group mt-2">
                            <label for="parent" class="control-label">Parent</label>
                            <select name="parent" id="service-parent" class="form-control">
                                
                                @if(isset($items))
                                @foreach($items as $m_item)
                                <option value="{{$m_item->id}}">{{$m_item->name}}</option>
                                @endforeach
                                <option value="0">No Parent</option>
                                @else
                                <option type="hidden" value="0"></option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="tile">
                    <h3 class="tile-title"> Page Attached to Menu Item </h3>
                    <hr>
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th class="text-center"> # </th>
                                    <th class="text-center"> Title </th>
                                    <th class="text-center"> Status </th>
                                    <th class="text-center"> Created At </th>
                                    <th class="text-center"> Updated At </th>
                                    <th style="width: 100px; min-width: 100px;" class="text-center text-danger">
                                        <i class="fa fa-bolt"></i>
                                    </th>

                                </tr>
                            </thead>
                            <tbody id="pageInfo">
                                @if(isset($pageInfo))
                                    @foreach($pageInfo as $page)
                                        <tr>
                                            <td class="text-center">{{$page->id}}</td>
                                            <td class="text-center">{{$page->page_title}}</td>
                                            <td class="text-center">{{$page->page_status}}</td>
                                            <td class="text-center">{{$page->created_at}}</td>
                                            <td class="text-center">{{$page->updated_at}}</td>
                                            <td class="text-center"><a id='delete' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></a></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>

                        </table>
                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#pageSearch">Add
                            Page</button>
                    </div>
                </div>
            </div>
            <div class="pull-right">
                <div class="form-group pull-right ">
                    <input type="submit" value="UPDATE" class="btn btn-success btn-md w-00">
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="pageSearch"  role="dialog" aria-labelledby="pageSearchLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pageSearchLabel">Search Page</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <select class="ajax-search" id="search" style="width:200%">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="addPage()">Add</button>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script type="text/javascript" src="{{ asset('backend/js/plugins/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/dropzone/dist/min/dropzone.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/bootstrap-notify.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/app.js') }}"></script>


<script>
loadFile = function(event, id) {
    var output = document.getElementById(id);
    output.src = URL.createObjectURL(event.target.files[0]);
};
//Page Table Row Delete
$("#sampleTable").on("click", "#delete", function() {
   $(this).parents("tr").remove();
});

function addPage(){
    let id = $('#search :selected').val();
    $.ajax({
        url: "{{route('admin.item.loadPageData')}}",
        method: "Post",
        data: { "_token": "{{ csrf_token() }}", id: id},
        success: function(result){
            result = JSON.parse(result);
            console.log(result);
            $.each(result, function(i, item) {
                var html = "";
                html = "<tr><td class='text-center'><input type='hidden' name='slug_id' value='"+result[i].id+"'><input type='hidden' name='slug' value='"+result[i].page_slug+"'>"+result[i].id+"</td><td class='text-center'>"+result[i].page_title+"</td><td class='text-center'><span class='badge badge-success'>"+((result[i].page_status) ? 'PUBLISHED': 'DRAFT')+"</span></td><td class='text-center'>"+result[i].created_at+"</td><td class='text-center'>"+result[i].updated_at+"</td><td class='text-center'>"+ 
                            "<div class='btn-group'><a id='delete' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></a></div></td></tr>";
                document.getElementById("pageInfo").innerHTML = html;
            });
            
            
        }
    });
    $("#search").empty();
}
Dropzone.autoDiscover = false;

$(document).ready(function() {
    
    var keywords = '';
    $("#service-meta-keyword").tagsinput('add', keywords);

    $('.ajax-search').select2({
        minimumInputLength: 3,
        ajax: {
            url: "{{route('admin.item.search')}}",
            
           // data: { "_token": "{{ csrf_token() }}"},
           processResults: function (data) {
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.page_title,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
    // CKEDITOR.replace('tab_content', {
    //     filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
    //     filebrowserImageBrowseUrl: '/ckfinder/ckfinder.html?type=Images',
    //     filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    //     filebrowserImageUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
    // });

    // l


    // myDropzone.on('queuecomplete', function(file) {
    //     window.location.reload();
    //     showNotification('Completed', 'All product images uploaded', 'success', 'fa-check');
    // });


    // $('#uploadButton').click(function() {
    //     if (myDropzone.files.length === 0) {
    //         showNotification('Error', 'Please select files to upload.', 'danger', 'fa-close');
    //     } else {
    //         myDropzone.processQueue();
    //     }
    // });


    function showNotification(title, message, type, icon) {

        $.notify({
            title: title + ' : ',
            message: message,
            icon: 'fa ' + icon
        }, {
            type: type,
            allow_dismiss: true,
            placement: {
                from: "top",
                align: "right"
            }
        });
    }

});
</script>
@endpush