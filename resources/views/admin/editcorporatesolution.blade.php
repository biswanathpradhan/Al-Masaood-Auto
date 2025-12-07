<<<<<<< HEAD
<?php 
$language_id = Session::get('language_id');
$model_translations = getbackendTranslations('new_cars',null,$language_id);
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
              <li class="breadcrumb-item"><a href="#">@if ($corporate_translations['corporate_solutions']) {{$corporate_translations['corporate_solutions']}} @else Corporate Solutions @endif</a></li>
              <li class="breadcrumb-item active">@if ($corporate_translations['edit_corporate_solution']) {{$corporate_translations['edit_corporate_solution']}} @else Edit Corporate Solutions @endif</li>
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
                <h3 class="card-title">@if ($corporate_translations['edit_corporate_solution']) {{$corporate_translations['edit_corporate_solution']}} @else Edit Corporate Solutions @endif</h3>
              </div>
              <form role="form" method="post" action="{{route('updatecorporatesolution')}}" enctype="multipart/form-data">
                @csrf
                 <input type="hidden" class="form-control" id="corporate_id" name="corporate_id" @if($corporate_id) value="{{ $corporate_id }}"@endif>
                <div class="card-body">
              
         
                         <div class="form-row">
            <div class="col">
             <label>@if ($corporate_translations['select_brand']) {{$corporate_translations['select_brand']}} @else Select Brand @endif</label>
                        <select class="form-control" name="main_brand_id" id="main_brand_id" required="required">
                          <option selected="selected" value="">@if ($corporate_translations['select_brand']) {{$corporate_translations['select_brand']}} @else Select Brand @endif</option>
                          
               @foreach ($compact_val as $item)
              <option value="{{ $item->id }}" @if($compact_model_val->main_brand_id == $item->id)  selected="selected" @endif> {{ strtoupper($item->main_brand_name) }} </option>
              @endforeach
        
                        </select>
            </div>
         
          </div>
            <div class="form-row">
            <div class="col">
             <label for="exampleInputEmail1">@if ($corporate_translations['title']) {{$corporate_translations['title']}} @else Title @endif</label>
                 <input type="text" class="form-control" id="corporate_solutions_title" name="corporate_solutions_title" placeholder="@if ($corporate_translations['enter_title']) {{$corporate_translations['enter_title']}} @else Enter Title @endif" required="required" @if($compact_model_val->corporate_solutions_title) value="{{ $compact_model_val->corporate_solutions_title }}"@endif>
            </div>
            
            
          </div>

            <div class="form-row">
           
            <div class="col">
              <label for="exampleInputEmail1"> @if ($corporate_translations['description']) {{$corporate_translations['description']}} @else Description @endif</label>
              <textarea type="text" class="form-control" id="corporate_solutions_description" name="corporate_solutions_description" placeholder="@if ($corporate_translations['enter_description']) {{$corporate_translations['enter_description']}} @else Enter Description @endif" required="required">@if($compact_model_val->corporate_solutions_description) {{ $compact_model_val->corporate_solutions_description }}@endif</textarea>
            </div>
          </div>
            
         
         
          <div style="padding-top: 15px;"></div>
                
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">@if ($corporate_translations['update']) {{$corporate_translations['update']}} @else Update @endif  </button>
                  <button  type="button" onclick="window.history.back()"  class="btn btn-primary">@if ($corporate_translations['cancel']) {{$corporate_translations['cancel']}} @else Cancel @endif</button>
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
              <li class="breadcrumb-item"><a href="#">@if ($corporate_translations['corporate_solutions']) {{$corporate_translations['corporate_solutions']}} @else Corporate Solutions @endif</a></li>
              <li class="breadcrumb-item active">@if ($corporate_translations['edit_corporate_solution']) {{$corporate_translations['edit_corporate_solution']}} @else Edit Corporate Solutions @endif</li>
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
                <h3 class="card-title">@if ($corporate_translations['edit_corporate_solution']) {{$corporate_translations['edit_corporate_solution']}} @else Edit Corporate Solutions @endif</h3>
              </div>
              <form role="form" method="post" action="{{route('updatecorporatesolution')}}" enctype="multipart/form-data">
                @csrf
                 <input type="hidden" class="form-control" id="corporate_id" name="corporate_id" @if($corporate_id) value="{{ $corporate_id }}"@endif>
                <div class="card-body">
              
         
                         <div class="form-row">
            <div class="col">
             <label>@if ($corporate_translations['select_brand']) {{$corporate_translations['select_brand']}} @else Select Brand @endif</label>
                        <select class="form-control" name="main_brand_id" id="main_brand_id" required="required">
                          <option selected="selected" value="">@if ($corporate_translations['select_brand']) {{$corporate_translations['select_brand']}} @else Select Brand @endif</option>
                          
               @foreach ($compact_val as $item)
              <option value="{{ $item->id }}" @if($compact_model_val->main_brand_id == $item->id)  selected="selected" @endif> {{ strtoupper($item->main_brand_name) }} </option>
              @endforeach
        
                        </select>
            </div>
         
          </div>
            <div class="form-row">
            <div class="col">
             <label for="exampleInputEmail1">@if ($corporate_translations['title']) {{$corporate_translations['title']}} @else Title @endif</label>
                 <input type="text" class="form-control" id="corporate_solutions_title" name="corporate_solutions_title" placeholder="@if ($corporate_translations['enter_title']) {{$corporate_translations['enter_title']}} @else Enter Title @endif" required="required" @if($compact_model_val->corporate_solutions_title) value="{{ $compact_model_val->corporate_solutions_title }}"@endif>
            </div>
            
            
          </div>

            <div class="form-row">
           
            <div class="col">
              <label for="exampleInputEmail1"> @if ($corporate_translations['description']) {{$corporate_translations['description']}} @else Description @endif</label>
              <textarea type="text" class="form-control" id="corporate_solutions_description" name="corporate_solutions_description" placeholder="@if ($corporate_translations['enter_description']) {{$corporate_translations['enter_description']}} @else Enter Description @endif" required="required">@if($compact_model_val->corporate_solutions_description) {{ $compact_model_val->corporate_solutions_description }}@endif</textarea>
            </div>
          </div>
            
         
         
          <div style="padding-top: 15px;"></div>
                
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">@if ($corporate_translations['update']) {{$corporate_translations['update']}} @else Update @endif  </button>
                  <button  type="button" onclick="window.history.back()"  class="btn btn-primary">@if ($corporate_translations['cancel']) {{$corporate_translations['cancel']}} @else Cancel @endif</button>
                </div>
              </form>
            </div>
          
           
          </div>
         
        </div>
      </div>
    </section>
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
 