<<<<<<< HEAD
 
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 class="m-0 text-dark">Add Model</h1> -->
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> Home</a></li>
              <li class="breadcrumb-item"><a href="#">Notifications</a></li>
              <li class="breadcrumb-item active">Edit Notification</li>
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
                <h3 class="card-title">Edit Notification</h3>
              </div>
              <form role="form" method="post" action="{{route('updatenotification')}}" enctype="multipart/form-data">
                @csrf
                
                    <input type="hidden" class="form-control" id="car_owned_type" name="car_owned_type" value="0">
                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="0">
                    <input type="hidden" class="form-control" id="notification_id" name="notification_id" value="{{$notification_id}}">
                 
                <div class="card-body">
                 <div class="row">
                        <div class="col-md-6">
            <div class="form-group">
              <label for="">Brand</label>
              <select class="form-control" name="main_brand_id" id="main_brand_id" required="required">
                          <option selected="selected" value="">Select Brand</option>
                          <option value="All" @if($get_model->main_brand_id == 'All') selected="selected" @endif>All</option>
                          @foreach ($compact_val as $item)
              <option value="{{ $item->id }}" @if($get_model->main_brand_id == $item->id) selected="selected" @endif> {{ strtoupper($item->main_brand_name) }} </option>
              @endforeach
                        </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Model</label>
                  <select class="form-control" name="main_model_id" id="main_model_id" required="required">
                          <option selected="selected" value="">Select Model</option>
                          @foreach ($compact_model_val as $item)
              <option value="{{ $item->id }}" @if($get_model->main_model_id == $item->id) selected="selected" @endif> {{ strtoupper($item->model_name) }} </option>
              @endforeach
                        </select>
            </div>
          </div>
                  </div>
                  
                <div class="row">
          <div class="col-md-6">


            <div class="form-group">
              <label for="">Upload File</label>
             
                 @if($get_model->notify_image != '')
                  <div class="input-group">
                     <a href="#" class="pop">
                 <img src="{{ asset('/images/notifications/'.$get_model->notify_image) }}" id="{{$get_model->id}}" name="notify_imageshow"  style="height:120px; width:200px"/>
               </a>
                 </div>
                 @else
                   <div class="input-group">
                  <div class="custom-file">

                  <input type="file" name="notify_image" id="notify_image" class="custom-file-input" id="exampleInputFile">
                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                </div>
                <div class="input-group-append"> <span class="input-group-text" id="">Upload</span> </div>
              </div>
                 @endif
               
            </div>


          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Title</label>
              <input type="text" name="title" id="title" required="required"  class="form-control" value="{{$get_model->title}}">
              <br/>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Description</label>
              <textarea class="form-control" name="description" id="description" cols="30" rows="10" required="required">{{$get_model->description}}</textarea>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" id="customCheckbox2" checked>
                <label for="customCheckbox2" class="custom-control-label">Push Enable/Disable:</label>
              </div>
             </div>
          </div>
        </div>


                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="button" onclick="window.history.back()" class="btn btn-primary">Cancel</button>
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
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="delete" onclick="return deleteNotificationItem(this)">Delete</button>
        </div>
    </div>
  </div>
</div>
=======
 
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 class="m-0 text-dark">Add Model</h1> -->
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> Home</a></li>
              <li class="breadcrumb-item"><a href="#">Notifications</a></li>
              <li class="breadcrumb-item active">Edit Notification</li>
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
                <h3 class="card-title">Edit Notification</h3>
              </div>
              <form role="form" method="post" action="{{route('updatenotification')}}" enctype="multipart/form-data">
                @csrf
                
                    <input type="hidden" class="form-control" id="car_owned_type" name="car_owned_type" value="0">
                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="0">
                    <input type="hidden" class="form-control" id="notification_id" name="notification_id" value="{{$notification_id}}">
                 
                <div class="card-body">
                 <div class="row">
                        <div class="col-md-6">
            <div class="form-group">
              <label for="">Brand</label>
              <select class="form-control" name="main_brand_id" id="main_brand_id" required="required">
                          <option selected="selected" value="">Select Brand</option>
                          <option value="All" @if($get_model->main_brand_id == 'All') selected="selected" @endif>All</option>
                          @foreach ($compact_val as $item)
              <option value="{{ $item->id }}" @if($get_model->main_brand_id == $item->id) selected="selected" @endif> {{ strtoupper($item->main_brand_name) }} </option>
              @endforeach
                        </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Model</label>
                  <select class="form-control" name="main_model_id" id="main_model_id" required="required">
                          <option selected="selected" value="">Select Model</option>
                          @foreach ($compact_model_val as $item)
              <option value="{{ $item->id }}" @if($get_model->main_model_id == $item->id) selected="selected" @endif> {{ strtoupper($item->model_name) }} </option>
              @endforeach
                        </select>
            </div>
          </div>
                  </div>
                  
                <div class="row">
          <div class="col-md-6">


            <div class="form-group">
              <label for="">Upload File</label>
             
                 @if($get_model->notify_image != '')
                  <div class="input-group">
                     <a href="#" class="pop">
                 <img src="{{ asset('/images/notifications/'.$get_model->notify_image) }}" id="{{$get_model->id}}" name="notify_imageshow"  style="height:120px; width:200px"/>
               </a>
                 </div>
                 @else
                   <div class="input-group">
                  <div class="custom-file">

                  <input type="file" name="notify_image" id="notify_image" class="custom-file-input" id="exampleInputFile">
                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                </div>
                <div class="input-group-append"> <span class="input-group-text" id="">Upload</span> </div>
              </div>
                 @endif
               
            </div>


          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Title</label>
              <input type="text" name="title" id="title" required="required"  class="form-control" value="{{$get_model->title}}">
              <br/>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Description</label>
              <textarea class="form-control" name="description" id="description" cols="30" rows="10" required="required">{{$get_model->description}}</textarea>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" id="customCheckbox2" checked>
                <label for="customCheckbox2" class="custom-control-label">Push Enable/Disable:</label>
              </div>
             </div>
          </div>
        </div>


                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="button" onclick="window.history.back()" class="btn btn-primary">Cancel</button>
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
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="delete" onclick="return deleteNotificationItem(this)">Delete</button>
        </div>
    </div>
  </div>
</div>
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
