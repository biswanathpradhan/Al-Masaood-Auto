<?php 
$language_id = Session::get('language_id');
$insurance_request_translations = getbackendTranslations('insurance_request',null,$language_id);
$breadcrumb_translations = getbackendTranslations('breadcrumb ',null,$language_id);
$corporate_translations = getbackendTranslations('service_package_request',null,$language_id);
 ?>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> @if ($corporate_translations['header_service_package_request']) {{$corporate_translations['header_service_package_request']}} @else Service Package Request @endif</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i>  @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
              <li class="breadcrumb-item active">@if ($corporate_translations['breadcrumb_service_package_request']) {{$corporate_translations['breadcrumb_service_package_request']}} @else Service Package Request @endif </li>
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
              <table id="example32" class="table table-bordered table-striped common-datatable">
                <thead>
                  <tr>
          <th>@if ($insurance_request_translations['Id']) {{$insurance_request_translations['Id']}} @else ID @endif</th>
          <th>@if ($insurance_request_translations['user_name']) {{$insurance_request_translations['user_name']}} @else User Name @endif</th> 
          <th>@if ($insurance_request_translations['mobile_number']) {{$insurance_request_translations['mobile_number']}} @else Mobile Number @endif</th>
          <th>@if ($insurance_request_translations['email']) {{$insurance_request_translations['email']}} @else Email Id @endif</th>

          <th>@if ($insurance_request_translations['car_reg_no']) {{$insurance_request_translations['car_reg_no']}} @else Car Reg. Number @endif </th>
          <th>@if ($insurance_request_translations['brand']) {{$insurance_request_translations['brand']}} @else Brand @endif </th>
          <th>@if ($insurance_request_translations['model']) {{$insurance_request_translations['model']}} @else Model @endif </th>


          <th>@if ($insurance_request_translations['chassis_no']) {{$insurance_request_translations['chassis_no']}} @else Chassis No./ VIN No. @endif</th>
          <th width="15%">@if ($corporate_translations['header_service_package_request']) {{$corporate_translations['header_service_package_request']}} @else Service Package Requested @endif</th>
          <th>@if ($insurance_request_translations['on']) {{$insurance_request_translations['on']}} @else On @endif</th>

          <th width="10%">@if ($insurance_request_translations['status']) {{$insurance_request_translations['status']}} @else Status @endif</th>
          <th>@if ($insurance_request_translations['comment']) {{$insurance_request_translations['comment']}} @else Comment @endif </th>
                <!--     <th>ID</th>
                    <th>User Name</th>
                    <th>Mobile Number</th>
                    <th>Email Id</th>
                    <th>Car Reg. Number</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Chassis No./ VIN No.</th>
    
                    <th>On</th>
                    <th width="10%">Status</th>
                    <th>Comment</th> -->
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
 
 
    <div class="modal fade" id="commentmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">              
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <textarea id="comment" name="comment"  class="comment" style="width: 100%;" required="required">  </textarea>
         <input type="hidden" class="form-control" id="fk_insurance_id" name="fk_insurance_id">
          <input type="hidden" class="form-control" id="fk_user_id" name="fk_user_id">
          <input type="hidden" class="form-control" id="insurance_comments_show" name="insurance_comments_show">
         
       
       <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="addcomment" data-insurance="" data-user="" onclick="return UpdateServicePackageComment(this)">Add</button>
        </div>
         <div class="card-body" id="cardbodycomments">

          </div>
    </div>
  </div>
</div>
</div>

 