<?php 
$language_id = Session::get('language_id');
$accessory_request_translations = getbackendTranslations('accessory_request',null,$language_id);
$breadcrumb_translations = getbackendTranslations('breadcrumb ',null,$language_id);
 ?>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> @if ($accessory_request_translations['heading_call_back_request']) {{$accessory_request_translations['heading_call_back_request']}} @else  Accessory Request @endif </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i>  @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
              <li class="breadcrumb-item active">@if ($breadcrumb_translations['breadcrumb_accessory_request']) {{$breadcrumb_translations['breadcrumb_accessory_request']}} @else Accessory Request @endif</li>
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
              <table id="example18" class="table table-bordered table-striped common-datatable">
                <thead>
                  <tr>

                     <th>@if ($accessory_request_translations['Id']) {{$accessory_request_translations['Id']}} @else ID @endif</th>
                    <th>@if ($accessory_request_translations['user_name']) {{$accessory_request_translations['user_name']}} @else User Name @endif</th>
                    <th>@if ($accessory_request_translations['mobile_number']) {{$accessory_request_translations['mobile_number']}} @else Mobile Number @endif</th>
                    <th>@if ($accessory_request_translations['email']) {{$accessory_request_translations['email']}} @else Email Id @endif</th>
                    <th>@if ($accessory_request_translations['car_reg_no']) {{$accessory_request_translations['car_reg_no']}} @else Car Reg. Number @endif</th>
                    <th>@if ($accessory_request_translations['brand']) {{$accessory_request_translations['brand']}} @else Brand @endif</th>
                    <th>@if ($accessory_request_translations['model']) {{$accessory_request_translations['model']}} @else Model @endif</th>
                    <th>@if ($accessory_request_translations['chassis_no']) {{$accessory_request_translations['chassis_no']}} @else Chassis No./ VIN No. @endif</th>
                    <th>@if ($accessory_request_translations['on']) {{$accessory_request_translations['on']}} @else On @endif</th>
                    <th width="10%">@if ($accessory_request_translations['accessory_request']) {{$accessory_request_translations['accessory_request']}} @else Accessory Request @endif</th>
                    <th width="10%">@if ($accessory_request_translations['comment']) {{$accessory_request_translations['comment']}} @else Comment @endif</th>
                    <th width="10%">@if ($accessory_request_translations['status']) {{$accessory_request_translations['status']}} @else Status @endif</th>
                    <th width="3%">@if ($accessory_request_translations['edit']) {{$accessory_request_translations['edit']}} @else Edit @endif</th>
                    <th width="3%">@if ($accessory_request_translations['chat']) {{$accessory_request_translations['chat']}} @else Chat @endif</th>
                    <th width="8%">@if ($accessory_request_translations['notifications']) {{$accessory_request_translations['notifications']}} @else Notification @endif</th>

                   <!--  <th>ID</th>
                    <th>User Name</th>
                    <th>Mobile Number</th>
                    <th>Email Id</th>
                    <th>Car Reg. Number</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Chassis No./ VIN No.</th>
                    <th>On</th>
                    <th width="10%">Accessory Request</th>
                    <th width="10%">Comment</th>
                    <th width="10%">Status</th>
                    <th width="3%">Edit</th>
                    <th width="3%">Chat</th>
                    <th width="8%">Notification</th> -->
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
        <div class="card-body" id="cardbodyiamgesaccessory">
           <img src="" class="imagepreview" style="width: 100%;" >
           <h2 id="showaccessorytitle"></h2>
           <textarea id="showaccessorydescription" disabled="" cols="60" rows="3"></textarea>
          </div>

        <textarea id="comment" name="comment"  class="comment" style="width: 100%;" required="required">  </textarea>
         <input type="hidden" class="form-control" id="fk_accessory_id" name="fk_accessory_id">
          <input type="hidden" class="form-control" id="fk_user_id" name="fk_user_id">
          <input type="hidden" class="form-control" id="insurance_comments_show" name="insurance_comments_show">
         
       
       <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="addcommentaccessory" data-fk_accessory_id="" data-fk_accessory_request_id="" data-user="" onclick="return UpdateAccessoryComment(this)">Add</button>
        </div>
         <div class="card-body" id="cardbodycommentsaccessory">

          </div>
    </div>
  </div>
</div>
</div>