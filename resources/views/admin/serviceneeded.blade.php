<?php 
$language_id = Session::get('language_id');
$service_menu_translations = getbackendTranslations('service_needed',null,$language_id);
$breadcrumb_translations = getbackendTranslations('breadcrumb ',null,$language_id);
$corporate_translations = getbackendTranslations('corporate_enquiry',null,$language_id);

 ?>   
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark">@if ($service_menu_translations['heading_serviceneeded']) {{$service_menu_translations['heading_serviceneeded']}} @else Service Needed @endif </h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
							<li class="breadcrumb-item active">@if ($service_menu_translations['heading_serviceneeded']) {{$service_menu_translations['heading_serviceneeded']}} @else Service Needed @endif</li>
						</ol>
					</div>
				</div>
				<div class="row mb-2">
          <div class="col-md-2" id="addbtndiv"  >
            <a type="button" class="btn-sm btn-primary" href="{{route('addserviceneeded')}}">+ @if ($service_menu_translations['btn_add']) {{$service_menu_translations['btn_add']}} @else Add @endif</a>
          </div>
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
							<table id="example14" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>@if ($service_menu_translations['Id']) {{$service_menu_translations['Id']}} @else ID @endif </th>
										<th>@if ($service_menu_translations['title']) {{$service_menu_translations['title']}} @else Title @endif  </th>
										<th>@if ($service_menu_translations['date']) {{$service_menu_translations['date']}} @else Date @endif   </th>
										<th>@if ($service_menu_translations['btn_edit']) {{$service_menu_translations['btn_edit']}} @else Edit @endif  </th>
										<th>@if ($service_menu_translations['btn_delete']) {{$service_menu_translations['btn_delete']}} @else Delete @endif  </th>
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
