<<<<<<< HEAD
<?php 
$language_id = Session::get('language_id');
$equipments_translations = getbackendTranslations('new_cars',null,$language_id);
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
              <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
              <li class="breadcrumb-item"><a href="#">@if ($equipments_translations['breadcrumb_new_cars']) {{$equipments_translations['breadcrumb_new_cars']}} @else Models @endif</a></li>
              <li class="breadcrumb-item active"> @if ($equipments_translations['add_equipment']) {{$equipments_translations['add_equipment']}} @else Add Equipment @endif </li>
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
                <h3 class="card-title"> @if ($equipments_translations['add_equipment']) {{$equipments_translations['add_equipment']}} @else Add Equipment @endif</h3>
              </div>
              <form role="form" method="post" action="{{route('saveequipment')}}" enctype="multipart/form-data">
                @csrf
                 
                <div class="card-body">
                           <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">@if ($equipments_translations['car_type']) {{$equipments_translations['car_type']}} @else Car Type @endif</label>
                    <select class="form-control" name="car_owned_type" id="car_owned_type" required="required">
                                <option selected="selected" value="">@if ($equipments_translations['select_type']) {{$equipments_translations['select_type']}} @else Select Type @endif</option>
                                
                    <option value="0"> New Car </option>
                    <option value="1"> PreOwned Car </option>
                     
                              </select>
                  </div>
                </div>
              </div>
                  <div class="form-group">
                        <label>@if ($equipments_translations['brand']) {{$equipments_translations['brand']}} @else Brand @endif</label>
                        <select class="form-control" name="main_brand_id" id="main_brand_id" required="required">
                          <option selected="selected" value="">@if ($equipments_translations['select_brand']) {{$equipments_translations['select_brand']}} @else Select Brand @endif</option>
                          @foreach ($compact_val as $item)
              <option value="{{ $item->id }}"> {{ strtoupper($item->main_brand_name) }} </option>
              @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label>@if ($equipments_translations['model']) {{$equipments_translations['model']}} @else Model @endif</label>
                        <select class="form-control" name="main_model_id" id="main_model_id" required="required">
                          <option selected="selected" value="">@if ($equipments_translations['select_model']) {{$equipments_translations['select_model']}} @else Select Model @endif </option>
                          @foreach ($compact_model_val as $item)
              <option value="{{ $item->id }}"> {{ strtoupper($item->model_name) }} </option>
              @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label>@if ($equipments_translations['version']) {{$equipments_translations['version']}} @else Version @endif</label>
                        <select class="form-control" name="main_version_id" id="main_version_id" required="required">
                          <option selected="selected" value="">@if ($equipments_translations['select_version']) {{$equipments_translations['select_version']}} @else Select Version @endif</option>
                          @foreach ($compact_version_val as $item)
              <option value="{{ $item->id }}"> {{ strtoupper($item->version_name) }} </option>
              @endforeach
                        </select>
                      </div>

                     
                  <div class="form-group">
                    <label for="exampleInputEmail1">@if ($equipments_translations['equipments']) {{$equipments_translations['equipments']}} @else Equipment @endif</label>
                    <input type="text" class="form-control" id="equipments" name="equipments" placeholder="@if ($equipments_translations['enter_equipment']) {{$equipments_translations['enter_equipment']}} @else Enter Equipment @endif " required="required">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1">  معدات   </label>
                    <input type="text" class="form-control" id="equipments_ar" name="equipments_ar" placeholder="@if ($equipments_translations['enter_equipment']) {{$equipments_translations['enter_equipment']}} @else Enter Equipment @endif" required="required">
                  </div> 
 
                 
                </div>
                <div class="card-footer">
                 <button type="submit" class="btn btn-primary">@if ($equipments_translations['btn_submit']) {{$equipments_translations['btn_submit']}} @else Submit @endif </button>
                  <button type="button" onclick="window.history.back()"  class="btn btn-primary">@if ($equipments_translations['btn_cancel']) {{$equipments_translations['btn_cancel']}} @else Cancel @endif </button>
                </div>
              </form>
            </div>
          
           
          </div>
         
        </div>
      </div>
    </section>
