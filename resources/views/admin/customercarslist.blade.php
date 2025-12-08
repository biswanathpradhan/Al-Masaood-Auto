<?php 
$language_id = Session::get('language_id');
$customers_translations = getbackendTranslations('all_customers',null,$language_id);
$breadcrumb_translations = getbackendTranslations('breadcrumb ',null,$language_id);
 ?>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@if ($customers_translations['heading_all_customers']) {{$customers_translations['heading_all_customers']}} @else All Customers @endif</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
              <li class="breadcrumb-item active">@if ($customers_translations['customer_cars']) {{$customers_translations['customer_cars']}} @else Customer Cars @endif</li>
            </ol>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-md-4">
            <div class="form-group">
              <label>Minimal</label>
              <select class="form-control select2" name="model_id_filter" id="model_id_filter">
                <option selected="selected" value="4">All</option>
                <option value="1">NISSAN</option>
                <option value="2">RENAULT</option>
                <option value="3">INFINITI</option>
              </select>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Device Type</label>
              <select class="form-control select2" name="device_type_filter" id="device_type_filter">
                <option selected="selected" value="">All</option>
                <option value="1">IOS</option>
                <option value="2">ANDROID</option>
              </select>
            </div>
          </div>
     <!--      <div class="col-md-8" align="right"><br>
            <a class="btn bg-info"> <i class="fas fa-file-excel"></i> Generate Excel </a> </div> -->
        </div>
      </div>
    </div>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary card-outline">
            <div class="card-body">
              <table id="example20" class="table table-bordered table-striped common-datatable">
                <thead>
                  <tr>
                       <th>@if ($customers_translations['Id']) {{$customers_translations['Id']}} @else ID @endif</th>
                  <th>@if ($customers_translations['user_name']) {{$customers_translations['user_name']}} @else User Name @endif</th> 
                  <th>@if ($customers_translations['mobile_number']) {{$customers_translations['mobile_number']}} @else Mobile Number @endif</th>
                    <th>@if ($customers_translations['email']) {{$customers_translations['email']}} @else Email @endif</th>
                       <th>@if ($customers_translations['brand']) {{$customers_translations['brand']}} @else Brand @endif</th>
                    <th>@if ($customers_translations['model']) {{$customers_translations['model']}} @else Model @endif</th>
                      <th>@if ($customers_translations['car_reg_no']) {{$customers_translations['car_reg_no']}} @else Car Reg. Number @endif</th>
                     <th>@if ($customers_translations['chassis_no']) {{$customers_translations['chassis_no']}} @else Chassis No./ VIN No. @endif</th>
                    <th  width="10%">@if ($customers_translations['on']) {{$customers_translations['on']}} @else On @endif</th>
                    <th  width="10%">@if ($customers_translations['iosandroid']) {{$customers_translations['iosandroid']}} @else IOS/Android @endif</th>
                    <th width="10%">@if ($customers_translations['status']) {{$customers_translations['status']}} @else Status @endif</th>
                    <th width="3%">@if ($customers_translations['edit']) {{$customers_translations['edit']}} @else Edit @endif</th>
                    <th width="3%">@if ($customers_translations['chat']) {{$customers_translations['chat']}} @else Chat @endif</th>
                    <th width="8%">@if ($customers_translations['notifications']) {{$customers_translations['notifications']}} @else Notification @endif</th>
                    <th width="8%">@if ($customers_translations['lastactive']) {{$customers_translations['lastactive']}} @else Last Active @endif </th>
                   <!--  <th>ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Car Reg.</th>
                    <th>Chassis No/ VIN No</th>
                    <th width="10%">On</th>
                    <th width="10%">IOS/Android</th>
                    <th width="10%">Status</th>
                    <th width="3%">Edit</th>
                    <th width="3%">Chat</th>
                    <th width="8%">Notification</th>
                    <th width="8%">Model</th> -->
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
 
