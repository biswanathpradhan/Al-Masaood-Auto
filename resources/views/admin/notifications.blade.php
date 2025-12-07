<<<<<<< HEAD
<!-- @if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif  -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark">All Notifications</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> Home</a></li>
							<li class="breadcrumb-item active">Notifications</li>
						</ol>
					</div>
				</div>
				<div class="row mb-2">
          <div class="col-md-2" id="addbtndiv">
            <a type="button" class="btn-sm btn-primary" href="{{route('addnotification')}}">+ Add Notification</a>
          </div>
        </div>
				<div class="row mb-2">
					<div class="col-md-4">
						<div class="form-group">
							<label>Minimal</label>
							<select class="form-control select2" id="brand_change" style="width: 100%;">
								<option selected="selected" value="4">All</option>
							@foreach ($compact_val as $item)
							<option value="{{ $item->id }}"> {{ strtoupper($item->main_brand_name) }} </option>
							@endforeach
								<!-- <option value="1">NISSAN</option>
								<option value="2">RENAULT</option>
								<option value="3">INFINITI</option> -->
							</select>
						</div>
					</div>
					<div class="col-md-8" align="right">&nbsp;</div>
				</div>
			</div>
		</div>
		<section class="content">
			<div class="row">
				<div class="col-12">
					<div class="card card-primary card-outline">
						<div class="card-body">
							<table id="example29" class="table table-bordered table-striped common-datatable">
								<thead>
									<tr>
										<th>ID</th>
										<th>Image</th>
										<th>Title</th>
										<th>Description</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
								 <tfoot>
									<tr>
										 
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
=======
<!-- @if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif  -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark">All Notifications</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> Home</a></li>
							<li class="breadcrumb-item active">Notifications</li>
						</ol>
					</div>
				</div>
				<div class="row mb-2">
          <div class="col-md-2" id="addbtndiv">
            <a type="button" class="btn-sm btn-primary" href="{{route('addnotification')}}">+ Add Notification</a>
          </div>
        </div>
				<div class="row mb-2">
					<div class="col-md-4">
						<div class="form-group">
							<label>Minimal</label>
							<select class="form-control select2" id="brand_change" style="width: 100%;">
								<option selected="selected" value="4">All</option>
							@foreach ($compact_val as $item)
							<option value="{{ $item->id }}"> {{ strtoupper($item->main_brand_name) }} </option>
							@endforeach
								<!-- <option value="1">NISSAN</option>
								<option value="2">RENAULT</option>
								<option value="3">INFINITI</option> -->
							</select>
						</div>
					</div>
					<div class="col-md-8" align="right">&nbsp;</div>
				</div>
			</div>
		</div>
		<section class="content">
			<div class="row">
				<div class="col-12">
					<div class="card card-primary card-outline">
						<div class="card-body">
							<table id="example29" class="table table-bordered table-striped common-datatable">
								<thead>
									<tr>
										<th>ID</th>
										<th>Image</th>
										<th>Title</th>
										<th>Description</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
								 <tfoot>
									<tr>
										 
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
	