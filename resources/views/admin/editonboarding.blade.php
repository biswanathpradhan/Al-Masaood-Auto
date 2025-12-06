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
              <li class="breadcrumb-item active">@if ($onboarding_screen_translations['breadcrumb_edit_onboarding_screen']) {{$onboarding_screen_translations['breadcrumb_edit_onboarding_screen']}} @else Edit Onboarding Screen @endif </li>
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
                <h3 class="card-title">@if ($onboarding_screen_translations['edit_onboarding_screen']) {{$onboarding_screen_translations['edit_onboarding_screen']}} @else Edit Onboarding Screen @endif</h3>
              </div>
              <form role="form" method="post" action="{{route('updateonboarding')}}" enctype="multipart/form-data">
                @csrf

                  <input type="hidden" class="form-control" id="onboarding_id" name="onboarding_id" @if($onboarding_id) value="{{ $onboarding_id }}"@endif>

                <div class="card-body">

          <div class="form-row">
            

             
                              <div class="col">
             <label>@if ($onboarding_screen_translations['select_brand']) {{$onboarding_screen_translations['select_brand']}} @else Select Brand @endif</label>
                        <select class="form-control" name="main_brand_id" id="main_brand_id" required="required">
                          <option selected="selected" value="">@if ($onboarding_screen_translations['select_brand']) {{$onboarding_screen_translations['select_brand']}} @else Select Brand @endif</option>
                          
               @foreach ($compact_val as $item)
              <option value="{{ $item->id }}" @if($compact_model_val->main_brand_id == $item->id)  selected="selected" @endif> {{ strtoupper($item->main_brand_name) }} </option>
              @endforeach
        
                        </select>
            </div>        
                           
                     

        

             @if($compact_model_val->onboarding_screen_image_url)
                    @php $image_url = asset('storage/images/onboarding_screen/'.$compact_model_val->onboarding_screen_image_url); @endphp
                   
            <div class="col">
                      <a href="#" class="pop">

                      <img src="{{ asset('images/onboarding_screen/'.$compact_model_val->onboarding_screen_image_url) }}" id="{{$onboarding_id}}" data="{{$compact_model_val->onboarding_screen_image_url}}" style="height:120px; width:200px"/> 
                      </a>
                        </div>
                     
                   @else
                       
              <div class="col">
                           
                         <label for="exampleInputEmail1">@if ($onboarding_screen_translations['choose_image']) {{$onboarding_screen_translations['choose_image']}} @else Choose Image @endif </label>    
                     <input type="file" name="filename[]" id="filename[]" class="form-control" required="required">
                        
 
                 </div>
           @endif

          </div>
 
  
           <div class="form-row">
            <div class="col col-sm-12">
             <label for="exampleInputEmail1">@if ($onboarding_screen_translations['description']) {{$onboarding_screen_translations['description']}} @else Description @endif</label>
                    <textarea class="form-control" rows="6" id="onboarding_screen_description" name="onboarding_screen_description" placeholder="Enter Description" required="">@if($compact_model_val->onboarding_screen_description) {{ $compact_model_val->onboarding_screen_description }} @endif </textarea>
            </div>
          
          </div>

           <div class="form-row">
            <div class="col">
            <label for="exampleInputEmail1">@if ($onboarding_screen_translations['start_date']) {{$onboarding_screen_translations['start_date']}} @else Start Date @endif</label>
                   <input class="form-control" type="text" placeholder="@if ($onboarding_screen_translations['start_date']) {{$onboarding_screen_translations['start_date']}} @else Start Date @endif" id="start_date" name="start_date" @if($compact_model_val->start_date) value="{{ $compact_model_val->start_date }}"@endif>

            </div>

             <div class="col">
             <label for="exampleInputEmail1">@if ($onboarding_screen_translations['end_date']) {{$onboarding_screen_translations['end_date']}} @else End Date @endif</label>
                  <input class="form-control" type="text" placeholder="@if ($onboarding_screen_translations['end_date']) {{$onboarding_screen_translations['end_date']}} @else End Date @endif" id="end_date" name="end_date" @if($compact_model_val->end_date) value="{{ $compact_model_val->end_date }}"@endif>
            </div>

           
 
          </div>

           
       
          <div style="padding-top: 15px;"></div>
                
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">@if ($onboarding_screen_translations['btn_submit']) {{$onboarding_screen_translations['btn_submit']}} @else Submit @endif</button>
                  <button type="button" onclick="window.location='{{ URL::previous() }}'" class="btn btn-primary"> @if ($onboarding_screen_translations['btn_cancel']) {{$onboarding_screen_translations['btn_cancel']}} @else Cancel @endif</button>
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
          <button type="button" class="btn btn-default" data-dismiss="modal">@if ($onboarding_screen_translations['btn_close']) {{$onboarding_screen_translations['btn_close']}} @else Close @endif</button>
          <button type="button" class="btn btn-primary" id="delete" onclick="return deleteItemonboardingimage(this)"> @if ($onboarding_screen_translations['btn_delete']) {{$onboarding_screen_translations['btn_delete']}} @else Delete @endif</button>
        </div>
    </div>
  </div>
</div>