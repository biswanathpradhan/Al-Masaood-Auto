 <?php 
$language_id = Session::get('language_id');
$version_translations = getbackendTranslations('new_cars',null,$language_id);
$breadcrumb_translations = getbackendTranslations('breadcrumb ',null,$language_id);
$tradein_translations = getbackendTranslations('tradein',null,$language_id);
// $model_id_redirect = url_encode($compact_model_val->id);
  // dd(route('getversion'));
 ?> 


    <div class="alert alert-success" style="display:none"></div>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h6 class="m-0 text-dark">@if(isset($model_name)) @if(isset($model_name)) @if ($version_translations['model_name']) {{$version_translations['model_name']}} @else Model Name:  @endif  {{$model_name}} @endif {{$model_name}} @endif</h6>
          </div>
         
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
              <li class="breadcrumb-item"><a href="{{route('getversioninfobymodellist', url_encode($model_id))}}">@if ($version_translations['version']) {{$version_translations['version']}} @else Versions @endif</a></li>
              <li class="breadcrumb-item active">@if ($version_translations['version']) {{$version_translations['version']}} @else Edit Accessories @endif </li>
            </ol>
          </div>
          <div class="col-sm-6">
            <h6 class="m-0 text-dark">@if(isset($version->version_name)) @if ($version_translations['version_name']) {{$version_translations['version_name']}} @else Version Name:  @endif {{$version->version_name}} @endif</h6>
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
                <h3 class="card-title">@if ($version_translations['edit_accessories']) {{$version_translations['edit_accessories']}} @else Edit Accessories @endif </h3>
              </div>
              <form role="form" method="post" action="{{route('saveaccessories')}}" enctype="multipart/form-data" >
                @csrf
                <input type="hidden" name="version_id" id="version_id" value="{{url_encode($version_id)}}">
                <input type="hidden" name="version_id_del" id="version_id_del" value="{{$version_id}}">
                 <input class="form-control" type="hidden" name="car_owned_type" id="car_owned_type" value={{$car_owned_type}}>
                  <input class="form-control" type="hidden" name="main_model_id" id="main_model_id" value={{url_encode($model_id)}}>
                <div class="card-body">
                   <div class="form-row" style="padding-left: 10px;padding-bottom: 10px">    
                      @foreach($car_model_version_accessories as $image)
                      @php $image_url = asset('storage/images/accessories/'.$image->accessories_image_url); @endphp
                       <div class="col-sm-4" >
                         <h6>{{$image->accessories_title}} </h6>
                      <a href="#" class="pop">

                      <img src="{{ asset('storage/images/accessories/'.$image->accessories_image_url) }}" id="{{$image->id}}" data="{{$image->accessories_description}}" title="{{$image->accessories_description}}" style="height:120px; width:200px"/> 
                      </a>
                      <!-- <button type="button" class="btn btn-small" data-toggle="modal" data-target="#modal-sm"> View </button> -->


                    </div>
                      @endforeach
                      </div>
                       <div class="form-row">
                        <div class="col-sm-6" >
                    <label for="exampleInput">@if ($version_translations['accessories_name']) {{$version_translations['accessories_name']}} @else Accessory Name @endif </label>
                    <input type="text" class="form-control" id="accessories_title" name="accessories_title[]" placeholder="@if ($version_translations['enter_accerssory']) {{$version_translations['enter_accerssory']}} @else Enter accessory @endif" required="required">
                  </div>
                   <div class="col-sm-6" >
                    <label for="exampleInput">@if ($version_translations['accessories_description']) {{$version_translations['accessories_description']}} @else Accessory description @endif </label>
                    <input type="text" class="form-control" id="accessories_description" name="accessories_description[]" placeholder="
                    @if ($version_translations['enter_description']) {{$version_translations['enter_description']}} @else Enter description @endif
                    " required="required">
                  </div>
 
                  </div>   

                  <div class="form-row">
                        
                   <div class="col-sm-6" >
                                <label for="exampleInput">@if ($version_translations['accessory_price_without_installation']) {{$version_translations['accessory_price_without_installation']}} @else Accessory Price Without Installtion @endif </label>
                      <input type="number" name="price[]" class="form-control" required="required" placeholder="@if ($version_translations['enter_price_with_installation']) {{$version_translations['enter_price_with_installation']}} @else Enter Price Without Installtion @endif ">
                      
                    </div>

                    <div class="col-sm-6" >
                                <label for="exampleInput">@if ($version_translations['accessory_price_installation']) {{$version_translations['accessory_price_installation']}} @else Accessory Price With Installation @endif </label>
                      <input type="number" name="price_installation[]" class="form-control" required="required" placeholder="@if ($version_translations['enter_price_without_installation']) {{$version_translations['enter_price_without_installation']}} @else Enter Price With Installtion @endif
                      ">
                      
                    </div>
                  </div>
          <div class="form-row">
             <div class="col-sm-12" style="padding-top: 15px;">
                           <div class="input-group control-group increment" >
                              
                             <div class="col-sm-6">
                                
                      <input type="file" name="filename[]" class="form-control" required="required">
                    </div>
                  

                     <div class="col-sm-3" >
                      
                      <div class="input-group-btn"> 
                        <button class="btn btn-success btn-success-accessories" type="button"><i class="glyphicon glyphicon-plus"></i>@if ($version_translations['add']) {{$version_translations['add']}} @else  Add @endif</button>
                      </div>
                    </div>
                
                 </div>
          </div>

          </div>
         
           <div class="form-row">
             <div class="col-sm-12" style=" padding-top: 15px;">

                  <div class="clone hide " style="display: none">
                    <div class="control-group border border-light rounded" style=" margin-top: 25px;">
                    
                      <div class="form-row">
                        <div class="col-sm-6 " >
                    <label for="exampleInput">@if ($version_translations['accessories_name']) {{$version_translations['accessories_name']}} @else Accessory Name @endif</label>
                    <input type="text" class="form-control" id="accessories_title" name="accessories_title[]" placeholder="@if ($version_translations['enter_accerssory']) {{$version_translations['enter_accerssory']}} @else Enter accessory @endif">
                  </div>
                   <div class="col-sm-6" >
                    <label for="exampleInput">@if ($version_translations['accessories_description']) {{$version_translations['accessories_description']}} @else Accessory description @endif</label>
                    <input type="text" class="form-control" id="accessories_description" name="accessories_description[]" placeholder="@if ($version_translations['enter_description']) {{$version_translations['enter_description']}} @else Enter description @endif">
                  </div>
                    
                  </div>

                   <div class="form-row">
                      
                  
                   <div class="col-sm-6" >
                                <label for="exampleInput">@if ($version_translations['accessory_price_without_installation']) {{$version_translations['accessory_price_without_installation']}} @else Accessory Price Without Installtion @endif</label>
                      <input type="number" name="price[]" class="form-control" placeholder="@if ($version_translations['enter_price_with_installation']) {{$version_translations['enter_price_with_installation']}} @else Enter Price Without Installtion @endif">
                      
                    </div>

                     <div class="col-sm-6" >
                                <label for="exampleInput">@if ($version_translations['accessory_price_installation']) {{$version_translations['accessory_price_installation']}} @else Accessory Price With Installation @endif</label>
                      <input type="number" name="price_installation[]" class="form-control" placeholder="@if ($version_translations['enter_price_without_installation']) {{$version_translations['enter_price_without_installation']}} @else Enter Price With Installtion @endif">
                      
                    </div>
                  </div>
                  <div class="input-group" style="margin-top:5px">
                       <div class="col-sm-6">
                    <input type="file" name="filename[]" class="form-control">
                  </div>
 
                     <div class="col-sm-3" >
                    <div class="input-group-btn"> 
                      <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> @if ($version_translations['remove']) {{$version_translations['remove']}} @else  Remove @endif</button>
                    </div>
                  </div>
                  </div>

                  </div>
                </div>
                  
          </div>

          </div>

          <div style="padding-top: 15px;"></div>
                
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">@if ($version_translations['btn_submit']) {{$version_translations['btn_submit']}} @else  Submit @endif</button>
                  <button type="button" onclick="window.history.back()" class="btn btn-primary">@if ($version_translations['btn_cancel']) {{$version_translations['btn_cancel']}} @else  Cancel @endif</button>
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

        <div class="col-sm-4" >
                    <label for="exampleInput">Accessory description</label>
                    <textarea id="showdescription" cols="50" rows="4" disabled="disabled">data</textarea> 
        </div>

      </div>
       <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <!-- <button type="button" class="btn btn-primary" id="delete" onclick="return deleteItemexterior(this)">Delete</button> -->
        </div>
    </div>
  </div>
</div>

     
 