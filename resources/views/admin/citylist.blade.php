<?php 
$language_id = Session::get('language_id');
$service_menu_translations = getbackendTranslations('city',null,$language_id);
$breadcrumb_translations = getbackendTranslations('breadcrumb ',null,$language_id);
$corporate_translations = getbackendTranslations('corporate_enquiry',null,$language_id);

 ?> 
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark">@if ($service_menu_translations['heading_city']) {{$service_menu_translations['heading_city']}} @else City @endif</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
							<li class="breadcrumb-item active">@if ($service_menu_translations['breadcrumb_city']) {{$service_menu_translations['breadcrumb_city']}} @else City @endif</li>
						</ol>
					</div>
				</div>
				<div class="row mb-2">
          <div class="col-md-2" id="addbtndiv"  >
            <a type="button" class="btn-sm btn-primary" href="{{route('addcity')}}">+ @if ($service_menu_translations['add_city']) {{$service_menu_translations['add_city']}} @else Add City @endif </a>
          </div>
			@if($errors->any())
			<div class="alert alert-danger" role="alert">
			
			<h4>{{$errors->first()}}</h4>
			
			</div>
			@endif
        </div>
				 
			</div>
		</div>
		<section class="content">
			<div class="row">
				<div class="col-12">
					<div class="card card-primary card-outline">
						<div class="card-body">
							<table id="example22" class="table table-bordered table-striped common-datatable">
								<thead>
									<tr>
										<th>@if ($service_menu_translations['Id']) {{$service_menu_translations['Id']}} @else ID @endif</th>
										<th>@if ($service_menu_translations['city']) {{$service_menu_translations['city']}} @else City @endif</th>
										<th>@if ($service_menu_translations['btn_edit']) {{$service_menu_translations['btn_edit']}} @else Edit @endif</th>
										<th>@if ($service_menu_translations['btn_delete']) {{$service_menu_translations['btn_delete']}} @else Delete @endif </th>
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
	
