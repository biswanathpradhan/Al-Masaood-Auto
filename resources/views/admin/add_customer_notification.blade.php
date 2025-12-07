 
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 class="m-0 text-dark">Add Model</h1> -->
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> Home</a></li>
              <li class="breadcrumb-item"><a href="#">Users</a></li>
              <li class="breadcrumb-item active">Add Notification</li>
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
                <h3 class="card-title">Add Notification</h3>
              </div>
              <form role="form" method="post" action="{{route('savecustomernotification')}}" enctype="multipart/form-data">
                @csrf
                
                    <input type="hidden" class="form-control" id="car_owned_type" name="car_owned_type" value="0">
                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="0">
                    <input type="hidden" class="form-control" id="customer_id" name="customer_id" value="{{$customer_id}}">
                 
                <div class="card-body">
                 <div class="row">
                        <div class="col-md-6">
            <div class="form-group">
              <label for="">Name :</label>
              {{$name}}
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Mobile : </label>
                    {{$mobile_number}}
            </div>
          </div>
                  </div>
                  
                <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Upload File</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" name="notify_image" id="notify_image" class="custom-file-input" id="exampleInputFile">
                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                </div>
                <div class="input-group-append"> <span class="input-group-text" id="">Upload</span> </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Title</label>
              <input type="text" name="title" id="title" required="required"  class="form-control">
              <br/>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Description</label>
              <textarea class="form-control" name="description" id="description" cols="30" rows="10" required="required"></textarea>
            </div>
          </div>
        </div>

       <!--  <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" id="customCheckbox2" checked>
                <label for="customCheckbox2" class="custom-control-label">Push Enable/Disable:</label>
              </div>
             </div>
          </div>
        </div> -->


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
 