<?php 
$language_id = Session::get('language_id');
$service_menu_translations = getbackendTranslations('servicepackges',null,$language_id);
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
              <li class="breadcrumb-item"><a href="#">@if ($service_menu_translations['heading_servicepackges']) {{$service_menu_translations['heading_servicepackges']}} @else All Service Packages @endif </a></li>
              <li class="breadcrumb-item active">@if ($service_menu_translations['breadcrumb_add_package']) {{$service_menu_translations['breadcrumb_add_package']}} @else Add Package @endif  </li>
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
                <h3 class="card-title">@if ($service_menu_translations['servicepackge']) {{$service_menu_translations['servicepackge']}} @else Service Package @endif </h3>
              </div>
              <form role="form" method="post" action="{{route('saveservicepackage')}}" enctype="multipart/form-data">
                @csrf
                 <input type="hidden" class="form-control" id="language_id" name="language_id" value="{{$language_id}}">
                     <div class="card-body">
                       <div class="form-row">
            <div class="col">
             <label>@if ($service_menu_translations['select_brand']) {{$service_menu_translations['select_brand']}} @else Select Brand @endif</label>
                        <select class="form-control" name="main_brand_id" id="main_brand_id" required="required">
                          <option selected="selected" value="">@if ($service_menu_translations['select_brand']) {{$service_menu_translations['select_brand']}} @else Select Brand @endif</option>
                          
               @foreach ($compact_val as $item)
              <option value="{{ $item->id }}"> {{ strtoupper($item->main_brand_name) }} </option>
              @endforeach
        
                        </select>
            </div>
         
          </div>
                 
           <div class="form-row">
            <div class="col">
             <label for="exampleInputEmail1">@if ($service_menu_translations['title']) {{$service_menu_translations['title']}} @else Title @endif</label>
                    <input type="text" class="form-control" id="service_package_title" name="service_package_title" placeholder="@if ($service_menu_translations['enter_title']) {{$service_menu_translations['enter_title']}} @else Enter Title @endif" required="required" >
            </div>
           
          
          </div>
                 <div class="form-row">
            <div class="col">
             <label for="exampleInputEmail1">@if ($service_menu_translations['price']) {{$service_menu_translations['price']}} @else Price @endif</label>
                    <input type="text" class="form-control" id="service_package_price" name="service_package_price" placeholder="@if ($service_menu_translations['enter_price']) {{$service_menu_translations['enter_price']}} @else Enter Price @endif" required="required" >
            </div>
           
          
          </div>
            
             <div class="form-row">
            <div class="col">
             <label for="exampleInputEmail1">@if ($service_menu_translations['description']) {{$service_menu_translations['description']}} @else Description @endif</label>
                    <textarea class="form-control" rows="6" id="service_package_description" name="service_package_description" placeholder="@if ($service_menu_translations['enter_description']) {{$service_menu_translations['enter_description']}} @else Enter Description @endif" required=""> </textarea>
            </div>
          
          </div>
  
         
          <div style="padding-top: 15px;"></div>
                
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">@if ($service_menu_translations['btn_submit']) {{$service_menu_translations['btn_submit']}} @else Submit @endif</button>
                  <button  type="button" onclick="window.history.back()"  class="btn btn-primary">@if ($service_menu_translations['btn_cancel']) {{$service_menu_translations['btn_cancel']}} @else Cancel @endif</button>
                </div>
              </form>
            </div>
          
           
          </div>
         
        </div>
      </div>
    </section>
 