<<<<<<< HEAD
<?php 
$language_id = Session::get('language_id');
$service_menu_translations = getbackendTranslations('tradein',null,$language_id);
$breadcrumb_translations = getbackendTranslations('breadcrumb ',null,$language_id);
$corporate_translations = getbackendTranslations('corporate_enquiry',null,$language_id);

 ?> 
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark"> @if ($service_menu_translations['heading_tradein']) {{$service_menu_translations['heading_tradein']}} @else Trade In @endif </h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
							<li class="breadcrumb-item active">@if ($service_menu_translations['breadcrumb_tradein']) {{$service_menu_translations['breadcrumb_tradein']}} @else Trade In @endif </li>
						</ol>
					</div>
				</div>
				<div class="row mb-2">
          <div class="col-md-2">
          <!--   <a type="button" class="btn-sm btn-primary" href="#"> </a> -->
          </div>
        </div>
				<div class="row mb-2">
					<div class="col-md-4">
						<div class="form-group">
							<label>@if ($service_menu_translations['minimal']) {{$service_menu_translations['minimal']}} @else Minimal @endif</label>
							<select class="form-control select2" style="width: 100%;" name="model_id_filter" id="model_id_filter">
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
							<table id="example12" width="100%" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>@if ($service_menu_translations['Id']) {{$service_menu_translations['Id']}} @else ID @endif</th>
										<th>@if ($service_menu_translations['user_name']) {{$service_menu_translations['user_name']}} @else User Name @endif </th>
										<th>@if ($service_menu_translations['mobile_number']) {{$service_menu_translations['mobile_number']}} @else Mobile Number @endif</th>
										 
										<th>@if ($service_menu_translations['email']) {{$service_menu_translations['email']}} @else Email @endif</th>
										<th>@if ($service_menu_translations['user_car']) {{$service_menu_translations['user_car']}} @else User Car @endif </th>

										<th>@if ($service_menu_translations['model_name']) {{$service_menu_translations['model_name']}} @else Model Name @endif</th>
										<th>@if ($service_menu_translations['required_car_brand']) {{$service_menu_translations['required_car_brand']}} @else Required Car Brand @endif </th>
										<th>@if ($service_menu_translations['mileage']) {{$service_menu_translations['mileage']}} @else Mileage @endif  </th>
										<th>@if ($service_menu_translations['on']) {{$service_menu_translations['on']}} @else On @endif</th>
										<th>@if ($service_menu_translations['image']) {{$service_menu_translations['image']}} @else Images @endif </th>
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
	
	    <div class="modal fade" id="imagemodal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">              
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">@if ($service_menu_translations['btn_close']) {{$service_menu_translations['btn_close']}} @else  Close @endif </span></button>
        <img id="my_image" src="" class="imagepreview" style="width: 100%;" >
      </div>
       <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">@if ($service_menu_translations['btn_close']) {{$service_menu_translations['btn_close']}} @else  Close @endif</button>
          <!-- <button type="button" class="btn btn-primary" id="delete" onclick="return deleteItemversion(this)">@if ($service_menu_translations['btn_delete']) {{$service_menu_translations['btn_delete']}} @else  Delete @endif</button> -->
        </div>
    </div>
  </div>
</div>
=======
<?php 
$language_id = Session::get('language_id');
$service_menu_translations = getbackendTranslations('tradein',null,$language_id);
$breadcrumb_translations = getbackendTranslations('breadcrumb ',null,$language_id);
$corporate_translations = getbackendTranslations('corporate_enquiry',null,$language_id);

 ?> 
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark"> @if ($service_menu_translations['heading_tradein']) {{$service_menu_translations['heading_tradein']}} @else Trade In @endif </h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
							<li class="breadcrumb-item active">@if ($service_menu_translations['breadcrumb_tradein']) {{$service_menu_translations['breadcrumb_tradein']}} @else Trade In @endif </li>
						</ol>
					</div>
				</div>
				<div class="row mb-2">
          <div class="col-md-2">
          <!--   <a type="button" class="btn-sm btn-primary" href="#"> </a> -->
          </div>
        </div>
				<div class="row mb-2">
					<div class="col-md-4">
						<div class="form-group">
							<label>@if ($service_menu_translations['minimal']) {{$service_menu_translations['minimal']}} @else Minimal @endif</label>
							<select class="form-control select2" style="width: 100%;" name="model_id_filter" id="model_id_filter">
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
							<table id="example12" width="100%" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>@if ($service_menu_translations['Id']) {{$service_menu_translations['Id']}} @else ID @endif</th>
										<th>@if ($service_menu_translations['user_name']) {{$service_menu_translations['user_name']}} @else User Name @endif </th>
										<th>@if ($service_menu_translations['mobile_number']) {{$service_menu_translations['mobile_number']}} @else Mobile Number @endif</th>
										 
										<th>@if ($service_menu_translations['email']) {{$service_menu_translations['email']}} @else Email @endif</th>
										<th>@if ($service_menu_translations['user_car']) {{$service_menu_translations['user_car']}} @else User Car @endif </th>

										<th>@if ($service_menu_translations['model_name']) {{$service_menu_translations['model_name']}} @else Model Name @endif</th>
										<th>@if ($service_menu_translations['required_car_brand']) {{$service_menu_translations['required_car_brand']}} @else Required Car Brand @endif </th>
										<th>@if ($service_menu_translations['mileage']) {{$service_menu_translations['mileage']}} @else Mileage @endif  </th>
										<th>@if ($service_menu_translations['on']) {{$service_menu_translations['on']}} @else On @endif</th>
										<th>@if ($service_menu_translations['image']) {{$service_menu_translations['image']}} @else Images @endif </th>
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
	
	    <div class="modal fade" id="imagemodal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">              
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">@if ($service_menu_translations['btn_close']) {{$service_menu_translations['btn_close']}} @else  Close @endif </span></button>
        <img id="my_image" src="" class="imagepreview" style="width: 100%;" >
      </div>
       <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">@if ($service_menu_translations['btn_close']) {{$service_menu_translations['btn_close']}} @else  Close @endif</button>
          <!-- <button type="button" class="btn btn-primary" id="delete" onclick="return deleteItemversion(this)">@if ($service_menu_translations['btn_delete']) {{$service_menu_translations['btn_delete']}} @else  Delete @endif</button> -->
        </div>
    </div>
  </div>
</div>
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
