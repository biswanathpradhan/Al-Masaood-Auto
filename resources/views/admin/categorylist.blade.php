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
						<h1 class="m-0 text-dark">@if(isset($model_name)) {{$model_name}} @endif</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
							<li class="breadcrumb-item">@if ($specifications_translations['specifications']) {{$specifications_translations['specifications']}} @else Specification @endif</li>
							<li class="breadcrumb-item active">@if ($specifications_translations['category']) {{$specifications_translations['category']}} @else Category @endif </li>
						</ol>
					</div>
				</div>
				<div class="row mb-2">
          <div class="col-md-2">
            <a type="button" class="btn-sm btn-primary" href="{{route('addcategory')}}">+  @if ($specifications_translations['add_category']) {{$specifications_translations['add_category']}} @else Add Category @endif </a>
          </div>
        </div>
				<div class="row mb-2">
					<div class="col-md-4">
						<div class="form-group">
							<label> @if ($specifications_translations['minimal']) {{$specifications_translations['minimal']}} @else Minimal @endif </label>
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
							<table id="example7" class="table table-bordered table-striped common-datatable">
								<thead>
									<tr>
										<th>@if ($specifications_translations['Id']) {{$specifications_translations['Id']}} @else ID @endif</th>
										<th>@if ($specifications_translations['title']) {{$specifications_translations['title']}} @else Title @endif </th>
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
	
