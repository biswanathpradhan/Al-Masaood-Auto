<?php 
$language_id = Session::get('language_id');
$model_translations = getbackendTranslations('new_cars',null,$language_id);
$breadcrumb_translations = getbackendTranslations('breadcrumb ',null,$language_id);
$tradein_translations = getbackendTranslations('tradein ',null,$language_id);
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
              <li class="breadcrumb-item"><a href="{{route('getnewcars')}}">@if ($model_translations['breadcrumb_new_cars']) {{$model_translations['breadcrumb_new_cars']}} @else Models @endif</a></li>
              <li class="breadcrumb-item active">@if ($model_translations['edit_model']) {{$model_translations['edit_model']}} @else Edit Model @endif </li>
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
                <h3 class="card-title">@if ($model_translations['edit_model']) {{$model_translations['edit_model']}} @else Edit Model @endif</h3>
              </div>
              <form role="form" method="post" action="{{route('UpdateCar')}}" enctype="multipart/form-data">
                @csrf
                  <input type="hidden" class="form-control" id="model_id" name="model_id" @if($get_model->id) value="{{ url_encode($get_model->id) }}"@endif>
                  @if(str_contains(url()->previous(), 'getmodels/preowned'))
                   <input type="hidden" class="form-control" id="call_backurl" name="call_backurl" value="getpreownedcars">
                   <input type="hidden" class="form-control" id="carownedtype" name="carownedtype" value="1">
                  @else
                    <input type="hidden" class="form-control" id="call_backurl" name="call_backurl" value="getnewcars">
                    <input type="hidden" class="form-control" id="carownedtype" name="carownedtype" value="0">
                  @endif
                  <!-- </div> -->
                <div class="card-body">
                  <div class="form-group">
                        <label>@if ($model_translations['brand']) {{$model_translations['brand']}} @else Brand @endif </label>
                        <select class="form-control" name="main_brand_id" id="main_brand_id" required="required">
                          <option selected="selected" value="">@if ($model_translations['select_brand']) {{$model_translations['select_brand']}} @else Select Brand @endif</option>
                          @foreach ($compact_val as $item)
              <option value="{{ $item->id }}" @if($get_model->main_brand_id == $item->id) selected  @endif> {{ strtoupper($item->main_brand_name) }} </option>
              @endforeach
                        </select>
                      </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">@if ($model_translations['model_name']) {{$model_translations['model_name']}} @else Model Name @endif</label>
                    <input type="text" class="form-control" id="model_name" name="model_name" placeholder="@if ($model_translations['enter_model_name']) {{$model_translations['enter_model_name']}} @else Enter Model Name @endif" required="required" 
                    @if($get_model->model_name) value="{{ $get_model->model_name }}"@endif>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">اسم النموذج</label>
                    <input type="text" class="form-control" id="model_name_ar" name="model_name_ar" placeholder="@if ($model_translations['enter_model_name']) {{$model_translations['enter_model_name']}} @else Enter Model Name @endif" required="required"
                    @if($get_model->model_name_ar) value="{{ $get_model->model_name_ar }}"@endif>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">@if ($model_translations['display_order']) {{$model_translations['display_order']}} @else Display Order @endif  </label>
                    <input type="number" class="form-control" id="sort_order_app" name="sort_order_app" placeholder="@if ($model_translations['enter_sort_order']) {{$model_translations['enter_sort_order']}} @else Enter sort order @endif " required="required" 
                    @if($get_model->sort_order_app) value="{{ $get_model->sort_order_app }}"@endif>
                  </div>
                    @if($get_model->model_base_image_url)
                    @php $image_url = asset('storage/images/model/'.$get_model->model_base_image_url); @endphp
                      <a href="#" class="pop">

                      <img src="{{ asset('images/model/'.$get_model->model_base_image_url) }}" id="{{$get_model->id}}" data="{{$get_model->model_base_image_url}}" style="height:120px; width:200px"/> 
                      </a>
                   @else
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
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="model_base_image_url" id="model_base_image_url" required="required">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                     
                    </div>
                  </div> -->
                  @endif

                </div>

               
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">@if ($model_translations['btn_update']) {{$model_translations['btn_update']}} @else Update @endif</button>
                  <button type="button" onclick="window.location='{{ route('getnewcars') }}'" class="btn btn-primary">@if ($model_translations['btn_cancel']) {{$model_translations['btn_cancel']}} @else Cancel @endif </button>
                </div>
              </form>
            </div>
          
           
          </div>
         
        </div>
      </div>
    </section>
 
 <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">              
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <img src="" class="imagepreview" style="width: 100%;" >
      </div>
       <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="delete" onclick="return deleteItemmodelimage(this)">Delete</button>
        </div>
    </div>
  </div>
</div>
