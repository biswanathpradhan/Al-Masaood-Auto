 <?php 
$language_id = Session::get('language_id');
$onboarding_screen_translations = getbackendTranslations('onboarding_screen',null,$language_id);
$breadcrumb_translations = getbackendTranslations('breadcrumb ',null,$language_id);
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
              <li class="breadcrumb-item"><a href="#">@if ($onboarding_screen_translations['breadcrumb_onboarding_screen']) {{$onboarding_screen_translations['breadcrumb_onboarding_screen']}} @else Onboarding Screens @endif</a></li>
              <li class="breadcrumb-item active">@if ($onboarding_screen_translations['breadcrumb_add_onboarding_screen']) {{$onboarding_screen_translations['breadcrumb_add_onboarding_screen']}} @else Add Onboarding Screen @endif </li>
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
                <h3 class="card-title">@if ($onboarding_screen_translations['add_onboarding_screen']) {{$onboarding_screen_translations['add_onboarding_screen']}} @else Add Onboarding Screen @endif</h3>
              </div>
              <form role="form" method="post" action="{{route('saveonboarding')}}" enctype="multipart/form-data">
                @csrf

                <div class="card-body">

          <div class="form-row">
            

             
                              <div class="col">
             <label>@if ($onboarding_screen_translations['select_brand']) {{$onboarding_screen_translations['select_brand']}} @else Select Brand @endif </label>
                        <select class="form-control" name="main_brand_id" id="main_brand_id" required="required">
                          <option selected="selected" value="">@if ($onboarding_screen_translations['select_brand']) {{$onboarding_screen_translations['select_brand']}} @else Select Brand @endif</option>
                          
               @foreach ($compact_val as $item)
              <option value="{{ $item->id }}"> {{ strtoupper($item->main_brand_name) }} </option>
              @endforeach
        
                        </select>
            </div>        
                           
                     

        

            <div class="col">
               <label for="filename">@if ($onboarding_screen_translations['choose_image']) {{$onboarding_screen_translations['choose_image']}} @else Choose Image @endif </label>
                      <input type="file" name="filename[]" id="filename[]" class="form-control">
                    </div>

          </div>
 
  
           <div class="form-row">
            <div class="col col-sm-12">
             <label for="exampleInputEmail1">@if ($onboarding_screen_translations['description']) {{$onboarding_screen_translations['description']}} @else Description @endif</label>
                    <textarea class="form-control" rows="6" id="onboarding_screen_description" name="onboarding_screen_description" placeholder="Enter Description" required=""> </textarea>
            </div>
          
          </div>

           <div class="form-row">
           
            <div class="col">
            <label for="exampleInputEmail1">@if ($onboarding_screen_translations['start_date']) {{$onboarding_screen_translations['start_date']}} @else Start Date @endif </label>
                   <input class="form-control" type="text" placeholder="@if ($onboarding_screen_translations['start_date']) {{$onboarding_screen_translations['start_date']}} @else Start Date @endif" id="start_date" name="start_date">

            </div>

             <div class="col">
             <label for="exampleInputEmail1">@if ($onboarding_screen_translations['end_date']) {{$onboarding_screen_translations['end_date']}} @else End Date @endif </label>
                  <input class="form-control" type="text" placeholder="@if ($onboarding_screen_translations['end_date']) {{$onboarding_screen_translations['end_date']}} @else End Date @endif" id="end_date" name="end_date">
            </div>

 
          </div>

           
       
          <div style="padding-top: 15px;"></div>
                
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">@if ($onboarding_screen_translations['btn_submit']) {{$onboarding_screen_translations['btn_submit']}} @else Submit @endif </button>
                  <button type="button" onclick="window.location='{{ route('getonboarding') }}'" class="btn btn-primary"> @if ($onboarding_screen_translations['btn_cancel']) {{$onboarding_screen_translations['btn_cancel']}} @else Cancel @endif </button>
                </div>
              </form>
            </div>
          
           
          </div>
         
        </div>
      </div>
    </section>
 
