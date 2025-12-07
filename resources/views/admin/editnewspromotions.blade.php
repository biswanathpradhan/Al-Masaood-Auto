<<<<<<< HEAD
<?php 
$language_id = Session::get('language_id');
$service_menu_translations = getbackendTranslations('newspromotions',null,$language_id);
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
              <li class="breadcrumb-item"><a href="#">@if ($service_menu_translations['heading_newspromotions']) {{$service_menu_translations['heading_newspromotions']}} @else All News & Promotions @endif</a></li>
              <li class="breadcrumb-item active">@if ($service_menu_translations['edit_news_promotion']) {{$service_menu_translations['edit_news_promotion']}} @else Edit News & Promotion @endif</li>
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
                <h3 class="card-title">@if ($service_menu_translations['edit_news_promotion']) {{$service_menu_translations['edit_news_promotion']}} @else Edit News & Promotion @endif</h3>
              </div>
              <form role="form" method="post" action="{{route('updatenewspromotions')}}" enctype="multipart/form-data">
                @csrf
                  <input type="hidden" class="form-control" id="news_promotionsid" name="news_promotionsid" @if($news_promotionsid) value="{{ $news_promotionsid }}"@endif>
                <div class="card-body">


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
                           
                     
             @if($compact_model_val->news_promotions_image_url)
                    @php $image_url = asset('storage/images/news_promotions/'.$compact_model_val->news_promotions_image_url); @endphp
                   
            <div class="col">
                      <a href="#" class="pop">

                      <img src="{{ asset('images/news_promotions/'.$compact_model_val->news_promotions_image_url) }}" id="{{$news_promotionsid}}" data="{{$compact_model_val->news_promotions_image_url}}" style="height:120px; width:200px"/> 
                      </a>
                        </div>
                     
                   @else
                       
              <div class="col">
                           
                         <label for="exampleInputEmail1">@if ($service_menu_translations['choose_image']) {{$service_menu_translations['choose_image']}} @else Choose Image @endif</label>    
                     <input type="file" name="filename[]" id="filename[]" class="form-control" required="required">
                        
 
                 </div>
           @endif

        

          </div>
 

                   

                  <!-- <div class="form-group"> -->
       <div class="form-row">
            <div class="col col-sm-12">
             <label for="exampleInputEmail1">@if ($service_menu_translations['title']) {{$service_menu_translations['title']}} @else Title @endif</label> 
                    <input type="text" class="form-control" id="news_promotions_title" name="news_promotions_title" placeholder="@if ($service_menu_translations['title']) {{$service_menu_translations['title']}} @else Title @endif" required="required" @if($compact_model_val->news_promotions_title) value="{{ $compact_model_val->news_promotions_title }}"@endif >
            </div>
           
          
          </div>
                  
           <div class="form-row">
            <div class="col col-sm-12">
             <label>@if ($service_menu_translations['select_type']) {{$service_menu_translations['select_type']}} @else Select Type @endif</label>
                        <select class="form-control" name="news_promotions_type" id="news_promotions_type">
                          <option selected="selected" value="">@if ($service_menu_translations['select_type']) {{$service_menu_translations['select_type']}} @else Select Type @endif</option>
                          
              
              <option value="1" @if($compact_model_val->news_promotions_type == 1)  selected="selected" @endif>News</option>
              <option value="2" @if($compact_model_val->news_promotions_type == 2)  selected="selected" @endif>Promotions</option>
              
        
                        </select>
           
          </div>
          </div>
            
           <div class="form-row">
            <div class="col col-sm-12">
             <label for="exampleInputEmail1">@if ($service_menu_translations['description']) {{$service_menu_translations['description']}} @else Description @endif</label>
                    <textarea class="form-control" rows="6" id="news_promotions_description" name="news_promotions_description" placeholder="@if ($service_menu_translations['description']) {{$service_menu_translations['description']}} @else Description @endif" required="">@if($compact_model_val->news_promotions_description) {{ $compact_model_val->news_promotions_description }} @endif </textarea>
            </div>
          
          </div>

           <div class="form-row">
           
            <div class="col">
            <label for="exampleInputEmail1">@if ($service_menu_translations['start_date']) {{$service_menu_translations['start_date']}} @else Start Date @endif</label>
                   <input class="form-control" type="text" placeholder="@if ($service_menu_translations['start_date']) {{$service_menu_translations['start_date']}} @else Start Date @endif" id="start_date" name="start_date" @if($compact_model_val->start_date) value="{{ $compact_model_val->start_date }}"@endif>

            </div>

             <div class="col">
             <label for="exampleInputEmail1">@if ($service_menu_translations['end_date']) {{$service_menu_translations['end_date']}} @else End Date @endif</label>
                  <input class="form-control" type="text" placeholder="@if ($service_menu_translations['end_date']) {{$service_menu_translations['end_date']}} @else End Date @endif" id="end_date" name="end_date" @if($compact_model_val->end_date) value="{{ $compact_model_val->end_date }}"@endif>
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
  <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">              
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">@if ($service_menu_translations['btn_close']) {{$service_menu_translations['btn_close']}} @else Close @endif</span></button>
        <img src="" class="imagepreview" style="width: 100%;" >
      </div>
       <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">@if ($service_menu_translations['btn_close']) {{$service_menu_translations['btn_close']}} @else Close @endif</button>
          <button type="button" class="btn btn-primary" id="delete" onclick="return deleteItemnewspromotionsimage(this)">@if ($service_menu_translations['btn_delete']) {{$service_menu_translations['btn_delete']}} @else Delete @endif </button>
        </div>
    </div>
  </div>
