<?php 
$language_id = Session::get('language_id');
$service_menu_translations = getbackendTranslations('locationshowroom',null,$language_id);
$breadcrumb_translations = getbackendTranslations('breadcrumb ',null,$language_id);
$corporate_translations = getbackendTranslations('corporate_enquiry',null,$language_id);

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
              <li class="breadcrumb-item"><a href="#">@if ($service_menu_translations['breadcrumb_locationshowroom']) {{$service_menu_translations['breadcrumb_locationshowroom']}} @else ALL SHOWROOMS & SERVICE CENTER LOCATIONS @endif</a></li>
              <li class="breadcrumb-item active">@if ($service_menu_translations['edit_location']) {{$service_menu_translations['edit_location']}} @else Edit Location @endif</li>
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
                <h3 class="card-title">@if ($service_menu_translations['edit_location']) {{$service_menu_translations['edit_location']}} @else Edit Location @endif</h3>
              </div>
              <form role="form" method="post" action="{{route('updatelocation')}}" enctype="multipart/form-data">
                @csrf
                 <input type="hidden" class="form-control" id="location_id" name="location_id" @if($location_id) value="{{ $location_id }}"@endif>
                <div class="card-body">
             
                       <div class="form-row">
            <div class="col">
             <label>@if ($service_menu_translations['select_brand']) {{$service_menu_translations['select_brand']}} @else Select Brand @endif</label>
                        <select class="form-control" name="main_brand_id" id="main_brand_id" required="required">
                          <option selected="selected" value="">@if ($service_menu_translations['select_brand']) {{$service_menu_translations['select_brand']}} @else Select Brand @endif</option>
                          
               @foreach ($compact_val as $item)
              <option value="{{ $item->id }}" @if($compact_model_val->main_brand_id == $item->id)  selected="selected" @endif> {{ strtoupper($item->main_brand_name) }} </option>
              @endforeach
        
                        </select>
            </div>
            <div class="col">
               <label>@if ($service_menu_translations['select_category']) {{$service_menu_translations['select_category']}} @else Select Category @endif </label>
                        <select class="form-control" name="category_id" id="category_id" required="required">
                          <option selected="selected" value="">@if ($service_menu_translations['select_category']) {{$service_menu_translations['select_category']}} @else Select Category @endif </option>
                          
               @foreach ($compact_val_category as $item)
              <option value="{{ $item->id }}" @if($compact_model_val->location_category_id == $item->id)  selected="selected" @endif> {{ strtoupper($item->location_category_name) }} </option>
              @endforeach
        
                        </select>
            </div>
          </div>
                   <!-- <div class="form-group"> -->
          <div class="form-row">
            <div class="col">
              <label>@if ($service_menu_translations['select_city']) {{$service_menu_translations['select_city']}} @else Select City @endif</label>
                        <select class="form-control" name="city_id" id="city_id" required="required">
                          <option selected="selected" value="">@if ($service_menu_translations['select_city']) {{$service_menu_translations['select_city']}} @else Select City @endif</option>
                          
               @foreach ($compact_city_val as $item)
              <option value="{{ $item->id }}" @if($compact_model_val->city_id == $item->id)  selected="selected" @endif> {{ strtoupper($item->city) }} </option>
              @endforeach
        
                        </select>
               
            </div>
            <div class="col">
              <label for="exampleInputEmail1"> @if ($service_menu_translations['service_center_showroom']) {{$service_menu_translations['service_center_showroom']}} @else Service Center/Show Room @endif</label>
              <input type="text" class="form-control" id="location_name" name="location_name" placeholder="@if ($service_menu_translations['service_center_showroom']) {{$service_menu_translations['service_center_showroom']}} @else Service Center/Show Room @endif" required="required" @if($compact_model_val->location_name) value="{{ $compact_model_val->location_name }}"@endif>
            </div>
             <div class="col">
              <label for="exampleInputEmail1"> ╪º┘ä┘ü╪ª╪⌐  </label>
              <input type="text" class="form-control" id="location_name_ar" name="location_name_ar" placeholder=" ╪º┘ä┘ü╪ª╪⌐   " required="required" @if($compact_model_val->location_name_ar) value="{{ $compact_model_val->location_name_ar }}"@endif>
            </div>
          </div>
                  
         
           <div class="form-row">
            <div class="col">
             <label for="exampleInputEmail1">@if ($service_menu_translations['address']) {{$service_menu_translations['address']}} @else Address @endif</label>
                    <textarea class="form-control" rows="6" id="address" name="address" placeholder="@if ($service_menu_translations['enter_address']) {{$service_menu_translations['enter_address']}} @else Address @endif" required="">@if($compact_model_val->address) {{ $compact_model_val->address }} @endif</textarea>
            </div>


            <div class="col">
             <label for="exampleInputEmail1"> ╪╣┘å┘ê╪º┘å    </label>
                    <textarea class="form-control" rows="6" id="address_ar" name="address_ar"  placeholder=" ╪╣┘å┘ê╪º┘å   " required="">@if($compact_model_val->address_ar) {{ $compact_model_val->address_ar }} @endif</textarea>
            </div>
           

          </div>

           <div class="form-row">
            
            <div class="col">
                           <label for="exampleInputEmail1">@if ($service_menu_translations['available_services']) {{$service_menu_translations['available_services']}} @else Available services @endif</label>
                           <textarea class="form-control" rows="6" id="available_services" name="available_services" placeholder="@if ($service_menu_translations['enter_services']) {{$service_menu_translations['enter_services']}} @else Enter services @endif" required="">@if($compact_model_val->available_services) {{ $compact_model_val->available_services }} @endif</textarea>
             
            </div>

             <div class="col">
                           <label for="exampleInputEmail1">  ╪º┘ä╪▒┘à╪▓ ╪º┘ä╪¿╪▒┘è╪»┘è   </label>
                           <textarea class="form-control" rows="6" id="available_services_ar" name="available_services_ar"  placeholder=" ╪º┘ä╪▒┘à╪▓ ╪º┘ä╪¿╪▒┘è╪»┘è  "  required="">@if($compact_model_val->available_services_ar) {{ $compact_model_val->available_services_ar }} @endif</textarea>
             
            </div>

          </div>

            <div class="form-row">
            <div class="col">
             <label for="exampleInputEmail1">@if ($service_menu_translations['latitude']) {{$service_menu_translations['latitude']}} @else Latitude @endif</label>
                    <input type="text" class="form-control" id="latitude" name="latitude" placeholder="@if ($service_menu_translations['enter_latitude']) {{$service_menu_translations['enter_latitude']}} @else Enter Latitude @endif" required="required" @if($compact_model_val->latitude) value="{{ $compact_model_val->latitude }}"@endif>
            </div>
            <div class="col">
             <label for="exampleInputEmail1">@if ($service_menu_translations['longitude']) {{$service_menu_translations['longitude']}} @else Longitude @endif</label>
                    <input type="text" class="form-control" id="longitude" name="longitude" placeholder="@if ($service_menu_translations['enter_longitude']) {{$service_menu_translations['enter_longitude']}} @else Enter Longitude @endif" required="required" @if($compact_model_val->longitude) value="{{ $compact_model_val->longitude }}"@endif>
            </div>
            <div class="col">
             <label for="exampleInputEmail1">@if ($service_menu_translations['zipcode']) {{$service_menu_translations['zipcode']}} @else Zip Code @endif</label>
                    <input type="text" class="form-control" id="pincode" name="pincode" placeholder="@if ($service_menu_translations['enter_zipcode']) {{$service_menu_translations['enter_zipcode']}} @else Enter Zip Code @endif" required="required" @if($compact_model_val->pincode) value="{{ $compact_model_val->pincode }}"@endif>
            </div>
          </div>
            
         
         
          <div style="padding-top: 15px;"></div>
                
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">@if ($service_menu_translations['btn_update']) {{$service_menu_translations['btn_update']}} @else Update @endif </button>
                   <button type="button" onclick="window.history.back()" class="btn btn-primary">@if ($service_menu_translations['btn_cancel']) {{$service_menu_translations['btn_cancel']}} @else Cancel @endif</button>
                </div>
              </form>
            </div>
          
           
          </div>
         
        </div>
      </div>
    </section>
 
