<<<<<<< HEAD
 
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Customer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> Home</a></li>
              <li class="breadcrumb-item"><a href="#">Customers</a></li>
              <li class="breadcrumb-item active">Edit Customer</li>
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
                <h3 class="card-title">Edit Customer</h3>
              </div>
              <form role="form" method="post" action="{{route('updatecustomer')}}" enctype="multipart/form-data">
                @csrf
                  <input type="hidden" class="form-control" id="customer_id" name="customer_id" @if($customer_id) value="{{ $customer_id }}"@endif> 
                  
                   <input type="hidden" class="form-control" id="call_backurl" name="call_backurl" value="customers">

          

                   <input type="hidden" class="form-control" id="brand_id" name="brand_id" value="{{ $customer_info->brand_id }}">
                   
                   <input type="hidden" class="form-control" id="model_id" name="model_id" value="{{ $customer_info->model_id }}">
                  <!-- </div> -->
                <div class="card-body">
                
                  <div class="form-group">
                    <label for="exampleInputEmail1">User Name</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter User Name" required="required" 
                    @if($customer_info->username) value="{{ $customer_info->username }}"@endif>
                  </div>

                  <div class="form-row">
                    <div class="col">
                    <label for="exampleInputEmail1"> Emirate </label>
                    <select class="form-control" name="category_dropdown" id="category_dropdown" required="required">
                          <option selected="selected" value="">Select Emirate</option>
                          
                          @foreach ($category_dropdown as $item)
                          <option value="{{ $item}}" @if($customer_info->category_dropdown == $item) selected  @endif>{{ strtoupper($item)}}</option>
                          @endforeach
        
                        </select>
                  </div>
                  <div class="col">
                    <label for="exampleInputEmail1"> Category</label>
                    <input type="text" class="form-control" id="category_number" name="category_number" placeholder="Enter Category" required="required"
                    @if($customer_info->category_number) value="{{ $customer_info->category_number }}"@endif>
                  </div>
                  <div class="col">
                    <label for="exampleInputEmail1"> Car Reg Number</label>
                    <input type="text" class="form-control" id="car_registration_number" name="car_registration_number" placeholder="Enter Car Reg No" required="required"
                    @if($customer_info->car_registration_number) value="{{ $customer_info->car_registration_number }}"@endif>
                  </div>
                </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Chasis No </label>
                    <input type="text" class="form-control" id="reg_chasis_number" name="reg_chasis_number" placeholder="Enter Chasis No" required="required" 
                    @if($customer_info->reg_chasis_number) value="{{ $customer_info->reg_chasis_number }}"@endif>
                  </div>
         

               
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                  <button type="submit" class="btn btn-primary">Cancel</button>
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
          <button type="button" class="btn btn-primary" id="delete" onclick="return deleteItemmodelimage(this)">Delete</button>
        </div>
    </div>
  </div>
</div>
=======
 
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Customer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> Home</a></li>
              <li class="breadcrumb-item"><a href="#">Customers</a></li>
              <li class="breadcrumb-item active">Edit Customer</li>
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
                <h3 class="card-title">Edit Customer</h3>
              </div>
              <form role="form" method="post" action="{{route('updatecustomer')}}" enctype="multipart/form-data">
                @csrf
                  <input type="hidden" class="form-control" id="customer_id" name="customer_id" @if($customer_id) value="{{ $customer_id }}"@endif> 
                  
                   <input type="hidden" class="form-control" id="call_backurl" name="call_backurl" value="customers">

          

                   <input type="hidden" class="form-control" id="brand_id" name="brand_id" value="{{ $customer_info->brand_id }}">
                   
                   <input type="hidden" class="form-control" id="model_id" name="model_id" value="{{ $customer_info->model_id }}">
                  <!-- </div> -->
                <div class="card-body">
                
                  <div class="form-group">
                    <label for="exampleInputEmail1">User Name</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter User Name" required="required" 
                    @if($customer_info->username) value="{{ $customer_info->username }}"@endif>
                  </div>

                  <div class="form-row">
                    <div class="col">
                    <label for="exampleInputEmail1"> Emirate </label>
                    <select class="form-control" name="category_dropdown" id="category_dropdown" required="required">
                          <option selected="selected" value="">Select Emirate</option>
                          
                          @foreach ($category_dropdown as $item)
                          <option value="{{ $item}}" @if($customer_info->category_dropdown == $item) selected  @endif>{{ strtoupper($item)}}</option>
                          @endforeach
        
                        </select>
                  </div>
                  <div class="col">
                    <label for="exampleInputEmail1"> Category</label>
                    <input type="text" class="form-control" id="category_number" name="category_number" placeholder="Enter Category" required="required"
                    @if($customer_info->category_number) value="{{ $customer_info->category_number }}"@endif>
                  </div>
                  <div class="col">
                    <label for="exampleInputEmail1"> Car Reg Number</label>
                    <input type="text" class="form-control" id="car_registration_number" name="car_registration_number" placeholder="Enter Car Reg No" required="required"
                    @if($customer_info->car_registration_number) value="{{ $customer_info->car_registration_number }}"@endif>
                  </div>
                </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Chasis No </label>
                    <input type="text" class="form-control" id="reg_chasis_number" name="reg_chasis_number" placeholder="Enter Chasis No" required="required" 
                    @if($customer_info->reg_chasis_number) value="{{ $customer_info->reg_chasis_number }}"@endif>
                  </div>
         

               
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                  <button type="submit" class="btn btn-primary">Cancel</button>
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
          <button type="button" class="btn btn-primary" id="delete" onclick="return deleteItemmodelimage(this)">Delete</button>
        </div>
    </div>
  </div>
</div>
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