</div>
=======
<?php 
$language_id = Session::get('language_id');
$service_menu_translations = getbackendTranslations('newspromotions',null,$language_id);
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
              <li class="breadcrumb-item"><a href="#">@if ($service_menu_translations['heading_newspromotions']) {{$service_menu_translations['heading_newspromotions']}} @else All News & Promotions @endif</a></li>
              <li class="breadcrumb-item active">@if ($service_menu_translations['edit_news_promotion']) {{$service_menu_translations['edit_news_promotion']}} @else Edit News & Promotion @endif</li>
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
                <h3 class="card-title">@if ($service_menu_translations['edit_news_promotion']) {{$service_menu_translations['edit_news_promotion']}} @else Edit News & Promotion @endif</h3>
              </div>
              <form role="form" method="post" action="{{route('updatenewspromotions')}}" enctype="multipart/form-data">
                @csrf
                  <input type="hidden" class="form-control" id="news_promotionsid" name="news_promotionsid" @if($news_promotionsid) value="{{ $news_promotionsid }}"@endif>
                <div class="card-body">


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
                           
                     
             @if($compact_model_val->news_promotions_image_url)
                    @php $image_url = asset('storage/images/news_promotions/'.$compact_model_val->news_promotions_image_url); @endphp
                   
            <div class="col">
                      <a href="#" class="pop">

                      <img src="{{ asset('images/news_promotions/'.$compact_model_val->news_promotions_image_url) }}" id="{{$news_promotionsid}}" data="{{$compact_model_val->news_promotions_image_url}}" style="height:120px; width:200px"/> 
                      </a>
                        </div>
                     
                   @else
                       
              <div class="col">
                           
                         <label for="exampleInputEmail1">@if ($service_menu_translations['choose_image']) {{$service_menu_translations['choose_image']}} @else Choose Image @endif</label>    
                     <input type="file" name="filename[]" id="filename[]" class="form-control" required="required">
                        
 
                 </div>
           @endif

        

          </div>
 

                   

                  <!-- <div class="form-group"> -->
       <div class="form-row">
            <div class="col col-sm-12">
             <label for="exampleInputEmail1">@if ($service_menu_translations['title']) {{$service_menu_translations['title']}} @else Title @endif</label> 
                    <input type="text" class="form-control" id="news_promotions_title" name="news_promotions_title" placeholder="@if ($service_menu_translations['title']) {{$service_menu_translations['title']}} @else Title @endif" required="required" @if($compact_model_val->news_promotions_title) value="{{ $compact_model_val->news_promotions_title }}"@endif >
            </div>
           
          
          </div>
                  
           <div class="form-row">
            <div class="col col-sm-12">
             <label>@if ($service_menu_translations['select_type']) {{$service_menu_translations['select_type']}} @else Select Type @endif</label>
                        <select class="form-control" name="news_promotions_type" id="news_promotions_type">
                          <option selected="selected" value="">@if ($service_menu_translations['select_type']) {{$service_menu_translations['select_type']}} @else Select Type @endif</option>
                          
              
              <option value="1" @if($compact_model_val->news_promotions_type == 1)  selected="selected" @endif>News</option>
              <option value="2" @if($compact_model_val->news_promotions_type == 2)  selected="selected" @endif>Promotions</option>
              
        
                        </select>
           
          </div>
          </div>
            
           <div class="form-row">
            <div class="col col-sm-12">
             <label for="exampleInputEmail1">@if ($service_menu_translations['description']) {{$service_menu_translations['description']}} @else Description @endif</label>
                    <textarea class="form-control" rows="6" id="news_promotions_description" name="news_promotions_description" placeholder="@if ($service_menu_translations['description']) {{$service_menu_translations['description']}} @else Description @endif" required="">@if($compact_model_val->news_promotions_description) {{ $compact_model_val->news_promotions_description }} @endif </textarea>
            </div>
          
          </div>

           <div class="form-row">
           
            <div class="col">
            <label for="exampleInputEmail1">@if ($service_menu_translations['start_date']) {{$service_menu_translations['start_date']}} @else Start Date @endif</label>
                   <input class="form-control" type="text" placeholder="@if ($service_menu_translations['start_date']) {{$service_menu_translations['start_date']}} @else Start Date @endif" id="start_date" name="start_date" @if($compact_model_val->start_date) value="{{ $compact_model_val->start_date }}"@endif>

            </div>

             <div class="col">
             <label for="exampleInputEmail1">@if ($service_menu_translations['end_date']) {{$service_menu_translations['end_date']}} @else End Date @endif</label>
                  <input class="form-control" type="text" placeholder="@if ($service_menu_translations['end_date']) {{$service_menu_translations['end_date']}} @else End Date @endif" id="end_date" name="end_date" @if($compact_model_val->end_date) value="{{ $compact_model_val->end_date }}"@endif>
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
  <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">              
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">@if ($service_menu_translations['btn_close']) {{$service_menu_translations['btn_close']}} @else Close @endif</span></button>
        <img src="" class="imagepreview" style="width: 100%;" >
      </div>
       <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">@if ($service_menu_translations['btn_close']) {{$service_menu_translations['btn_close']}} @else Close @endif</button>
          <button type="button" class="btn btn-primary" id="delete" onclick="return deleteItemnewspromotionsimage(this)">@if ($service_menu_translations['btn_delete']) {{$service_menu_translations['btn_delete']}} @else Delete @endif </button>
        </div>
    </div>
  </div>
</div>
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
