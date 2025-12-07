<<<<<<< HEAD
<?php 
$language_id = Session::get('language_id');
$manage_users_translations = getbackendTranslations('manage_users',null,$language_id);
$breadcrumb_translations = getbackendTranslations('breadcrumb ',null,$language_id);
// breadcrumb_admin_manage
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
              <li class="breadcrumb-item"><a href="#">@if ($breadcrumb_translations['breadcrumb_admin_manage']) {{$breadcrumb_translations['breadcrumb_admin_manage']}} @else Admin Manage @endif</a></li>
              <li class="breadcrumb-item active">@if ($manage_users_translations['edit_user']) {{$manage_users_translations['edit_user']}} @else Edit User @endif</li>
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
                <h3 class="card-title">@if ($manage_users_translations['edit_user']) {{$manage_users_translations['edit_user']}} @else Edit User @endif</h3>
              </div>
              <form role="form" method="post" action="{{route('updateuser')}}" enctype="multipart/form-data">
                @csrf
                  <input type="hidden" class="form-control" id="id" name="id" @if($user->id) value="{{ $user->id }}"@endif>
                <div class="card-body">
              
                      
                  <!-- <div class="form-group"> -->
         
            <div class="form-row">
            <div class="col">
                  
  <div class="dropdown">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> @if ($manage_users_translations['roles']) {{$manage_users_translations['roles']}} @else Roles @endif  <span class="caret"></span></button>
  <ul class="dropdown-content checkbox-menu" style="top: auto;">

<?php $i=0; while ( count($roles) > $i) {
  // $module_access = json_encode($user->module_access);
  // dd( $user->module_access,$roles[$i]['role_id']);
  if(isset($user->module_access) && serialize($user->module_access))
  {
       $role_ids=unserialize($user->module_access);
 
     
  if (in_array($roles[$i]['role_id'], $role_ids))
    {
      $checked = "checked";
    }
    else
    {
      $checked = "";
    }
  }
 

 ?>
  <li> <label><input  class="form-check-label" name="role_id[]" value="<?php  echo  $roles[$i]['role_id']; ?>" type="checkbox" <?php echo $checked; ?>  />&nbsp;<?php  echo  $roles[$i]['menu_name']; ?></label></li>

 


   

<?php  $i++; } ?>
 
</ul>
  </div>

                </div>
                </div>
                  
         
       
         
         <div class="form-row">
           
            <div class="col">
              <label for="exampleInputEmail1"> @if ($manage_users_translations['email']) {{$manage_users_translations['email']}} @else Email @endif</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="@if ($manage_users_translations['email']) {{$manage_users_translations['email']}} @else Email @endif" required="required" @if($user->email) value="{{ $user->email }}" @endif>
            </div>
          </div>
          <div class="form-row">
 
            <div class="col">
              <label for="exampleInputEmail1"> @if ($manage_users_translations['password']) {{$manage_users_translations['password']}} @else Password @endif</label>
              <input type="password" class="form-control" id="password{{$user->id}}" name="password" placeholder="@if ($manage_users_translations['password']) {{$manage_users_translations['password']}} @else Password @endif" required="required" @if($user->password) value="{{ $user->password_plain }}" @endif>  
            </div>
          </div>
          <div class="form-row" style="padding-top: 15px;">
 
            <div class="col">
               <input type="checkbox" id="checkboxreveal" onclick="return myFunction({{$user->id}})" >  
               <label for="checkboxreveal" style="font-weight: 500;"> Show Password </label>
            </div>
          </div>
          <div style="padding-top: 15px;"></div>
                <div class="">
                  <button type="submit" class="btn btn-primary">@if ($manage_users_translations['btn_submit']) {{$manage_users_translations['btn_submit']}} @else Submit @endif</button>
                  <button  type="button" onclick="window.history.back()" class="btn btn-primary">@if ($manage_users_translations['btn_cancel']) {{$manage_users_translations['btn_cancel']}} @else Cancel @endif</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
 <style type="text/css">
   .checkbox-menu li label {
    display: block;
    padding: 3px 10px;
    clear: both;
    font-weight: normal;
    line-height: 1.42857143;
    color: #333;
    white-space: nowrap;
    margin:0;
    transition: background-color .4s ease;
}
.checkbox-menu li input {
    margin: 0px 5px;
    top: 2px;
    position: relative;
}

.checkbox-menu li.active label {
    background-color: #cbcbff;
    font-weight:bold;
}

.checkbox-menu li label:hover,
.checkbox-menu li label:focus {
    background-color: #f5f5f5;
}

.checkbox-menu li.active label:hover,
.checkbox-menu li.active label:focus {
    background-color: #b8b8ff;
}
   
  .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 150px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 100;
           list-style-type: none;
           padding: inherit;
           height:400px;
           overflow:auto;
           border: 1px solid rgba(0, 0, 0, 0.125);
        }

        .dropdown-content label {
            display: block;
        }

        .dropdown-content label input[type="checkbox"] {
            margin-right: 5px;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
       
 </style>
 <script>
   
    const selectAllCheckbox = document.getElementById("select-all");
    const checkboxes = document.querySelectorAll(".dropdown-content input[type='checkbox']");

   
   
    selectAllCheckbox.addEventListener("change", function () {
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = selectAllCheckbox.checked;
        });
    });
