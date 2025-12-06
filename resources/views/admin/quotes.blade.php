<?php 
$language_id = Session::get('language_id');
$service_menu_translations = getbackendTranslations('quotes',null,$language_id);
$breadcrumb_translations = getbackendTranslations('breadcrumb ',null,$language_id);
$corporate_translations = getbackendTranslations('corporate_enquiry',null,$language_id);

 ?> 
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark"> @if ($service_menu_translations['heading_quote']) {{$service_menu_translations['heading_quote']}} @else Get A Quote @endif  </h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
							<li class="breadcrumb-item active">@if ($service_menu_translations['breadcrumb_quote']) {{$service_menu_translations['breadcrumb_quote']}} @else Get A Quote @endif</li>
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
							<table id="example9" class="table table-bordered table-striped">
								<thead>
									<tr>
								<!-- 		<th>ID</th>
										<th>User Name</th>
										<th>Mobile Number</th>
										<th>Email</th>
										<th>Model Name</th>
										<th>Created On</th>
										<th>City</th>
										<th>Showroom</th> -->

											<th>@if ($service_menu_translations['Id']) {{$service_menu_translations['Id']}} @else ID @endif</th>
										<th>@if ($service_menu_translations['user_name']) {{$service_menu_translations['user_name']}} @else User Name @endif </th>
										<th>@if ($service_menu_translations['mobile_number']) {{$service_menu_translations['mobile_number']}} @else Mobile Number @endif</th>
										 
										<th>@if ($service_menu_translations['email']) {{$service_menu_translations['email']}} @else Email @endif</th>

										<th>@if ($service_menu_translations['model_name']) {{$service_menu_translations['model_name']}} @else Model Name @endif</th>
										<th>@if ($service_menu_translations['created_on']) {{$service_menu_translations['created_on']}} @else Created On @endif</th>
										<th>@if ($service_menu_translations['city']) {{$service_menu_translations['city']}} @else City @endif</th>
										<th>@if ($service_menu_translations['showroom']) {{$service_menu_translations['showroom']}} @else Showroom @endif </th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
								
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
	