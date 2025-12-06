<?php 
$language_id = Session::get('language_id');
$model_translations = getbackendTranslations('new_cars',null,$language_id);
$breadcrumb_translations = getbackendTranslations('breadcrumb ',null,$language_id);
$tradein_translations = getbackendTranslations('tradein',null,$language_id);
 ?> 
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark">@if(isset($model_name)) {{$model_name}} @endif</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i>  @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
							<li class="breadcrumb-item active">@if ($model_translations['breadcrumb_new_cars']) {{$model_translations['breadcrumb_new_cars']}} @else Models @endif</li>
						</ol>
					</div>
				</div>
				<div class="row mb-2">
          <div class="col-md-2">
            <a type="button" class="btn-sm btn-primary" href="{{route('addversion',url_encode($model_id))}}">+ @if ($model_translations['btn_add_version_specs']) {{$model_translations['btn_add_version_specs']}} @else Add Version & Specs @endif </a>
          </div>
        </div>
				<div class="row mb-2">
					<div class="col-md-4">
						<div class="form-group">
							<label>@if ($model_translations['minimal']) {{$model_translations['minimal']}} @else Minimal @endif</label>
							<select class="form-control select2" style="width: 100%;">
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
							<table id="example5" class="table table-bordered table-striped ">
								<thead>
									<tr>
										<th>@if ($model_translations['Id']) {{$model_translations['Id']}} @else ID @endif</th>
										<th>@if ($model_translations['version_name']) {{$model_translations['version_name']}} @else Version Name @endif</th>
										<th>@if ($model_translations['image']) {{$model_translations['image']}} @else Image @endif</th>
										<th>@if ($model_translations['starting_price']) {{$model_translations['starting_price']}} @else Starting Price @endif</th>
										<th>@if ($model_translations['specifications']) {{$model_translations['specifications']}} @else Specifications @endif</th>
										<th>@if ($model_translations['equipments']) {{$model_translations['equipments']}} @else Equipments @endif</th>
										<th>@if ($model_translations['interiors']) {{$model_translations['interiors']}} @else Interiors @endif</th>
										<th>@if ($model_translations['exteriors']) {{$model_translations['exteriors']}} @else Exteriors @endif</th>
										<th>@if ($model_translations['accessories']) {{$model_translations['accessories']}} @else Accessories @endif</th>
										<th>@if ($model_translations['edit']) {{$model_translations['edit']}} @else Edit @endif</th>
										<th>@if ($model_translations['delete']) {{$model_translations['delete']}} @else Delete @endif</th>


	 


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
	