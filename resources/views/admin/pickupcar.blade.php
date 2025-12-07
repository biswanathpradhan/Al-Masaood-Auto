<<<<<<< HEAD
<?php 
$language_id = Session::get('language_id');
$service_menu_translations = getbackendTranslations('pickupcar',null,$language_id);
$breadcrumb_translations = getbackendTranslations('breadcrumb ',null,$language_id);
$corporate_translations = getbackendTranslations('corporate_enquiry',null,$language_id);

 ?>  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@if ($service_menu_translations['heading_pickupcar']) {{$service_menu_translations['heading_pickupcar']}} @else ALL PICKUP CAR SERVICE @endif </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
              <li class="breadcrumb-item active">@if ($service_menu_translations['breadcrumb_pickupcar']) {{$service_menu_translations['breadcrumb_pickupcar']}} @else ALL PICKUP CAR SERVICE @endif</li>
            </ol>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-md-4">
            <div class="form-group">
              <label>@if ($service_menu_translations['minimal']) {{$service_menu_translations['minimal']}} @else Minimal @endif </label>
              <select class="form-control select2" name="model_id_filter" id="model_id_filter">
                <option selected="selected" value="4">All</option>
                <option value="1">NISSAN</option>
                <option value="2">RENAULT</option>
                <option value="3">INFINITI</option>
              </select>
            </div>
          </div>
 
        </div>
 <div class="row mb-12">

   <div class="col-md-4">
            <div class="form-group">
              <label>@if ($service_menu_translations['car_delivery_location']) {{$service_menu_translations['car_delivery_location']}} @else Car Delivery Location @endif </label>
              <select class="form-control select2" name="car_delivery_id_filter" id="car_delivery_id_filter">
                <option selected="selected" value="">All</option>
                <option value="0">Service Center</option>
                <option value="1">User Address</option>
                 
              </select>
            </div>
          </div>

           <div class="col-md-4">
            <div class="form-group">
              <label>@if ($service_menu_translations['case_of_car']) {{$service_menu_translations['case_of_car']}} @else Case of Car @endif </label>
              <select class="form-control select2" name="case_of_car_id_filter" id="case_of_car_id_filter">
                <option selected="selected" value="">All</option>
                <option value="0">Normal</option>
                <option value="1">Breakdown</option>
              </select>
            </div>
          </div>

           <div class="col-md-4">
            <div class="form-group">
              <label>@if ($service_menu_translations['rental_car_required']) {{$service_menu_translations['rental_car_required']}} @else Rental Car @endif  </label>
              <select class="form-control select2" name="rental_car_id_filter" id="rental_car_id_filter">
                <option selected="selected" value="">All</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
          </div>
 </div>

      </div>
    </div>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary card-outline">
            <div class="card-body">
              <table id="example25" class="table table-bordered table-striped common-datatable">
                <thead>
                  <tr>
                    <th>@if ($service_menu_translations['Id']) {{$service_menu_translations['Id']}} @else ID @endif</th>
                    <th>@if ($service_menu_translations['name']) {{$service_menu_translations['name']}} @else Name @endif </th>
                    <th>@if ($service_menu_translations['mobile']) {{$service_menu_translations['mobile']}} @else Mobile @endif</th>
                     
                    <th>@if ($service_menu_translations['email']) {{$service_menu_translations['email']}} @else Email @endif</th>
                    <th>@if ($service_menu_translations['car_delivery_location']) {{$service_menu_translations['car_delivery_location']}} @else Car Delivery Location @endif</th>
                    <th>@if ($service_menu_translations['address']) {{$service_menu_translations['address']}} @else Address @endif </th>
                    <th>@if ($service_menu_translations['case_of_car']) {{$service_menu_translations['case_of_car']}} @else Case of Car @endif</th>
                    <th>@if ($service_menu_translations['rental_car_required']) {{$service_menu_translations['rental_car_required']}} @else Rental Car @endif</th>
                    <th width="10%">@if ($service_menu_translations['on']) {{$service_menu_translations['on']}} @else On @endif</th>
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
 