=======
<?php 
$language_id = Session::get('language_id');
$equipments_translations = getbackendTranslations('new_cars',null,$language_id);
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
              <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
              <li class="breadcrumb-item"><a href="#">@if ($equipments_translations['breadcrumb_new_cars']) {{$equipments_translations['breadcrumb_new_cars']}} @else Models @endif</a></li>
              <li class="breadcrumb-item active"> @if ($equipments_translations['add_equipment']) {{$equipments_translations['add_equipment']}} @else Add Equipment @endif </li>
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
                <h3 class="card-title"> @if ($equipments_translations['add_equipment']) {{$equipments_translations['add_equipment']}} @else Add Equipment @endif</h3>
              </div>
              <form role="form" method="post" action="{{route('saveequipment')}}" enctype="multipart/form-data">
                @csrf
                 
                <div class="card-body">
                           <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">@if ($equipments_translations['car_type']) {{$equipments_translations['car_type']}} @else Car Type @endif</label>
                    <select class="form-control" name="car_owned_type" id="car_owned_type" required="required">
                                <option selected="selected" value="">@if ($equipments_translations['select_type']) {{$equipments_translations['select_type']}} @else Select Type @endif</option>
                                
                    <option value="0"> New Car </option>
                    <option value="1"> PreOwned Car </option>
                     
                              </select>
                  </div>
                </div>
              </div>
                  <div class="form-group">
                        <label>@if ($equipments_translations['brand']) {{$equipments_translations['brand']}} @else Brand @endif</label>
                        <select class="form-control" name="main_brand_id" id="main_brand_id" required="required">
                          <option selected="selected" value="">@if ($equipments_translations['select_brand']) {{$equipments_translations['select_brand']}} @else Select Brand @endif</option>
                          @foreach ($compact_val as $item)
              <option value="{{ $item->id }}"> {{ strtoupper($item->main_brand_name) }} </option>
              @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label>@if ($equipments_translations['model']) {{$equipments_translations['model']}} @else Model @endif</label>
                        <select class="form-control" name="main_model_id" id="main_model_id" required="required">
                          <option selected="selected" value="">@if ($equipments_translations['select_model']) {{$equipments_translations['select_model']}} @else Select Model @endif </option>
                          @foreach ($compact_model_val as $item)
              <option value="{{ $item->id }}"> {{ strtoupper($item->model_name) }} </option>
              @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label>@if ($equipments_translations['version']) {{$equipments_translations['version']}} @else Version @endif</label>
                        <select class="form-control" name="main_version_id" id="main_version_id" required="required">
                          <option selected="selected" value="">@if ($equipments_translations['select_version']) {{$equipments_translations['select_version']}} @else Select Version @endif</option>
                          @foreach ($compact_version_val as $item)
              <option value="{{ $item->id }}"> {{ strtoupper($item->version_name) }} </option>
              @endforeach
                        </select>
                      </div>

                     
                  <div class="form-group">
                    <label for="exampleInputEmail1">@if ($equipments_translations['equipments']) {{$equipments_translations['equipments']}} @else Equipment @endif</label>
                    <input type="text" class="form-control" id="equipments" name="equipments" placeholder="@if ($equipments_translations['enter_equipment']) {{$equipments_translations['enter_equipment']}} @else Enter Equipment @endif " required="required">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1">  معدات   </label>
                    <input type="text" class="form-control" id="equipments_ar" name="equipments_ar" placeholder="@if ($equipments_translations['enter_equipment']) {{$equipments_translations['enter_equipment']}} @else Enter Equipment @endif" required="required">
                  </div> 
 
                 
                </div>
                <div class="card-footer">
                 <button type="submit" class="btn btn-primary">@if ($equipments_translations['btn_submit']) {{$equipments_translations['btn_submit']}} @else Submit @endif </button>
                  <button type="button" onclick="window.history.back()"  class="btn btn-primary">@if ($equipments_translations['btn_cancel']) {{$equipments_translations['btn_cancel']}} @else Cancel @endif </button>
                </div>
              </form>
            </div>
          
           
          </div>
         
        </div>
      </div>
    </section>
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
 