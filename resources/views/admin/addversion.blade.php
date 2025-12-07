<?php 
$language_id = Session::get('language_id');
$version_translations = getbackendTranslations('new_cars',null,$language_id);
$breadcrumb_translations = getbackendTranslations('breadcrumb ',null,$language_id);
$tradein_translations = getbackendTranslations('tradein',null,$language_id);
// $model_id_redirect = url_encode($compact_model_val->id);
  // dd(route('getversion'));
 ?> 
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 class="m-0 text-dark">Add Model</h1> -->
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i>  @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
              <li class="breadcrumb-item"><a href="#">@if ($version_translations['breadcrumb_new_cars']) {{$version_translations['breadcrumb_new_cars']}} @else Models @endif</a></li>
              <li class="breadcrumb-item active">@if ($version_translations['add_version']) {{$version_translations['add_version']}} @else Add Version @endif </li>
            </ol>
          </div>
        </div>

      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">@if ($version_translations['add_version']) {{$version_translations['add_version']}} @else Add Version @endif</h3>
              </div>
              <form role="form" method="post" action="{{route('saveversion')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                   <div class="form-row">
                       <div class="col">
                        <label>@if ($version_translations['model']) {{$version_translations['model']}} @else Model @endif </label>
                        <select class="form-control" name="main_model_id" id="main_model_id" required="required">
                          <option selected="selected" value="">@if ($version_translations['select_model']) {{$version_translations['select_model']}} @else Select Model @endif </option>
                          
              <option value="{{ $compact_model_val->id }}" selected="selected" > {{ strtoupper($compact_model_val->model_name) }} </option>
        
                        </select>
                      </div>
                       <div class="col">
              <label for="exampleInputEmail1">@if ($version_translations['search_stock_online']) {{$version_translations['search_stock_online']}} @else Search Stock Online @endif </label>
              <input type="text" class="form-control" id="search_stock_url" name="search_stock_url" placeholder="@if ($version_translations['enter_stock_url']) {{$version_translations['enter_stock_url']}} @else  Enter Stock URL @endif" required="required">
            </div>
                      </div>

                  <!-- <div class="form-group"> -->
          <div class="form-row">
            <div class="col">
              <label for="exampleInputEmail1">@if ($version_translations['version_name']) {{$version_translations['version_name']}} @else Version Name @endif</label>
              <input type="text" class="form-control" id="version_name" name="version_name" placeholder="@if ($version_translations['enter_version_name']) {{$version_translations['enter_version_name']}} @else Enter Version Name @endif" required="required">
            </div>
            <div class="col">
              <label for="exampleInputEmail1"> اسم الإصدار </label>
              <input type="text" class="form-control" id="version_name_ar" name="version_name_ar" placeholder="@if ($version_translations['enter_version_name']) {{$version_translations['enter_version_name']}} @else Enter Version Name @endif" required="required">
            </div>
          </div>
                  
           <div class="form-row">
            <div class="col">
             <label for="exampleInputEmail1">@if ($version_translations['starting_price']) {{$version_translations['starting_price']}} @else Starting Price @endif </label>
                    <input type="text" class="form-control" id="starting_price" name="starting_price" placeholder=" @if ($version_translations['enter_starting_price']) {{$version_translations['enter_starting_price']}} @else  Enter Starting Price @endif" required="required">
            </div>
            <div class="col">
             <label for="exampleInputEmail1">@if ($version_translations['finance_amount_per_month']) {{$version_translations['finance_amount_per_month']}} @else Finance Amount Per/Month @endif</label>
                    <input type="text" class="form-control" id="finance_amount" name="finance_amount" placeholder="@if ($version_translations['enter_finance_amount_per_month']) {{$version_translations['enter_finance_amount_per_month']}} @else Enter Finance Amount @endif " required="required"> <label for="exampleInputEmail1"> @if ($version_translations['display']) {{$version_translations['display']}} @else Display @endif </label> : <input type="checkbox" name="showfinanceamount" id="showfinanceamount"    />
            </div>
          </div>
           <div class="form-row">
            <div class="col">
             <label for="exampleInputEmail1">@if ($version_translations['insurance_amount_per_year']) {{$version_translations['insurance_amount_per_year']}} @else Insurance Amount Per/Year @endif </label>
                    <input type="text" class="form-control" id="insurance_amount" name="insurance_amount" placeholder="@if ($version_translations['enter_insurance_amount']) {{$version_translations['enter_insurance_amount']}} @else Enter Insurance Amount @endif " required="required">
            </div>
            <div class="col">
            <label for="exampleInputEmail1">@if ($version_translations['youtube_url']) {{$version_translations['youtube_url']}} @else Youtube Url @endif </label>
                    <input type="text" class="form-control" id="youtube_url" name="youtube_url" placeholder="@if ($version_translations['enter_youtube_url']) {{$version_translations['enter_youtube_url']}} @else Enter Youtube Url @endif " required="required">
            </div>
          </div>

            <div class="form-row">
           
                      <div class="col">
              <label for="exampleInputEmail1">@if ($version_translations['search_stock_online_ar']) {{$version_translations['search_stock_online_ar']}} @else  البحث في الأوراق المالية على الإنترنت   @endif </label>
              <input type="text" class="form-control" id="search_stock_url_ar" name="search_stock_url_ar" placeholder="@if ($version_translations['enter_stock_url']) {{$version_translations['enter_stock_url']}} @else  Enter Stock URL @endif" required="required">
            </div>
          </div>

            
          <div class="form-row">
             <div class="col" style="    padding-top: 15px;">
                           <div class="input-group control-group increment" >
                             <div class="col">
                      <input type="file" name="filename[]" class="form-control">
                    </div>
                     <div class="col col-sm-3" >
                      <input type="color" name="color[]" class="form-control">
                      
                    </div>

                     <div class="col col-sm-3" >
                      
                      <div class="input-group-btn"> 
                        <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>@if ($version_translations['add']) {{$version_translations['add']}} @else  Add @endif</button>
                      </div>
                    </div>
                
                 </div>
          </div>

          </div>

           <div class="form-row">
             <div class="col" style=" padding-top: 15px;">

                  <div class="clone hide" style="display: none">
                  <div class="control-group input-group" style="margin-top:5px">
                       <div class="col">
                    <input type="file" name="filename[]" class="form-control">
                  </div>
                  <div class="col col-sm-3" >
                      <input type="color" name="color[]" class="form-control">
                      
                    </div>
                     <div class="col col-sm-3" >
                    <div class="input-group-btn"> 
                      <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> @if ($version_translations['remove']) {{$version_translations['remove']}} @else  Remove @endif </button>
                    </div>
                  </div>
                  </div>
                </div>
                  
          </div>

          </div>

          <div style="padding-top: 15px;"></div>
                
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">@if ($version_translations['btn_submit']) {{$version_translations['btn_submit']}} @else  Submit @endif</button>
                  <button type="button" onclick="window.history.back()" class="btn btn-primary">@if ($version_translations['btn_cancel']) {{$version_translations['btn_cancel']}} @else  Cancel @endif </button>
                </div>
              </form>
            </div>
          
           
          </div>
         
        </div>
      </div>
    </section>
 