=======
<?php 
$language_id = Session::get('language_id');
$service_menu_translations = getbackendTranslations('pickupcar',null,$language_id);
$breadcrumb_translations = getbackendTranslations('breadcrumb ',null,$language_id);
$corporate_translations = getbackendTranslations('corporate_enquiry',null,$language_id);

 ?>  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@if ($service_menu_translations['heading_pickupcar']) {{$service_menu_translations['heading_pickupcar']}} @else ALL PICKUP CAR SERVICE @endif </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
              <li class="breadcrumb-item active">@if ($service_menu_translations['breadcrumb_pickupcar']) {{$service_menu_translations['breadcrumb_pickupcar']}} @else ALL PICKUP CAR SERVICE @endif</li>
            </ol>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-md-4">
            <div class="form-group">
              <label>@if ($service_menu_translations['minimal']) {{$service_menu_translations['minimal']}} @else Minimal @endif </label>
              <select class="form-control select2" name="model_id_filter" id="model_id_filter">
                <option selected="selected" value="4">All</option>
                <option value="1">NISSAN</option>
                <option value="2">RENAULT</option>
                <option value="3">INFINITI</option>
              </select>
            </div>
          </div>
 
        </div>
 <div class="row mb-12">

   <div class="col-md-4">
            <div class="form-group">
              <label>@if ($service_menu_translations['car_delivery_location']) {{$service_menu_translations['car_delivery_location']}} @else Car Delivery Location @endif </label>
              <select class="form-control select2" name="car_delivery_id_filter" id="car_delivery_id_filter">
                <option selected="selected" value="">All</option>
                <option value="0">Service Center</option>
                <option value="1">User Address</option>
                 
              </select>
            </div>
          </div>

           <div class="col-md-4">
            <div class="form-group">
              <label>@if ($service_menu_translations['case_of_car']) {{$service_menu_translations['case_of_car']}} @else Case of Car @endif </label>
              <select class="form-control select2" name="case_of_car_id_filter" id="case_of_car_id_filter">
                <option selected="selected" value="">All</option>
                <option value="0">Normal</option>
                <option value="1">Breakdown</option>
              </select>
            </div>
          </div>

           <div class="col-md-4">
            <div class="form-group">
              <label>@if ($service_menu_translations['rental_car_required']) {{$service_menu_translations['rental_car_required']}} @else Rental Car @endif  </label>
              <select class="form-control select2" name="rental_car_id_filter" id="rental_car_id_filter">
                <option selected="selected" value="">All</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
          </div>
 </div>

      </div>
    </div>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary card-outline">
            <div class="card-body">
              <table id="example25" class="table table-bordered table-striped common-datatable">
                <thead>
                  <tr>
                    <th>@if ($service_menu_translations['Id']) {{$service_menu_translations['Id']}} @else ID @endif</th>
                    <th>@if ($service_menu_translations['name']) {{$service_menu_translations['name']}} @else Name @endif </th>
                    <th>@if ($service_menu_translations['mobile']) {{$service_menu_translations['mobile']}} @else Mobile @endif</th>
                     
                    <th>@if ($service_menu_translations['email']) {{$service_menu_translations['email']}} @else Email @endif</th>
                    <th>@if ($service_menu_translations['car_delivery_location']) {{$service_menu_translations['car_delivery_location']}} @else Car Delivery Location @endif</th>
                    <th>@if ($service_menu_translations['address']) {{$service_menu_translations['address']}} @else Address @endif </th>
                    <th>@if ($service_menu_translations['case_of_car']) {{$service_menu_translations['case_of_car']}} @else Case of Car @endif</th>
                    <th>@if ($service_menu_translations['rental_car_required']) {{$service_menu_translations['rental_car_required']}} @else Rental Car @endif</th>
                    <th width="10%">@if ($service_menu_translations['on']) {{$service_menu_translations['on']}} @else On @endif</th>
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
 
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     