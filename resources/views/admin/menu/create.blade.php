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
        <form action="{{ isset($menu) ? route('admin.menu.update') : route('admin.menu.store') }}" method="POST"
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
                            <input type="text" name="menu_title" placeholder="Enter menu title"
                                value="{{ old('menu_title', isset($menu) ? $menu->menu_title : '' ) }}"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="status" class="control-label">Staus</label>
                                    <select name="tab_status" id="service-status" class="form-control">
                                        <option value="0"
                                            {{ (isset($menu) && $menu->tab_status!=1) ? 'selected' : ''  }}>
                                            DRAFT </option>
                                        <option value="1"
                                            {{ (isset($menu) && $menu->tab_status==1) ? 'selected' : ''  }}>
                                            PUBLISHED </option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="menu_location" class="control-label">Location</label>
                                    <select name="location" id="service-status" class="form-control">
                                        <option value="PRIMARY"
                                            {{ (isset($menu) && $menu->location!="PRIMARY") ? 'selected' : ''  }}>
                                            PRIMARY </option>
                                        <option value="TOP"
                                            {{ (isset($menu) && $menu->location=="TOP") ? 'selected' : ''  }}>
                                            TOP </option>
                                        <option value="NAV"
                                            {{ (isset($menu) && $menu->location=="NAV") ? 'selected' : ''  }}>
                                            NAV </option>
                                        <option value="FOOTER"
                                            {{ (isset($menu) && $menu->location=="FOOTER") ? 'selected' : ''  }}>
                                            FOOTER </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if(isset($menuItems))
                <div class="tile">
                    <h3 class="tile-title"> {{$menu->menu_title}} Menu </h3>
                    <hr>
                    <div class="tile-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div id="accordion">
                                    <div class="card">
                                        <div class="card-header" id="headingOne" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <h5 class="mb-0">
                                                <a class="btn btn-link">
                                                    Menu Items
                                                </a><span class="fa fa-arrow-down float-right mt-2"></span>
                                            </h5>
                                        </div>

                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                            data-parent="#accordion">
                                            <div class="card-body">
                                                    <div class="form-group p-4" style="border:1px solid #ddd">
                                                        @foreach($menuItems as $items)
                                                        <input type="checkbox" name="menu_items[]"
                                                            value="{{$items->id}}" id="menu_item{{$items->id}}"><input
                                                            type="hidden" name="menu_items_name[]"
                                                            value="{{$items->name}}"
                                                            id="menu_item{{$items->name}}">&nbsp&nbsp&nbsp{{$items->name}}
                                                        <br>
                                                        @endforeach
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row ">
                                                            <div class="col-6 mt-2">
                                                                <input type="checkbox"
                                                                    onclick="toggle(this);" />&nbsp&nbsp&nbsp&nbsp&nbsp
                                                                Select All?
                                                            </div>
                                                            <div class="col-6">
                                                                <button type="button" onclick="addMenu()"
                                                                    class="btn  btn-success">Add</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                               <div id="menu_items">
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <hr>

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
<div class="modal fade" id="pageSearch" tabindex="-1" role="dialog" aria-labelledby="pageSearchLabel"
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
                <input type="text" class="form-control" name="search_value" id="search_id"
                    placeholder="Search Page Keyword">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="searchPage()">Search</button>
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
//Check all check boxes
function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}

//add temp menu 
function addMenu() {
    var checkboxes = document.getElementsByName('menu_items[]');
    var names = document.getElementsByName('menu_items_name[]');
    var vals = "";
    for (var i = 0, n = checkboxes.length; i < n; i++) {
        if (checkboxes[i].checked) {
            vals += "<div class='list-item'><b>"+names[i].value+"<input type='hidden' name='menu_item_id[]' value="+checkboxes[i].value+"></b></div>";
            document.getElementById("menu_items").innerHTML = vals;
        }
    }
}
</script>
@endpush