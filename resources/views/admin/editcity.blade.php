<?php 
$language_id = Session::get('language_id');
$service_menu_translations = getbackendTranslations('city',null,$language_id);
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
              <li class="breadcrumb-item"><a href="#">@if ($service_menu_translations['breadcrumb_city']) {{$service_menu_translations['breadcrumb_city']}} @else City @endif</a></li>
              <li class="breadcrumb-item active">@if ($service_menu_translations['edit_city']) {{$service_menu_translations['edit_city']}} @else Edit City @endif</li>
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
                <h3 class="card-title">@if ($service_menu_translations['edit_city']) {{$service_menu_translations['edit_city']}} @else Edit City @endif</h3>
              </div>
              <form role="form" method="post" action="{{route('updatecity')}}" enctype="multipart/form-data">
                @csrf
                 <input type="hidden" class="form-control" id="city_id" name="city_id" @if($city_id) value="{{ $city_id }}"@endif>
                <div class="card-body">
              
         

            <div class="form-row">
            <div class="col">
             <label for="exampleInputEmail1">@if ($service_menu_translations['city']) {{$service_menu_translations['city']}} @else City @endif</label>
                 <input type="text" class="form-control" id="city" name="city" placeholder="@if ($service_menu_translations['enter_city']) {{$service_menu_translations['enter_city']}} @else Enter City @endif" required="required" @if($compact_model_val->city) value="{{ $compact_model_val->city }}"@endif>
            </div>

             <div class="col">
             <label for="exampleInputEmail1">┘à╪»┘è┘å╪⌐  </label>
                 <input type="text" class="form-control" id="city_ar" name="city_ar" placeholder="┘à╪»┘è┘å╪⌐  " required="required" @if($compact_model_val->city_ar) value="{{ $compact_model_val->city_ar }}"@endif>
            </div>
            
            
          </div>
            
         
         
          <div style="padding-top: 15px;"></div>
                
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">@if ($service_menu_translations['btn_update']) {{$service_menu_translations['btn_update']}} @else Update @endif</button>
                  <button  type="button" onclick="window.history.back()" class="btn btn-primary">@if ($service_menu_translations['btn_cancel']) {{$service_menu_translations['btn_cancel']}} @else Cancel @endif</button>
                </div>
              </form>
            </div>
          
           
          </div>
         
        </div>
      </div>
    </section>
 
