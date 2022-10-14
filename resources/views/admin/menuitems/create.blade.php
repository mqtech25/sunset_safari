@extends('admin.app')
@section('title') @endsection
@section('content')
<div class="app-title">
	<div>
		<h1><i class="fa fa-sitemap mr-2"></i>Create Menu Item</h1>
	</div>
</div>
@include('admin.partials.flash')
<form action="" method="POST" role="form" enctype="multipart/form-data">
		@csrf
<div class="row">
	<div class="col-md-12">
		<div class="tile">
			<h3 class="tile-title">Menu Item Information </h3>
			<hr>

				<div class="tile-body">
					<div class="form-group">
						<label class="control-label" for="name"> Title <span class="m-l-5 text-danger"> *</span></label>
						<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="" placeholder="Enter Sub Menu Item Title"/>
					</div>
					<div class="form-group">
						<label class="control-label" for="description">Description</label>
						<textarea name="description" id="description" cols="30" rows="4" class="form-control" placeholder="Enter Sub Menu Item Description"></textarea>
					</div>
					<div class="form-group">
						<label for="parent" class="control-label"> Parent Category <span class="m-l-5 text-danger"> *</span></label>
						<select name="parent_id" id="parent" class="form-control custom-select mt-15 @error('parent_id') is-invalid @enderror">
							<option value="0">Select a parent category</option>
						
						</select>
					</div>
					<div class="form-row">
						<div class="col-md-4">
							<div class="form-group">
								<div class="form-check">
									<label class="form-check-label">
										<input type="checkbox" id="featured" name="featured" class="form-check-input">Show Special offer
									</label>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<div class="form-check">
									<label class="form-check-label">
										<input type="checkbox" id="featured" name="featured" class="form-check-input">Show in New Tours
									</label>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<div class="form-check">
									<label for="menu" class="form-check-label">
										<input type="checkbox" class="form-check-input"id="menu" name="menu">Show in Menu
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label">Category Image <span class="m-l-5 text-danger"> *</span></label>
						<input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
					</div>
				</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="tile">
			<h3 class="tile-title">Page Attached to Menu item</h3>
				<hr>
			<div class="tile-body table-responsive">
				<table class="table table-hover table-bordered" id="sampleTable">
					<thead>
						<tr>
							<th class="text-center"> # </th>
							<th class="text-center"> Title </th>
							<th class="text-center"> Status </th>
							<th class="text-center"> Created At </th>
							<th class="text-center"> Updated At </th>
							<th style="width: 100px; min-width: 100px;" class="text-center text-danger"><i class="fa fa-bolt"></i></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-center">2</td>
							<td class="text-center">top 10 games</td>
							<td class="text-center">
								<span class="badge badge-success">Publish</span>
							</td>
							<td class="text-center">
								Time 
							</td>
							<td class="text-center">
								Time 
							</td>
							<td class="text-center">
								<div class="btn-group" role="group" aria-label="Second group">
									<a href="" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
									<a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
					<div class="tile-footer">
						<button type="button" id="addPageBtn" data-toggle="modal" data-target="#addPageModal" class="btn btn-primary"><i class="fa fa-plus fa-lg"></i>Add Page</button>
					</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<a href="{{ route('admin.menuitems.index') }}" class="btn btn-primary pull-right"> <i class="fa fa-fw fa-lg fa-check-circle"></i>Update</a>
	</div>
</div>
</form>

<!-- add page Modal -->
<div class="modal fade" id="addPageModal" tabindex="-1" role="dialog" aria-labelledby="addPageModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addPageModalTitle">Add Page</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
	  </div>
	  <form action="{{route('admin.shipping.addcountry')}}" method="POST" id="addCountryForm">
		<div class="modal-body">
			@csrf
				<div class="col-12">
					<div class="form-group">
						<label class="form-label">Search Page</label>
						<select name="page_id" id="page_id" class="form-control">
							<option value="0">Select Page</option>
						</select>
					</div>
				</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
			<button type="submit" class="btn btn-success">Add</button>
		</div>
	  </form>
    </div>
  </div>
</div>
@endsection