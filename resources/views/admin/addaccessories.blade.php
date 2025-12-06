    <div class="alert alert-success" style="display:none"></div>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h6 class="m-0 text-dark"></h6>
          </div>
         
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> Home</a></li>
              <li class="breadcrumb-item"><a href="#">Specs</a></li>
              <li class="breadcrumb-item active">Add Accessory</li>
            </ol>
          </div>
          <div class="col-sm-6">
            <h6 class="m-0 text-dark"></h6>
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
                <h3 class="card-title">Add Accessory</h3>
              </div>
              <form role="form" method="post" action="{{route('saveaccessories')}}" enctype="multipart/form-data" >
                @csrf
                <input class="form-control" type="hidden" name="car_owned_type" id="car_owned_type" value="0">
                <input class="form-control" type="hidden" name="main_model_id_enc" id="main_model_id_enc" value="1">
                <div class="card-body">
                    <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Brand</label>
              <select class="form-control" name="main_brand_id" id="main_brand_id" required="required">
                          <option selected="selected" value="">Select Brand</option>
                          @foreach ($compact_val as $item)
              <option value="{{ $item->id }}"> {{ strtoupper($item->main_brand_name) }} </option>
              @endforeach
                        </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Model</label>
                  <select class="form-control" name="main_model_id" id="main_model_id" required="required">
                          <option selected="selected" value="">Select Model</option>
                          @foreach ($compact_model_val as $item)
              <option value="{{ $item->id }}"> {{ strtoupper($item->model_name) }} </option>
              @endforeach
                        </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Version</label>
               <select class="form-control" name="main_version_id" id="main_version_id" required="required">
                          <option selected="selected" value="">Select Version</option>
                          @foreach ($compact_version_val as $item)
              <option value="{{ $item->id }}"> {{ strtoupper($item->version_name) }} </option>
              @endforeach
                        </select>
            </div>
          </div>
        </div>
                    
          <div class="col-md-12">
            
            <div class="row file-upload-box-wrapper">
              <div class="col-md-12">
                <label for="">Upload File</label>
              </div>
              <div class="col-md-4  file-upload-box">
                <div class="text-right">
                  <a href="#" class="cancel-entry btn btn-sm text-danger font-18"><i class="fa fa-times-circle"></i></a>
                </div>
                <div class="form-group text-center">
                  <img src="{{ asset('img/choose-img-default.png') }}" class="m-3" alt="">
                  <div class="input-group">
                    <!-- <input type="file" id="files" class="hidden"/> -->

                      <!-- <label class="custom-file-label" for="">Choose file</label> -->
                      <input type="file"   class="form-control mt-2 hidden" id="filename" name="filename[]"  required="required">
                      <label for="filename custom-file-label"> </label>
                      <!-- <label class="custom-file-label" for="">Choose file</label> -->
                    </div>
                 
 
                  <input type="text" class="form-control mt-2" id="accessories_title" name="accessories_title[]" placeholder="Enter Title" required="required">
 <input type="text" class="form-control mt-2" id="accessories_description" name="accessories_description[]" placeholder="Enter Description" required="required">
 <input type="number" class="form-control mt-2" id="price" name="price[]" placeholder="Enter Price" required="required">
 
                  <label for="" class="form-control mt-2 text-left font-weight-normal"><input type="checkbox" class="mr-2" name="showprice[]"> Show Price</label>
                </div>
              </div>
              
              <div class="col-md-1 add-file-upload-btn d-flex justify-content-center align-items-center cursor-pointer border">
                <h5 class=""><i class="fa fa-plus"></i></h5>
              </div>
            </div>
          </div>
       
         <div style="padding-top: 15px;"></div>
                
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="submit" class="btn btn-primary">Cancel</button>
                </div>
              </form>
                 
                      </div>
         
         
         
      
      
      
    
    

         
            </div>
          
           
          </div>
         
        </div>
      </div>
    </section>

 
     
 