=======
<?php 
$language_id = Session::get('language_id');
$manage_users_translations = getbackendTranslations('manage_users',null,$language_id);
$breadcrumb_translations = getbackendTranslations('breadcrumb ',null,$language_id);
// breadcrumb_admin_manage
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
              <li class="breadcrumb-item"><a href="#">@if ($breadcrumb_translations['breadcrumb_admin_manage']) {{$breadcrumb_translations['breadcrumb_admin_manage']}} @else Admin Manage @endif</a></li>
              <li class="breadcrumb-item active">@if ($manage_users_translations['edit_user']) {{$manage_users_translations['edit_user']}} @else Edit User @endif</li>
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
                <h3 class="card-title">@if ($manage_users_translations['edit_user']) {{$manage_users_translations['edit_user']}} @else Edit User @endif</h3>
              </div>
              <form role="form" method="post" action="{{route('updateuser')}}" enctype="multipart/form-data">
                @csrf
                  <input type="hidden" class="form-control" id="id" name="id" @if($user->id) value="{{ $user->id }}"@endif>
                <div class="card-body">
              
                      
                  <!-- <div class="form-group"> -->
         
            <div class="form-row">
            <div class="col">
                  
  <div class="dropdown">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> @if ($manage_users_translations['roles']) {{$manage_users_translations['roles']}} @else Roles @endif  <span class="caret"></span></button>
  <ul class="dropdown-content checkbox-menu" style="top: auto;">

<?php $i=0; while ( count($roles) > $i) {
  // $module_access = json_encode($user->module_access);
  // dd( $user->module_access,$roles[$i]['role_id']);
  if(isset($user->module_access) && serialize($user->module_access))
  {
       $role_ids=unserialize($user->module_access);
 
     
  if (in_array($roles[$i]['role_id'], $role_ids))
    {
      $checked = "checked";
    }
    else
    {
      $checked = "";
    }
  }
 

 ?>
  <li> <label><input  class="form-check-label" name="role_id[]" value="<?php  echo  $roles[$i]['role_id']; ?>" type="checkbox" <?php echo $checked; ?>  />&nbsp;<?php  echo  $roles[$i]['menu_name']; ?></label></li>

 


   

<?php  $i++; } ?>
 
</ul>
  </div>

                </div>
                </div>
                  
         
       
         
         <div class="form-row">
           
            <div class="col">
              <label for="exampleInputEmail1"> @if ($manage_users_translations['email']) {{$manage_users_translations['email']}} @else Email @endif</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="@if ($manage_users_translations['email']) {{$manage_users_translations['email']}} @else Email @endif" required="required" @if($user->email) value="{{ $user->email }}" @endif>
            </div>
          </div>
          <div class="form-row">
 
            <div class="col">
              <label for="exampleInputEmail1"> @if ($manage_users_translations['password']) {{$manage_users_translations['password']}} @else Password @endif</label>
              <input type="password" class="form-control" id="password{{$user->id}}" name="password" placeholder="@if ($manage_users_translations['password']) {{$manage_users_translations['password']}} @else Password @endif" required="required" @if($user->password) value="{{ $user->password_plain }}" @endif>  
            </div>
          </div>
          <div class="form-row" style="padding-top: 15px;">
 
            <div class="col">
               <input type="checkbox" id="checkboxreveal" onclick="return myFunction({{$user->id}})" >  
               <label for="checkboxreveal" style="font-weight: 500;"> Show Password </label>
            </div>
          </div>
          <div style="padding-top: 15px;"></div>
                <div class="">
                  <button type="submit" class="btn btn-primary">@if ($manage_users_translations['btn_submit']) {{$manage_users_translations['btn_submit']}} @else Submit @endif</button>
                  <button  type="button" onclick="window.history.back()" class="btn btn-primary">@if ($manage_users_translations['btn_cancel']) {{$manage_users_translations['btn_cancel']}} @else Cancel @endif</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
 <style type="text/css">
   .checkbox-menu li label {
    display: block;
    padding: 3px 10px;
    clear: both;
    font-weight: normal;
    line-height: 1.42857143;
    color: #333;
    white-space: nowrap;
    margin:0;
    transition: background-color .4s ease;
}
.checkbox-menu li input {
    margin: 0px 5px;
    top: 2px;
    position: relative;
}

.checkbox-menu li.active label {
    background-color: #cbcbff;
    font-weight:bold;
}

.checkbox-menu li label:hover,
.checkbox-menu li label:focus {
    background-color: #f5f5f5;
}

.checkbox-menu li.active label:hover,
.checkbox-menu li.active label:focus {
    background-color: #b8b8ff;
}
   
  .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 150px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 100;
           list-style-type: none;
           padding: inherit;
           height:400px;
           overflow:auto;
           border: 1px solid rgba(0, 0, 0, 0.125);
        }

        .dropdown-content label {
            display: block;
        }

        .dropdown-content label input[type="checkbox"] {
            margin-right: 5px;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
       
 </style>
 <script>
   
    const selectAllCheckbox = document.getElementById("select-all");
    const checkboxes = document.querySelectorAll(".dropdown-content input[type='checkbox']");

   
   
    selectAllCheckbox.addEventListener("change", function () {
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = selectAllCheckbox.checked;
        });
    });
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
</script>