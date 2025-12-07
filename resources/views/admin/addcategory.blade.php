<<<<<<< HEAD
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
              <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
              <li class="breadcrumb-item"><a href="#">@if ($specifications_translations['specifications']) {{$specifications_translations['specifications']}} @else Specification @endif</a></li>
              <li class="breadcrumb-item active">@if ($specifications_translations['add_category']) {{$specifications_translations['add_category']}} @else Add Category @endif</li>
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
                <h3 class="card-title">@if ($specifications_translations['add_category']) {{$specifications_translations['add_category']}} @else Add Category @endif</h3>
              </div>
              <form role="form" method="post" action="{{route('savecategory')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
               
                  <div class="form-group">
                    <label for="exampleInputEmail1">@if ($specifications_translations['specification_category']) {{$specifications_translations['specification_category']}} @else Specification Category @endif </label> 
                    <input type="text" class="form-control" id="specification_category" name="specification_category" placeholder="@if ($specifications_translations['specification_category']) {{$specifications_translations['specification_category']}} @else Enter Category @endif " required="required">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1">مواصفة</label>
                    <input type="text" class="form-control" id="specification_category_ar" name="specification_category_ar" placeholder="@if ($specifications_translations['specification_category']) {{$specifications_translations['specification_category']}} @else Enter Category @endif" required="required">
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
=======
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
              <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
              <li class="breadcrumb-item"><a href="#">@if ($specifications_translations['specifications']) {{$specifications_translations['specifications']}} @else Specification @endif</a></li>
              <li class="breadcrumb-item active">@if ($specifications_translations['add_category']) {{$specifications_translations['add_category']}} @else Add Category @endif</li>
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
                <h3 class="card-title">@if ($specifications_translations['add_category']) {{$specifications_translations['add_category']}} @else Add Category @endif</h3>
              </div>
              <form role="form" method="post" action="{{route('savecategory')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
               
                  <div class="form-group">
                    <label for="exampleInputEmail1">@if ($specifications_translations['specification_category']) {{$specifications_translations['specification_category']}} @else Specification Category @endif </label> 
                    <input type="text" class="form-control" id="specification_category" name="specification_category" placeholder="@if ($specifications_translations['specification_category']) {{$specifications_translations['specification_category']}} @else Enter Category @endif " required="required">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1">مواصفة</label>
                    <input type="text" class="form-control" id="specification_category_ar" name="specification_category_ar" placeholder="@if ($specifications_translations['specification_category']) {{$specifications_translations['specification_category']}} @else Enter Category @endif" required="required">
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
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
 