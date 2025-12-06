<?php 
$language_id = Session::get('language_id');
$service_menu_translations = getbackendTranslations('appointments',null,$language_id);
$breadcrumb_translations = getbackendTranslations('breadcrumb ',null,$language_id);
$corporate_translations = getbackendTranslations('corporate_enquiry',null,$language_id);

 ?>  
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark" id="change_h1">@if ($service_menu_translations['heading_appointments']) {{$service_menu_translations['heading_appointments']}} @else All Appointment @endif </h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
							<li class="breadcrumb-item active">@if ($service_menu_translations['breadcrumb_appointments']) {{$service_menu_translations['breadcrumb_appointments']}} @else Book An Appointment @endif </li>
						</ol>
					</div>
				</div>
				<div class="row mb-2">
         <!--  <div class="col-md-2" id="addbtndiv"  >
            <a type="button" class="btn-sm btn-primary" href="{{route('addlocation')}}">+ Add</a>
          </div> -->
        </div>
				<div class="row mb-2">
					<div class="col-md-4">
						<div class="form-group">
							<label>@if ($service_menu_translations['minimal']) {{$service_menu_translations['minimal']}} @else Minimal @endif</label>
							<select class="form-control select2" id="brand_change" style="width: 100%;">
								<option selected="selected" value="">All</option>
							@foreach ($compact_val as $item)
							<option value="{{ $item->id }}"> {{ strtoupper($item->main_brand_name) }} </option>
							@endforeach
								<!-- <option value="1">NISSAN</option>
								<option value="2">RENAULT</option>
								<option value="3">INFINITI</option> -->
							</select>
						</div>
					</div>

					<div class="col-md-4">
						 
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
							<table id="example16" class="table table-bordered table-striped table-responsive-xl">
								<thead>
									<tr>
										<th>@if ($service_menu_translations['Id']) {{$service_menu_translations['Id']}} @else ID @endif</th>
										<th>@if ($service_menu_translations['name']) {{$service_menu_translations['name']}} @else Name @endif </th>
										<th>@if ($service_menu_translations['mobile']) {{$service_menu_translations['mobile']}} @else Mobile @endif</th>
										 
										<th>@if ($service_menu_translations['email']) {{$service_menu_translations['email']}} @else Email @endif</th>
										<th>@if ($service_menu_translations['chassis_no']) {{$service_menu_translations['chassis_no']}} @else Chassis No @endif</th>
										<th>@if ($service_menu_translations['model_name']) {{$service_menu_translations['model_name']}} @else Model Name @endif</th>
										<th>@if ($service_menu_translations['service_needed']) {{$service_menu_translations['service_needed']}} @else Service Needed @endif</th>
										<th>@if ($service_menu_translations['on']) {{$service_menu_translations['on']}} @else On @endif</th>
										<th>@if ($service_menu_translations['appointment_on']) {{$service_menu_translations['appointment_on']}} @else Appointment On @endif</th>
										<th>@if ($service_menu_translations['car_rental_required']) {{$service_menu_translations['car_rental_required']}} @else Car Rental Required @endif</th>
										<th>@if ($service_menu_translations['location']) {{$service_menu_translations['location']}} @else Location @endif</th>
										<th>@if ($service_menu_translations['car_service_track']) {{$service_menu_translations['car_service_track']}} @else Car Service Track @endif</th>
										<th>@if ($service_menu_translations['pickup_car']) {{$service_menu_translations['pickup_car']}} @else Pickup Car @endif</th>
										<th>@if ($service_menu_translations['notifications']) {{$service_menu_translations['notifications']}} @else Notifications @endif </th>
									 	<th>@if ($service_menu_translations['rescheduled']) {{$service_menu_translations['rescheduled']}} @else Rescheduled @endif </th>
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
