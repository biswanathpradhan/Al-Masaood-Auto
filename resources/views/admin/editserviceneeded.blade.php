<<<<<<< HEAD
<?php 
$language_id = Session::get('language_id');
$service_menu_translations = getbackendTranslations('service_needed',null,$language_id);
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
              <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i>  @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
              <li class="breadcrumb-item"><a href="#">@if ($service_menu_translations['heading_serviceneeded']) {{$service_menu_translations['heading_serviceneeded']}} @else Service Needed @endif</a></li>
              <li class="breadcrumb-item active">@if ($service_menu_translations['edit_service']) {{$service_menu_translations['edit_service']}} @else Add Service @endif</li>
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
                <h3 class="card-title">@if ($service_menu_translations['heading_serviceneeded']) {{$service_menu_translations['heading_serviceneeded']}} @else Service Needed @endif</h3>
              </div>
              <form role="form" method="post" action="{{route('updateServiceNeeded')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" class="form-control" id="language_id" name="language_id" value="{{$language_id}}">
                 <input type="hidden" class="form-control" id="service_id" name="service_id" @if($service_id) value="{{ $service_id }}"@endif>
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
         
          </div>
                 
           <div class="form-row">
            <div class="col">
             <label for="exampleInputEmail1">@if ($service_menu_translations['title']) {{$service_menu_translations['title']}} @else Title @endif</label>
                    <input type="text" class="form-control" id="service_needed_title" name="service_needed_title" placeholder="@if ($service_menu_translations['enter_title']) {{$service_menu_translations['enter_title']}} @else Title @endif" required="required" @if($compact_model_val->service_needed_title) value="{{ $compact_model_val->service_needed_title }}"@endif>
            </div>
           
          
          </div>
          
          
         
         
          <div style="padding-top: 15px;"></div>
                
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"> @if ($service_menu_translations['btn_update']) {{$service_menu_translations['btn_update']}} @else Update @endif </button>
                  <button  type="button" onclick="window.history.back()"  class="btn btn-primary">@if ($service_menu_translations['btn_cancel']) {{$service_menu_translations['btn_cancel']}} @else Cancel @endif</button>
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
$service_menu_translations = getbackendTranslations('service_needed',null,$language_id);
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
              <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i>  @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
              <li class="breadcrumb-item"><a href="#">@if ($service_menu_translations['heading_serviceneeded']) {{$service_menu_translations['heading_serviceneeded']}} @else Service Needed @endif</a></li>
              <li class="breadcrumb-item active">@if ($service_menu_translations['edit_service']) {{$service_menu_translations['edit_service']}} @else Add Service @endif</li>
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
                <h3 class="card-title">@if ($service_menu_translations['heading_serviceneeded']) {{$service_menu_translations['heading_serviceneeded']}} @else Service Needed @endif</h3>
              </div>
              <form role="form" method="post" action="{{route('updateServiceNeeded')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" class="form-control" id="language_id" name="language_id" value="{{$language_id}}">
                 <input type="hidden" class="form-control" id="service_id" name="service_id" @if($service_id) value="{{ $service_id }}"@endif>
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
         
          </div>
                 
           <div class="form-row">
            <div class="col">
             <label for="exampleInputEmail1">@if ($service_menu_translations['title']) {{$service_menu_translations['title']}} @else Title @endif</label>
                    <input type="text" class="form-control" id="service_needed_title" name="service_needed_title" placeholder="@if ($service_menu_translations['enter_title']) {{$service_menu_translations['enter_title']}} @else Title @endif" required="required" @if($compact_model_val->service_needed_title) value="{{ $compact_model_val->service_needed_title }}"@endif>
            </div>
           
          
          </div>
          
          
         
         
          <div style="padding-top: 15px;"></div>
                
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"> @if ($service_menu_translations['btn_update']) {{$service_menu_translations['btn_update']}} @else Update @endif </button>
                  <button  type="button" onclick="window.history.back()"  class="btn btn-primary">@if ($service_menu_translations['btn_cancel']) {{$service_menu_translations['btn_cancel']}} @else Cancel @endif</button>
                </div>
              </form>
            </div>
          
           
          </div>
         
        </div>
      </div>
    </section>
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
 