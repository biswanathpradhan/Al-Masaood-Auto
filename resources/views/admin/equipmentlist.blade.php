<<<<<<< HEAD
<?php 
$language_id = Session::get('language_id');
$equipments_translations = getbackendTranslations('new_cars',null,$language_id);
$breadcrumb_translations = getbackendTranslations('breadcrumb ',null,$language_id);
$tradein_translations = getbackendTranslations('tradein',null,$language_id);
$newcars_translations = getbackendTranslations('new_cars',null,$language_id);
 ?> 
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h6 class="m-0 text-dark">@if(isset($model_name)) @if ($newcars_translations['model_name']) {{$newcars_translations['model_name']}} @else Model Name: @endif {{$model_name}} @endif </h6>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i>  @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
							<li class="breadcrumb-item active">@if ($equipments_translations['equipments']) {{$equipments_translations['equipments']}} @else Equipments @endif</li>
						</ol>
					</div>
					<div class="col-sm-6">
						<h6 class="m-0 text-dark">@if(isset($version_name)) @if ($newcars_translations['version_name']) {{$newcars_translations['version_name']}} @else Version Name: @endif {{$version_name}} @endif</h6>
						</div>
				</div>
				<div class="row mb-2">
          <div class="col-md-2">
            <a type="button" class="btn-sm btn-primary" href="{{route('addequipment')}}">+ @if ($equipments_translations['add_equipment']) {{$equipments_translations['add_equipment']}} @else Add Equipment @endif</a>  
          </div>
         
        </div>

        <!-- <div class="col-md-2">
            <h5 class="m-0 text-dark">@if(isset($version_name)) {{$version_name}} @endif</h5>
        </div> -->

       
			 
			</div>
		</div>
		<section class="content">
			<div class="row">
				<div class="col-12">
					<div class="card card-primary card-outline">
						<div class="card-body">
							<table id="example10" class="table table-bordered table-striped common-datatable">
								<thead>
									<tr>
										<th>@if ($equipments_translations['Id']) {{$equipments_translations['Id']}} @else ID @endif</th>
										 
										<th>@if ($equipments_translations['description']) {{$equipments_translations['description']}} @else Description @endif</th>
										<th>@if ($equipments_translations['on']) {{$equipments_translations['on']}} @else On @endif</th>
										<th>@if ($equipments_translations['edit']) {{$equipments_translations['edit']}} @else Edit @endif</th>
										<th>@if ($equipments_translations['delete']) {{$equipments_translations['delete']}} @else Delete @endif</th>
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
=======
<?php 
$language_id = Session::get('language_id');
$equipments_translations = getbackendTranslations('new_cars',null,$language_id);
$breadcrumb_translations = getbackendTranslations('breadcrumb ',null,$language_id);
$tradein_translations = getbackendTranslations('tradein',null,$language_id);
$newcars_translations = getbackendTranslations('new_cars',null,$language_id);
 ?> 
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h6 class="m-0 text-dark">@if(isset($model_name)) @if ($newcars_translations['model_name']) {{$newcars_translations['model_name']}} @else Model Name: @endif {{$model_name}} @endif </h6>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i>  @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
							<li class="breadcrumb-item active">@if ($equipments_translations['equipments']) {{$equipments_translations['equipments']}} @else Equipments @endif</li>
						</ol>
					</div>
					<div class="col-sm-6">
						<h6 class="m-0 text-dark">@if(isset($version_name)) @if ($newcars_translations['version_name']) {{$newcars_translations['version_name']}} @else Version Name: @endif {{$version_name}} @endif</h6>
						</div>
				</div>
				<div class="row mb-2">
          <div class="col-md-2">
            <a type="button" class="btn-sm btn-primary" href="{{route('addequipment')}}">+ @if ($equipments_translations['add_equipment']) {{$equipments_translations['add_equipment']}} @else Add Equipment @endif</a>  
          </div>
         
        </div>

        <!-- <div class="col-md-2">
            <h5 class="m-0 text-dark">@if(isset($version_name)) {{$version_name}} @endif</h5>
        </div> -->

       
			 
			</div>
		</div>
		<section class="content">
			<div class="row">
				<div class="col-12">
					<div class="card card-primary card-outline">
						<div class="card-body">
							<table id="example10" class="table table-bordered table-striped common-datatable">
								<thead>
									<tr>
										<th>@if ($equipments_translations['Id']) {{$equipments_translations['Id']}} @else ID @endif</th>
										 
										<th>@if ($equipments_translations['description']) {{$equipments_translations['description']}} @else Description @endif</th>
										<th>@if ($equipments_translations['on']) {{$equipments_translations['on']}} @else On @endif</th>
										<th>@if ($equipments_translations['edit']) {{$equipments_translations['edit']}} @else Edit @endif</th>
										<th>@if ($equipments_translations['delete']) {{$equipments_translations['delete']}} @else Delete @endif</th>
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
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
	