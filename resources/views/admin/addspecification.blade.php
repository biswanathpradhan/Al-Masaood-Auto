<?php 
$language_id = Session::get('language_id');
$specifications_translations = getbackendTranslations('specifications',null,$language_id);
$breadcrumb_translations = getbackendTranslations('breadcrumb ',null,$language_id);
$tradein_translations = getbackendTranslations('tradein',null,$language_id);

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
              <li class="breadcrumb-item"><a href="#">@if ($specifications_translations['specifications']) {{$specifications_translations['specifications']}} @else Specification @endif</a></li>
              <li class="breadcrumb-item active">@if ($specifications_translations['add_specification']) {{$specifications_translations['add_specification']}} @else Add Specification @endif </li>
            </ol>
          </div>
        </div>
<!-- <div class="col-sm-6">
            <h4 class="m-0 text-dark">Model Name : @if(isset($model_name)) {{$model_name}} @endif</h4>
          </div>
          <div class="col-sm-6">
            <h6 class="m-0 text-dark">Version Name : @if(isset($version_name)) {{$version_name}} @endif</h6>
          </div> -->
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">@if ($specifications_translations['add_specification']) {{$specifications_translations['add_specification']}} @else Add Specification @endif</h3>
              </div>
              <form role="form" method="post" action="{{route('savespecification')}}" enctype="multipart/form-data">
                @csrf
 
                <div class="card-body">

                    <div class="form-group">
                    <label for="">@if ($specifications_translations['car_type']) {{$specifications_translations['car_type']}} @else Car Type @endif </label>
                    <select class="form-control" name="car_owned_type" id="car_owned_type" required="required">
                                <option selected="selected" value="">@if ($specifications_translations['select_type']) {{$specifications_translations['select_type']}} @else Select Type @endif </option>
                                
                    <option value="0" @if($car_owned_type == 0)  selected="selected" @endif> New Car </option>
                    <option value="1" @if($car_owned_type == 1)  selected="selected" @endif> PreOwned Car </option>
                     
                              </select>
                  </div>

                  <div class="form-group">
                        <label>@if ($specifications_translations['brand']) {{$specifications_translations['brand']}} @else Brand @endif </label>
                        <select class="form-control" name="main_brand_id" id="main_brand_id" required="required">
                          <option selected="selected" value="">@if ($specifications_translations['select_brand']) {{$specifications_translations['select_brand']}} @else Select Brand @endif </option>
                          @foreach ($compact_val as $item)
              <option value="{{ $item->id }}"> {{ strtoupper($item->main_brand_name) }} </option>
              @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label>@if ($specifications_translations['model']) {{$specifications_translations['model']}} @else Model @endif </label>
                        <select class="form-control" name="main_model_id" id="main_model_id" required="required">
                          <option selected="selected" value="">@if ($specifications_translations['select_model']) {{$specifications_translations['select_model']}} @else Select Model @endif </option>
                          @foreach ($compact_model_val as $item)
              <option value="{{ $item->id }}"> {{ strtoupper($item->model_name) }} </option>
              @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label>@if ($specifications_translations['version']) {{$specifications_translations['version']}} @else Version @endif </label>
                        <select class="form-control" name="main_version_id" id="main_version_id" required="required">
                          <option selected="selected" value="">@if ($specifications_translations['select_version']) {{$specifications_translations['select_version']}} @else Select Version @endif </option>
                          @foreach ($compact_version_val as $item)
              <option value="{{ $item->id }}"> {{ strtoupper($item->version_name) }} </option>
              @endforeach
                        </select>
                      </div>

                       <div class="form-group">
                        <label>@if ($specifications_translations['specifications_in']) {{$specifications_translations['specifications_in']}} @else Specification In @endif </label>
                        <select class="form-control" name="category_id" id="category_id" required="required">
                          <option selected="selected" value="">@if ($specifications_translations['select_category']) {{$specifications_translations['select_category']}} @else Select Category @endif </option>
                          @foreach ($compact_specs_category_val as $item)
              <option value="{{ $item->id }}"> {{ strtoupper($item->category_name) }} </option>
              @endforeach
                        </select>
                      </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">@if ($specifications_translations['specifications']) {{$specifications_translations['specifications']}} @else Specification @endif</label>
                    <textarea  rows="4" cols="50" class="form-control" id="specification" name="specification" placeholder="@if ($specifications_translations['enter_specifications']) {{$specifications_translations['enter_specifications']}} @else Enter Specification @endif " required="required">

                 </textarea>

                  </div>

           
                   <div class="form-group">
                    <label for="exampleInputEmail1">مواصفة</label>
                    <textarea   rows="4" cols="50" class="form-control" id="specification_ar" name="specification_ar" placeholder="@if ($specifications_translations['enter_specifications']) {{$specifications_translations['enter_specifications']}} @else Enter Specification @endif" required="required">
                      </textarea>

                  </div> 
 
                 
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">@if ($specifications_translations['btn_submit']) {{$specifications_translations['btn_submit']}} @else Submit @endif </button>
                  <button type="button" onclick="window.history.back()"  class="btn btn-primary">@if ($specifications_translations['btn_cancel']) {{$specifications_translations['btn_cancel']}} @else Cancel @endif </button>
                </div>
              </form>
            </div>
          
           
          </div>
         
        </div>
      </div>
    </section>
 