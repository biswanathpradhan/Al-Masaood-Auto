<<<<<<< HEAD
<?php 
$language_id = Session::get('language_id');
$onboarding_screen_translations = getbackendTranslations('onboarding_screen',null,$language_id);
$breadcrumb_translations = getbackendTranslations('breadcrumb ',null,$language_id);
$service_menu_translations = getbackendTranslations('tradein',null,$language_id);
 ?>
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark">@if ($onboarding_screen_translations['heading_onboarding_screen']) {{$onboarding_screen_translations['heading_onboarding_screen']}} @else  All Onboarding Screens @endif </h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
							<li class="breadcrumb-item active">@if ($onboarding_screen_translations['breadcrumb_onboarding_screen']) {{$onboarding_screen_translations['breadcrumb_onboarding_screen']}} @else Onboarding Screens @endif </li>
						</ol>
					</div>
				</div>
				<div class="row mb-2">
          <div class="col-md-2" id="addbtndiv"  >
            <a type="button" class="btn-sm btn-primary" href="{{route('addonboarding')}}"> @if ($onboarding_screen_translations['btn_add']) {{$onboarding_screen_translations['btn_add']}} @else Add @endif </a>
          </div>
        </div>
				<div class="row mb-2">
					<div class="col-md-4">
						<div class="form-group">
							<label>Minimal</label>
							<select class="form-control select2" id="brand_change" style="width: 100%;">
								<option selected="selected" value="4">All</option>
							@foreach ($compact_val as $item)
							<option value="{{ $item->id }}"> {{ strtoupper($item->main_brand_name) }} </option>
							@endforeach
							 
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
							<table id="example21" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>@if ($onboarding_screen_translations['Id']) {{$onboarding_screen_translations['Id']}} @else ID @endif</th>
										<th>@if ($onboarding_screen_translations['image']) {{$onboarding_screen_translations['image']}} @else Image @endif</th>
										<th>@if ($onboarding_screen_translations['description']) {{$onboarding_screen_translations['description']}} @else Description @endif</th>
										<th>@if ($onboarding_screen_translations['avail_offers_users_list']) {{$onboarding_screen_translations['avail_offers_users_list']}} @else Avail Offer Users List @endif</th>
										<th>@if ($onboarding_screen_translations['likes']) {{$onboarding_screen_translations['likes']}} @else Likes @endif</th>
										<th>@if ($onboarding_screen_translations['btn_edit']) {{$onboarding_screen_translations['btn_edit']}} @else Edit @endif</th>
										<th>@if ($onboarding_screen_translations['btn_delete']) {{$onboarding_screen_translations['btn_delete']}} @else Delete @endif</th>
									 
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
	    <div class="modal fade" id="imagemodal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">              
      <div class="modal-body">
      	    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary card-outline">
            <div class="card-body">
              <table id="example31"  class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>@if ($onboarding_screen_translations['Id']) {{$onboarding_screen_translations['Id']}} @else ID @endif</th>
                    <th>@if ($onboarding_screen_translations['user_name']) {{$onboarding_screen_translations['user_name']}} @else User Name @endif</th>
                    <th>@if ($onboarding_screen_translations['mobile_number']) {{$onboarding_screen_translations['mobile_number']}} @else Mobile Number @endif</th>
                    <th>@if ($onboarding_screen_translations['on']) {{$onboarding_screen_translations['on']}} @else On @endif</th>
                    
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
      <input id="my_id" data-id="" class="imagepreview" style="width: 100%;" type="hidden" >
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">@if ($service_menu_translations['btn_close']) {{$service_menu_translations['btn_close']}} @else  Close @endif </span></button>
        
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
$onboarding_screen_translations = getbackendTranslations('onboarding_screen',null,$language_id);
$breadcrumb_translations = getbackendTranslations('breadcrumb ',null,$language_id);
$service_menu_translations = getbackendTranslations('tradein',null,$language_id);
 ?>
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark">@if ($onboarding_screen_translations['heading_onboarding_screen']) {{$onboarding_screen_translations['heading_onboarding_screen']}} @else  All Onboarding Screens @endif </h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
							<li class="breadcrumb-item active">@if ($onboarding_screen_translations['breadcrumb_onboarding_screen']) {{$onboarding_screen_translations['breadcrumb_onboarding_screen']}} @else Onboarding Screens @endif </li>
						</ol>
					</div>
				</div>
				<div class="row mb-2">
          <div class="col-md-2" id="addbtndiv"  >
            <a type="button" class="btn-sm btn-primary" href="{{route('addonboarding')}}"> @if ($onboarding_screen_translations['btn_add']) {{$onboarding_screen_translations['btn_add']}} @else Add @endif </a>
          </div>
        </div>
				<div class="row mb-2">
					<div class="col-md-4">
						<div class="form-group">
							<label>Minimal</label>
							<select class="form-control select2" id="brand_change" style="width: 100%;">
								<option selected="selected" value="4">All</option>
							@foreach ($compact_val as $item)
							<option value="{{ $item->id }}"> {{ strtoupper($item->main_brand_name) }} </option>
							@endforeach
							 
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
							<table id="example21" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>@if ($onboarding_screen_translations['Id']) {{$onboarding_screen_translations['Id']}} @else ID @endif</th>
										<th>@if ($onboarding_screen_translations['image']) {{$onboarding_screen_translations['image']}} @else Image @endif</th>
										<th>@if ($onboarding_screen_translations['description']) {{$onboarding_screen_translations['description']}} @else Description @endif</th>
										<th>@if ($onboarding_screen_translations['avail_offers_users_list']) {{$onboarding_screen_translations['avail_offers_users_list']}} @else Avail Offer Users List @endif</th>
										<th>@if ($onboarding_screen_translations['likes']) {{$onboarding_screen_translations['likes']}} @else Likes @endif</th>
										<th>@if ($onboarding_screen_translations['btn_edit']) {{$onboarding_screen_translations['btn_edit']}} @else Edit @endif</th>
										<th>@if ($onboarding_screen_translations['btn_delete']) {{$onboarding_screen_translations['btn_delete']}} @else Delete @endif</th>
									 
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
	    <div class="modal fade" id="imagemodal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">              
      <div class="modal-body">
      	    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary card-outline">
            <div class="card-body">
              <table id="example31"  class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>@if ($onboarding_screen_translations['Id']) {{$onboarding_screen_translations['Id']}} @else ID @endif</th>
                    <th>@if ($onboarding_screen_translations['user_name']) {{$onboarding_screen_translations['user_name']}} @else User Name @endif</th>
                    <th>@if ($onboarding_screen_translations['mobile_number']) {{$onboarding_screen_translations['mobile_number']}} @else Mobile Number @endif</th>
                    <th>@if ($onboarding_screen_translations['on']) {{$onboarding_screen_translations['on']}} @else On @endif</th>
                    
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
      <input id="my_id" data-id="" class="imagepreview" style="width: 100%;" type="hidden" >
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">@if ($service_menu_translations['btn_close']) {{$service_menu_translations['btn_close']}} @else  Close @endif </span></button>
        
      </div>
       <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">@if ($service_menu_translations['btn_close']) {{$service_menu_translations['btn_close']}} @else  Close @endif</button>
          <!-- <button type="button" class="btn btn-primary" id="delete" onclick="return deleteItemversion(this)">@if ($service_menu_translations['btn_delete']) {{$service_menu_translations['btn_delete']}} @else  Delete @endif</button> -->
        </div>
    </div>
  </div>
</div>
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
