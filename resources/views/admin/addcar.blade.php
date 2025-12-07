<<<<<<< HEAD
<?php 
$language_id = Session::get('language_id');
$model_translations = getbackendTranslations('new_cars',null,$language_id);
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
              <li class="breadcrumb-item"><a href="{{route('getnewcars')}}">@if ($model_translations['breadcrumb_new_cars']) {{$model_translations['breadcrumb_new_cars']}} @else Models @endif</a></li>
              <li class="breadcrumb-item active">@if ($model_translations['add_models']) {{$model_translations['add_models']}} @else Add Model @endif </li>
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
                <h3 class="card-title">@if ($model_translations['add_models']) {{$model_translations['add_models']}} @else Add Model @endif</h3>
              </div>
              <form role="form" method="post" action="{{route('savecar')}}" enctype="multipart/form-data">
                @csrf
                 @if(str_contains(url()->previous(), 'getmodels/preowned'))
                   <input type="hidden" class="form-control" id="call_backurl" name="call_backurl" value="getpreownedcars">
                   <input type="hidden" class="form-control" id="carownedtype" name="carownedtype" value="1">
                  @else
                    <input type="hidden" class="form-control" id="call_backurl" name="call_backurl" value="getnewcars">
                    <input type="hidden" class="form-control" id="carownedtype" name="carownedtype" value="0">
                  @endif
                <div class="card-body">
                  <div class="form-group">
                        <label>@if ($model_translations['brand']) {{$model_translations['brand']}} @else Brand @endif </label>
                        <select class="form-control" name="main_brand_id" id="main_brand_id" required="required">
                          <option selected="selected" value="">@if ($model_translations['select_brand']) {{$model_translations['select_brand']}} @else Select Brand @endif </option>
                          @foreach ($compact_val as $item)
              <option value="{{ $item->id }}"> {{ strtoupper($item->main_brand_name) }} </option>
              @endforeach
                        </select>
                      </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">@if ($model_translations['model_name']) {{$model_translations['model_name']}} @else Model Name @endif </label>
                    <input type="text" class="form-control" id="model_name" name="model_name" placeholder="@if ($model_translations['enter_model_name']) {{$model_translations['enter_model_name']}} @else Enter Model Name @endif " required="required">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">اسم النموذج</label>
                    <input type="text" class="form-control" id="model_name_ar" name="model_name_ar" placeholder="@if ($model_translations['enter_model_name']) {{$model_translations['enter_model_name']}} @else Enter Model Name @endif" required="required">
                  </div>
                  

                   <div class="form-group">
             <div class="col" style="    padding-top: 15px;padding-bottom: 15px;">
                           <div class="input-group control-group increment" >
                             <!-- <div class="col"> -->
                      <input type="file" name="model_base_image_url" id="model_base_image_url" class="form-control" required="required" onchange="readURLone(this);">
                    <!-- </div> -->
                     
 
                 </div>
          </div>

            <div class="form-group">
                  <img src="{{config('app.url').'/images/default-cars.jpeg'}}" style="width:300px;height:200px;" class="form-control" id="display_image">
                </div>

                  <!-- <div class="form-group">
                    <label for="exampleInputFile">Choose image</label>
                    <div class="input-group control-group ">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="model_base_image_url" id="model_base_image_url" required="required" >
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                     
                    </div>
                  </div> -->
                 
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">@if ($model_translations['btn_submit']) {{$model_translations['btn_submit']}} @else Submit @endif</button>
                  <button type="button" onclick="window.location='{{ route('getnewcars') }}'" class="btn btn-primary">@if ($model_translations['btn_cancel']) {{$model_translations['btn_cancel']}} @else Cancel @endif</button>
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
$model_translations = getbackendTranslations('new_cars',null,$language_id);
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
              <li class="breadcrumb-item"><a href="{{route('getnewcars')}}">@if ($model_translations['breadcrumb_new_cars']) {{$model_translations['breadcrumb_new_cars']}} @else Models @endif</a></li>
              <li class="breadcrumb-item active">@if ($model_translations['add_models']) {{$model_translations['add_models']}} @else Add Model @endif </li>
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
                <h3 class="card-title">@if ($model_translations['add_models']) {{$model_translations['add_models']}} @else Add Model @endif</h3>
              </div>
              <form role="form" method="post" action="{{route('savecar')}}" enctype="multipart/form-data">
                @csrf
                 @if(str_contains(url()->previous(), 'getmodels/preowned'))
                   <input type="hidden" class="form-control" id="call_backurl" name="call_backurl" value="getpreownedcars">
                   <input type="hidden" class="form-control" id="carownedtype" name="carownedtype" value="1">
                  @else
                    <input type="hidden" class="form-control" id="call_backurl" name="call_backurl" value="getnewcars">
                    <input type="hidden" class="form-control" id="carownedtype" name="carownedtype" value="0">
                  @endif
                <div class="card-body">
                  <div class="form-group">
                        <label>@if ($model_translations['brand']) {{$model_translations['brand']}} @else Brand @endif </label>
                        <select class="form-control" name="main_brand_id" id="main_brand_id" required="required">
                          <option selected="selected" value="">@if ($model_translations['select_brand']) {{$model_translations['select_brand']}} @else Select Brand @endif </option>
                          @foreach ($compact_val as $item)
              <option value="{{ $item->id }}"> {{ strtoupper($item->main_brand_name) }} </option>
              @endforeach
                        </select>
                      </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">@if ($model_translations['model_name']) {{$model_translations['model_name']}} @else Model Name @endif </label>
                    <input type="text" class="form-control" id="model_name" name="model_name" placeholder="@if ($model_translations['enter_model_name']) {{$model_translations['enter_model_name']}} @else Enter Model Name @endif " required="required">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">اسم النموذج</label>
                    <input type="text" class="form-control" id="model_name_ar" name="model_name_ar" placeholder="@if ($model_translations['enter_model_name']) {{$model_translations['enter_model_name']}} @else Enter Model Name @endif" required="required">
                  </div>
                  

                   <div class="form-group">
             <div class="col" style="    padding-top: 15px;padding-bottom: 15px;">
                           <div class="input-group control-group increment" >
                             <!-- <div class="col"> -->
                      <input type="file" name="model_base_image_url" id="model_base_image_url" class="form-control" required="required" onchange="readURLone(this);">
                    <!-- </div> -->
                     
 
                 </div>
          </div>

            <div class="form-group">
                  <img src="{{config('app.url').'/images/default-cars.jpeg'}}" style="width:300px;height:200px;" class="form-control" id="display_image">
                </div>

                  <!-- <div class="form-group">
                    <label for="exampleInputFile">Choose image</label>
                    <div class="input-group control-group ">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="model_base_image_url" id="model_base_image_url" required="required" >
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                     
                    </div>
                  </div> -->
                 
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">@if ($model_translations['btn_submit']) {{$model_translations['btn_submit']}} @else Submit @endif</button>
                  <button type="button" onclick="window.location='{{ route('getnewcars') }}'" class="btn btn-primary">@if ($model_translations['btn_cancel']) {{$model_translations['btn_cancel']}} @else Cancel @endif</button>
                </div>
              </form>
            </div>
          
           
          </div>
         
        </div>
      </div>
    </section>
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
 