<?php 
$language_id = Session::get('language_id');
$specifications_translations = getbackendTranslations('specifications',null,$language_id);
$breadcrumb_translations = getbackendTranslations('breadcrumb ',null,$language_id);
$tradein_translations = getbackendTranslations('tradein',null,$language_id);
$newcars_translations = getbackendTranslations('new_cars',null,$language_id);
 ?> 
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h6 class="m-0 text-dark">@if(isset($model_name)) @if ($newcars_translations['model_name']) {{$newcars_translations['model_name']}} @else Model Name: @endif  {{$model_name}} @endif </h6>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
							<li class="breadcrumb-item active">@if ($specifications_translations['specifications']) {{$specifications_translations['specifications']}} @else Specification @endif </li>
						</ol>
					</div>
						<div class="col-sm-6">
						<h6 class="m-0 text-dark">@if(isset($version_name)) @if ($newcars_translations['version_name']) {{$newcars_translations['version_name']}} @else Version Name: @endif  {{$version_name}} @endif</h6>
						</div>
				</div>
				<div class="row mb-2">
          <div class="col-md-2">
            <a type="button" class="btn-sm btn-primary" href="{{route('addspecification')}}">+ @if ($specifications_translations['add_specification']) {{$specifications_translations['add_specification']}} @else Add Specification @endif </a>  <a type="button" class="btn-sm btn-primary" href="{{route('getcategorylist')}}"> @if ($specifications_translations['view_category']) {{$specifications_translations['view_category']}} @else View Category @endif</a>
          </div>
         
        </div>

       <!--  <div class="col-md-2">
            <h5 class="m-0 text-dark">@if(isset($version_name)) {{$version_name}} @endif</h5>
        </div> -->

       
				<div class="row mb-2">
					<div class="col-md-4">
						<div class="form-group">
							<label>Minimal</label>
							<select class="form-control select2" style="width: 100%;">
								<option selected="selected" value="4">All</option>
							@foreach ($compact_val as $item)
							<option value="{{ $item->id }}" @if($main_brand_id == $item->id) selected  @endif > {{ strtoupper($item->main_brand_name) }} </option>
							@endforeach
							 
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
							<table id="example6" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>@if ($specifications_translations['Id']) {{$specifications_translations['Id']}} @else ID @endif</th>
										<th>@if ($specifications_translations['category']) {{$specifications_translations['category']}} @else Category @endif</th>
										<th>@if ($specifications_translations['description']) {{$specifications_translations['description']}} @else Description @endif</th>
										<th>@if ($specifications_translations['on']) {{$specifications_translations['on']}} @else On @endif</th>
										<th>@if ($specifications_translations['edit']) {{$specifications_translations['edit']}} @else Edit @endif</th>
										<th>@if ($specifications_translations['delete']) {{$specifications_translations['delete']}} @else Delete @endif</th>
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
	