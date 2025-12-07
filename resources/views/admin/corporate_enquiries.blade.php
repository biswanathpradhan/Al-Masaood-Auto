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
						<h1 class="m-0 text-dark">@if ($corporate_translations['header_corporate_enquiry']) {{$corporate_translations['header_corporate_enquiry']}} @else Corporate Solutions @endif</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
							<li class="breadcrumb-item active">@if ($corporate_translations['header_corporate_enquiry']) {{$corporate_translations['header_corporate_enquiry']}} @else Corporate Solutions @endif</li>
						</ol>
					</div>
				</div>
				<div class="row mb-2">
         <!--  <div class="col-md-2" id="addbtndiv"  >
            <a type="button" class="btn-sm btn-primary" href="{{route('addcorporatesolutions')}}">+ Add</a>
          </div> -->
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
							<table id="example30" class="table table-bordered table-striped common-datatable">
								<thead>
									<tr>
										<th>@if ($corporate_translations['Id']) {{$corporate_translations['Id']}} @else ID @endif</th>
										<th> @if ($corporate_translations['title']) {{$corporate_translations['title']}} @else Title @endif </th>
										<th>@if ($corporate_translations['first_name']) {{$corporate_translations['first_name']}} @else First Name @endif  </th>
										<th>@if ($corporate_translations['last_name']) {{$corporate_translations['last_name']}} @else Last Name @endif  </th>
										<th>@if ($corporate_translations['email']) {{$corporate_translations['email']}} @else Email @endif  </th>
										<th>@if ($corporate_translations['mobile_number']) {{$corporate_translations['mobile_number']}} @else Mobile No @endif  </th>
										<th>@if ($corporate_translations['leasing_required']) {{$corporate_translations['leasing_required']}} @else Leasing Required @endif  </th>
										<th>@if ($corporate_translations['on']) {{$corporate_translations['on']}} @else On @endif </th>
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
	