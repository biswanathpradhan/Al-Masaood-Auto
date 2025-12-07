<?php 
$language_id = Session::get('language_id');
$specifications_translations = getbackendTranslations('specifications',null,$language_id);
$breadcrumb_translations = getbackendTranslations('breadcrumb ',null,$language_id);
$corporate_translations = getbackendTranslations('corporate_enquiry',null,$language_id);

 ?>   
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark">@if ($corporate_translations['corporate_solutions']) {{$corporate_translations['corporate_solutions']}} @else Corporate Solutions @endif</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
							<li class="breadcrumb-item active">@if ($corporate_translations['corporate_solutions']) {{$corporate_translations['corporate_solutions']}} @else Corporate Solutions @endif </li>
						</ol>
					</div>
				</div>
				<div class="row mb-2">
          <div class="col-md-2" id="addbtndiv"  >
            <a type="button" class="btn-sm btn-primary" href="{{route('addcorporatesolutions')}}">+ @if ($corporate_translations['btn_add']) {{$corporate_translations['btn_add']}} @else Add @endif</a>
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
							<table id="example28" class="table table-bordered table-striped common-datatable">
								<thead>
									<tr>
										<th>@if ($corporate_translations['Id']) {{$corporate_translations['Id']}} @else ID @endif</th>
										<th> @if ($corporate_translations['title']) {{$corporate_translations['title']}} @else Title @endif </th>
										<th>@if ($corporate_translations['description']) {{$corporate_translations['description']}} @else Description @endif</th>
										<th>@if ($corporate_translations['edit']) {{$corporate_translations['edit']}} @else Edit @endif</th>
										<th>@if ($corporate_translations['delete']) {{$corporate_translations['delete']}} @else Delete @endif </th>
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
	