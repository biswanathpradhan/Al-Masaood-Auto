
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">All Avail Offers User List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> Home</a></li>
              <li class="breadcrumb-item active">Avail Offers User List</li>
            </ol>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-md-4">
            <div class="form-group">
              <label>Minimal</label>
              <select class="form-control select2" name="model_id_filter" id="model_id_filter">
                <option selected="selected" value="4">All</option>
                <option value="1">NISSAN</option>
                <option value="2">RENAULT</option>
                <option value="3">INFINITI</option>
              </select>
            </div>
          </div>

         
     <!--      <div class="col-md-8" align="right"><br>
            <a class="btn bg-info"> <i class="fas fa-file-excel"></i> Generate Excel </a> </div> -->
        </div>
      </div>
    </div>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary card-outline">
            <div class="card-body">
              <table id="example23" class="table table-bordered table-striped common-datatable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Car Reg.</th>
                    <th>Chassis No/ VIN No</th>
                    <th width="10%">On</th>
                    <th width="10%">Description</th>
                    <th width="10%">Status</th>
                    <th width="3%">Comment</th>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
           <tfoot>
                  <tr>
                     
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
 
    <div class="modal fade" id="commentmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">              
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <textarea id="comment" name="comment"  class="comment" style="width: 100%;" required="required">  </textarea>
         <input type="hidden" class="form-control" id="fk_availoffer_id" name="fk_availoffer_id">
          <input type="hidden" class="form-control" id="fk_user_id" name="fk_user_id">
          <input type="hidden" class="form-control" id="insurance_comments_show" name="insurance_comments_show">
         
       
       <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="addcomment" data-availoffer="" data-user="" onclick="return UpdateAvailoffersComment(this)">Add</button>
        </div>
         <div class="card-body" id="cardbodycomments">

          </div>
    </div>
  </div>
</div>
