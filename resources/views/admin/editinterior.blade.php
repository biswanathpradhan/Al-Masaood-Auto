<<<<<<< HEAD
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
            <h6 class="m-0 text-dark">@if(isset($model_name)) @if ($version_translations['model_name']) {{$version_translations['model_name']}} @else Model Name:  @endif  {{$model_name}} @endif</h6>
          </div>
         
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
              <li class="breadcrumb-item"><a href="{{route('getversioninfobymodellist', url_encode($model_id))}}">@if ($version_translations['version']) {{$version_translations['version']}} @else Versions @endif</a></li>
              <li class="breadcrumb-item active">@if ($version_translations['edit_interior']) {{$version_translations['edit_interior']}} @else Edit Interiors @endif </li>
            </ol>
          </div>
          <div class="col-sm-6">
            <h6 class="m-0 text-dark">@if(isset($version->version_name)) @if ($version_translations['version_name']) {{$version_translations['version_name']}} @else Version Name:  @endif  {{$version->version_name}} @endif</h6>
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
                <h3 class="card-title">@if ($version_translations['edit_interior']) {{$version_translations['edit_interior']}} @else Edit Interiors @endif</h3>
              </div>
              <form role="form" method="post" action="{{route('saveinterior')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="version_id" id="version_id" value="{{url_encode($version_id)}}">
                <input type="hidden" name="version_id_del" id="version_id_del" value="{{$version_id}}">
                 <input class="form-control" type="hidden" name="car_owned_type" id="car_owned_type" value={{$car_owned_type}}>
                 <input class="form-control" type="hidden" name="main_model_id" id="main_model_id" value={{url_encode($model_id)}}>
                <div class="card-body">
                      <div class="form-row">    
                      @foreach($car_model_version_interiors as $image)
                      @php $image_url = asset('images/interior/'.$image->image_url); @endphp
                      <a href="#" class="pop">

                      <img src="{{ asset('images/interior/'.$image->image_url) }}" id="{{$image->id}}" data="{{$image->image_url}}" style="height:120px; width:200px"/> 
                      </a>
                      <!-- <button type="button" class="btn btn-small" data-toggle="modal" data-target="#modal-sm"> View </button> -->



                      @endforeach
                      </div>
          <div class="form-row">
             <div class="col" style="    padding-top: 15px;">
                           <div class="input-group control-group increment" >
                             <div class="col">
                      <input type="file" name="filename[]" class="form-control" required="required">
                    </div>
                   <!--   <div class="col col-sm-3" >
                      <input type="color" name="color[]" class="form-control" required="required">
                      
                    </div> -->

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
                  <!-- <div class="col col-sm-3" >
                      <input type="color" name="color[]" class="form-control">
                      
                    </div> -->
                     <div class="col col-sm-3" >
                    <div class="input-group-btn"> 
                      <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> @if ($version_translations['remove']) {{$version_translations['remove']}} @else  Remove @endif</button>
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

<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">              
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">@if ($version_translations['btn_close']) {{$version_translations['btn_close']}} @else  Close @endif</span></button>
        <img src="" class="imagepreview" style="width: 100%;" >
      </div>
       <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">@if ($version_translations['btn_close']) {{$version_translations['btn_close']}} @else  Close @endif</button>
          <button type="button" class="btn btn-primary" id="delete" onclick="return deleteItem(this)">@if ($version_translations['delete']) {{$version_translations['delete']}} @else  Delete @endif </button>
        </div>
    </div>
  </div>
</div>

     
=======
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
            <h6 class="m-0 text-dark">@if(isset($model_name)) @if ($version_translations['model_name']) {{$version_translations['model_name']}} @else Model Name:  @endif  {{$model_name}} @endif</h6>
          </div>
         
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
              <li class="breadcrumb-item"><a href="{{route('getversioninfobymodellist', url_encode($model_id))}}">@if ($version_translations['version']) {{$version_translations['version']}} @else Versions @endif</a></li>
              <li class="breadcrumb-item active">@if ($version_translations['edit_interior']) {{$version_translations['edit_interior']}} @else Edit Interiors @endif </li>
            </ol>
          </div>
          <div class="col-sm-6">
            <h6 class="m-0 text-dark">@if(isset($version->version_name)) @if ($version_translations['version_name']) {{$version_translations['version_name']}} @else Version Name:  @endif  {{$version->version_name}} @endif</h6>
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
                <h3 class="card-title">@if ($version_translations['edit_interior']) {{$version_translations['edit_interior']}} @else Edit Interiors @endif</h3>
              </div>
              <form role="form" method="post" action="{{route('saveinterior')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="version_id" id="version_id" value="{{url_encode($version_id)}}">
                <input type="hidden" name="version_id_del" id="version_id_del" value="{{$version_id}}">
                 <input class="form-control" type="hidden" name="car_owned_type" id="car_owned_type" value={{$car_owned_type}}>
                 <input class="form-control" type="hidden" name="main_model_id" id="main_model_id" value={{url_encode($model_id)}}>
                <div class="card-body">
                      <div class="form-row">    
                      @foreach($car_model_version_interiors as $image)
                      @php $image_url = asset('images/interior/'.$image->image_url); @endphp
                      <a href="#" class="pop">

                      <img src="{{ asset('images/interior/'.$image->image_url) }}" id="{{$image->id}}" data="{{$image->image_url}}" style="height:120px; width:200px"/> 
                      </a>
                      <!-- <button type="button" class="btn btn-small" data-toggle="modal" data-target="#modal-sm"> View </button> -->



                      @endforeach
                      </div>
          <div class="form-row">
             <div class="col" style="    padding-top: 15px;">
                           <div class="input-group control-group increment" >
                             <div class="col">
                      <input type="file" name="filename[]" class="form-control" required="required">
                    </div>
                   <!--   <div class="col col-sm-3" >
                      <input type="color" name="color[]" class="form-control" required="required">
                      
                    </div> -->

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
                  <!-- <div class="col col-sm-3" >
                      <input type="color" name="color[]" class="form-control">
                      
                    </div> -->
                     <div class="col col-sm-3" >
                    <div class="input-group-btn"> 
                      <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> @if ($version_translations['remove']) {{$version_translations['remove']}} @else  Remove @endif</button>
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

<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">              
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">@if ($version_translations['btn_close']) {{$version_translations['btn_close']}} @else  Close @endif</span></button>
        <img src="" class="imagepreview" style="width: 100%;" >
      </div>
       <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">@if ($version_translations['btn_close']) {{$version_translations['btn_close']}} @else  Close @endif</button>
          <button type="button" class="btn btn-primary" id="delete" onclick="return deleteItem(this)">@if ($version_translations['delete']) {{$version_translations['delete']}} @else  Delete @endif </button>
        </div>
    </div>
  </div>
</div>

     
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
