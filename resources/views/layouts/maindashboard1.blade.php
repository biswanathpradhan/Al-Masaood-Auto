<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Al Masaood Auto | Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}" />

<?php 
$language_id = Session::get('language_id');
$menu_translations = getbackendTranslations('menu',null,$language_id);
 
 
if($language_id == 2)
{
?>
 <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('fonts/ionicons.min.css') }}">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('arabic/plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('arabic/fonts/ionicons.min.css') }}">
<link rel="stylesheet" href="{{ asset('arabic/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('arabic/css/adminlte.css') }}">
<link rel="stylesheet" href="{{ asset('arabic/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
<?php 
$language_trans ="//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json";
}
else
{
 
?>
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('fonts/ionicons.min.css') }}">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('fonts/ionicons.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

<?php 
$language_trans = "https://cdn.datatables.net/plug-ins/1.10.24/i18n/English.json";
}
?>

<!-- <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet"> -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/css/bootstrap-datepicker.css">
    <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css" rel="stylesheet">

    <style> 
        #loader { 
            border: 12px solid #f3f3f3; 
            border-radius: 50%; 
            border-top: 12px solid #444444; 
            width: 70px; 
            height: 70px; 
            animation: spin 1s linear infinite; 
        } 
          
        @keyframes spin { 
            100% { 
                transform: rotate(360deg); 
            } 
        } 
          
        .center { 
            position: absolute; 
            top: 0; 
            bottom: 0; 
            left: 0; 
            right: 0; 
            margin: auto; 
        } 
      html,body
      {
      width: 100%;
      height: 100%;
      margin: 0px;
      padding: 0px;
      overflow-x: hidden; 
      }

.commenttitle .date { float:right }
.commenttitle .name { float:left }
.alert {
  margin-bottom: 1px;
  height: 30px;
  line-height:30px;
  padding:0px 15px;
}

.nav-sidebar{
  position: relative;
  padding-bottom: 50px !important;
}
.hide{
  display:none;  
}
    </style> 
</head>
<body class="hold-transition sidebar-mini layout-fixed" display='none'>

 
  <aside class="main-sidebar sidebar-dark-primary elevation-4"> <a href="#" class="brand-link bg-alm-blue"> <img src="{{ asset('img/almasood logo-02.png') }}" alt="Al Masaood Auto" class="img-fluid"> </a>
    <div class="sidebar">
      <div id="loader" class="center"></div> 
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @if(in_array("1",getUserAccessDetails()))

            <li class="nav-item">
        <a href="/admin/dashboard" @if (Route::current()->getName() == "dashboard") class="nav-link active" @else class="nav-link" @endif>
          <i class="nav-icon fa fa-tachometer-alt"></i>
          <p>@if ($menu_translations['menu_dashboard']) {{$menu_translations['menu_dashboard']}} @else Dashboard @endif </p>
        </a>
      </li>
      @endif
      @if(in_array("2",getUserAccessDetails()))
          <li class="nav-item"> <a href="/admin/customers" class="nav-link"> <i class="nav-icon fa fa-envelope"></i>
            <p>@if ($menu_translations['menu_chat']) {{$menu_translations['menu_chat']}} @else Dashboard @endif</p>
            </a> </li>
               @endif
               @if(in_array("5",getUserAccessDetails()))
          <li class="nav-item"> <a href="/admin/emergencycall" @if (Route::current()->getName() == "emergencycall") class="nav-link active" @else class="nav-link" @endif> <i class="nav-icon fa fa-phone-square"></i>
            <p>@if ($menu_translations['menu_emergency_call']) {{$menu_translations['menu_emergency_call']}} @else Emergency Call @endif</p>
            </a> </li>
            @endif
            @if(in_array("6",getUserAccessDetails()))
          <li class="nav-item"> <a href="/admin/callbackrequest" @if (Route::current()->getName() == "callbackrequest") class="nav-link active" @else class="nav-link" @endif> <i class="nav-icon fa fa-phone-square"></i>
            <p>@if ($menu_translations['menu_callback_request']) {{$menu_translations['menu_callback_request']}} @else Callback Request @endif</p>
            </a> </li>
                 @endif
                 @if(in_array("7",getUserAccessDetails()))
             <li class="nav-item"> <a href="/admin/insurancerequest" @if (Route::current()->getName() == "insurancerequest") class="nav-link active" @else class="nav-link" @endif> <i class="nav-icon fa fa-flag"></i>
            <p>@if ($menu_translations['menu_insurance_request']) {{$menu_translations['menu_insurance_request']}} @else Insurance Request @endif</p>
            </a> </li>@endif
             @if(in_array("8",getUserAccessDetails()))
             <li class="nav-item"> <a href="/admin/accessoryrequest" @if (Route::current()->getName() == "accessoryrequest") class="nav-link active" @else class="nav-link" @endif> <i class="nav-icon fa fa-flag"></i>
            <p>@if ($menu_translations['menu_accessory_request']) {{$menu_translations['menu_accessory_request']}} @else Accessory Request @endif</p>
            </a> </li>
           @endif
      @if(in_array("9",getUserAccessDetails()))
     <li class="nav-item">
        <a href="/admin/manageusers" @if (Route::current()->getName() == "manageusers") class="nav-link active" @else class="nav-link" @endif>
          <i class="nav-icon ion ion-person-add"></i><p>@if ($menu_translations['menu_manage_users']) {{$menu_translations['menu_manage_users']}} @else Managing Users @endif </p>
        </a>
      </li>
      @endif

        <!--   <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon ion ion-person-add"></i>
            <p>Customers</p>
            </a> </li> -->
@if(in_array("10",getUserAccessDetails()))
            <li class="nav-item">
        <a href="/admin/customers" @if (Route::current()->getName() == "customers") class="nav-link active" @else class="nav-link" @endif>
          <i class="nav-icon ion ion-person-add"></i><p>@if ($menu_translations['menu_customers']) {{$menu_translations['menu_customers']}} @else Customers @endif</p>
        </a>
      </li>
   @endif
   @if(in_array("11",getUserAccessDetails()))
           <li class="nav-item">
        <a href="/admin/customercars" @if (Route::current()->getName() == "customercars") class="nav-link active" @else class="nav-link" @endif>
          <i class="nav-icon ion ion-person-add"></i><p>@if ($menu_translations['menu_customer_cars']) {{$menu_translations['menu_customer_cars']}} @else Customer Cars @endif</p>
        </a>
      </li>
        @endif
        @if(in_array("12",getUserAccessDetails()))
          <li class="nav-item"> <a href="/admin/onboarding" @if (Route::current()->getName() == "getonboarding") class="nav-link active" @else class="nav-link" @endif> <i class="nav-icon fa ion-easel"></i>
            <p>@if ($menu_translations['menu_onboarding_screens']) {{$menu_translations['menu_onboarding_screens']}} @else Onboarding Screens @endif</p> 
            </a> </li>
            @endif
            @if(in_array("13",getUserAccessDetails()))
          <li class="nav-item"><a href="/admin/getmodels/new" @if (Route::current()->getName() == "getnewcars") class="nav-link active" @else class="nav-link" @endif> <i class="nav-icon fa fa-car"></i>
            <p>@if ($menu_translations['menu_new_car_models']) {{$menu_translations['menu_new_car_models']}} @else New Car Models @endif</p>
            </a> </li>
            @endif
             @if(in_array("14",getUserAccessDetails()))
          <li class="nav-item"> <a href="/admin/getmodels/preowned" @if (Route::current()->getName() == "getpreownedcars") class="nav-link active" @else class="nav-link" @endif> <i class="nav-icon fa fa-car"></i>
            <p>@if ($menu_translations['menu_pre_owned_cars_models']) {{$menu_translations['menu_pre_owned_cars_models']}} @else Pre Owned Cars Models @endif</p>
            </a> </li> @endif

            @if(in_array("15",getUserAccessDetails()))

          <li class="nav-item"> <a href="/admin/corporatesolutions" @if (Route::current()->getName() == "getcorporatesolutionslist") class="nav-link active" @else class="nav-link" @endif> <i class="nav-icon fa fa-flag"></i>
            <p>@if ($menu_translations['menu_corporatesolutions']) {{$menu_translations['menu_corporatesolutions']}} @else Corporate Solutions @endif </p>
            </a> </li>

            @endif

            @if(in_array("16",getUserAccessDetails()))
          <li class="nav-item"> <a href="/admin/corporatesolutionsenquiry" @if (Route::current()->getName() == "getcorporatesolutionsenquirylist") class="nav-link active" @else class="nav-link" @endif> <i class="nav-icon fa fa-flag"></i>
            <p>@if ($menu_translations['menu_corporatesolutionsenquiry']) {{$menu_translations['menu_corporatesolutionsenquiry']}} @else Corporate Solutions Enquiry @endif </p>
            </a> </li>

            @endif
             @if(in_array("3",getUserAccessDetails()))
          <li class="nav-item"> <a href="/admin/servicemenu" @if (Route::current()->getName() == "getservicemenu") class="nav-link active" @else class="nav-link" @endif> <i class="nav-icon fa fa-flag"></i>
            <p>@if ($menu_translations['menu_servicemenu']) {{$menu_translations['menu_servicemenu']}} @else Service Menu @endif </p>
            </a> </li>
            @endif
            @if(in_array("4",getUserAccessDetails()))
          <li class="nav-item"> <a href="/admin/serviceneeded" @if (Route::current()->getName() == "getserviceneeded") class="nav-link active" @else class="nav-link" @endif> <i class="nav-icon fa fa-flag"></i>
            <p>@if ($menu_translations['menu_serviceneeded']) {{$menu_translations['menu_serviceneeded']}} @else Service Needed @endif</p>
            </a> </li>
             @endif
             @if(in_array("17",getUserAccessDetails()))
          <li class="nav-item"> <a href="/admin/servicepackges" @if (Route::current()->getName() == "getservicepackages") class="nav-link active" @else class="nav-link" @endif> <i class="nav-icon fa fa-flag"></i>
            <p>@if ($menu_translations['menu_servicepackages']) {{$menu_translations['menu_servicepackages']}} @else Service Packages @endif</p>
            </a> </li>
             @endif
              @if(in_array("18",getUserAccessDetails()))
          <li class="nav-item"> <a href="/admin/appointments" @if (Route::current()->getName() == "getappointments") class="nav-link active" @else class="nav-link" @endif> <i class="nav-icon fa fa-flag"></i>
            <p>@if ($menu_translations['menu_appointments']) {{$menu_translations['menu_appointments']}} @else Appointments @endif</p>
            </a> </li>
            @endif
            @if(in_array("19",getUserAccessDetails()))
          <li class="nav-item"> <a href="/admin/pickupcar" @if (Route::current()->getName() == "pickupcar") class="nav-link active" @else class="nav-link" @endif> <i class="nav-icon fa fa-flag"></i>
            <p>@if ($menu_translations['menu_pickup_car']) {{$menu_translations['menu_pickup_car']}} @else Pickup Car @endif</p>
            </a> </li>
             @endif
             @if(in_array("20",getUserAccessDetails()))
          <li class="nav-item">  <a href="/admin/newspromotions" @if (Route::current()->getName() == "getnewspromotions") class="nav-link active" @else class="nav-link" @endif> <i class="nav-icon fa fa-flag"></i>
            <p>@if ($menu_translations['menu_newspromotions']) {{$menu_translations['menu_newspromotions']}} @else  News &amp; Promotions @endif </p>
            </a> </li>
            @endif
            @if(in_array("21",getUserAccessDetails()))
          <li class="nav-item"> <a href="/admin/locationshowroom" @if (Route::current()->getName() == "locationshowroomlist") class="nav-link active" @else class="nav-link" @endif> <i class="nav-icon fa fa-flag"></i>
            <p> @if ($menu_translations['menu_location_showroom'])  {{$menu_translations['menu_location_showroom']}}  @else  Location/Showroom @endif</p>
            </a> </li>
            @endif
            @if(in_array("22",getUserAccessDetails()))
          <li class="nav-item"> <a href="/admin/testdrive" @if (Route::current()->getName() == "gettestdrivelist") class="nav-link active" @else class="nav-link" @endif> <i class="nav-icon fa fa-flag"></i>
            <p> @if ($menu_translations['menu_test_drive']) {{$menu_translations['menu_test_drive']}} @else  Test Drive @endif</p>
            </a> </li>
             @endif
              @if(in_array("23",getUserAccessDetails()))
          <li class="nav-item"> <a href="/admin/quotes" @if (Route::current()->getName() == "getquoteslist") class="nav-link active" @else class="nav-link" @endif> <i class="nav-icon fa fa-flag"></i>
            <p>@if ($menu_translations['menu_get_a_quote']) {{$menu_translations['menu_get_a_quote']}} @else  Get a quote @endif </p>
            </a> </li>
            @endif
            @if(in_array("24",getUserAccessDetails()))
             <li class="nav-item"> <a href="/admin/tradein" @if (Route::current()->getName() == "gettradeinlist") class="nav-link active" @else class="nav-link" @endif> <i class="nav-icon fa fa-flag"></i>
            <p>  @if ($menu_translations['menu_tradein']) {{$menu_translations['menu_tradein']}} @else Trade In  @endif  </p>
            </a> </li>
            @endif
          <!--  <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon fa fa-flag"></i>
            <p>Trade In</p>
            </a> </li> -->
             @if(in_array("25",getUserAccessDetails()))
         <li class="nav-item"> <a href="/admin/citylist"  @if (Route::current()->getName() == "citylist") class="nav-link active" @else class="nav-link" @endif> <i class="nav-icon fa fa-flag"></i>
            <p>@if ($menu_translations['menu_city']) {{$menu_translations['menu_city']}} @else City  @endif  </p>   
            </a> </li>
            @endif
            @if(in_array("26",getUserAccessDetails()))
          <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon fa fa-key"></i>
            <p>@if ($menu_translations['menu_change_password']) {{$menu_translations['menu_change_password']}} @else Change Password  @endif </p>
            </a> </li>
            @endif
          <li class="nav-item"> <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="nav-icon fa fa-sign-out-alt"></i>
          
             <p>@if ($menu_translations['menu_sign_out']) {{$menu_translations['menu_sign_out']}} @else Sign out @endif </p>
            </a> </li>
        </ul>
      </nav>
    </div>
  </aside>
  
  </section>
 @include('layouts.footer')
<!-- <footer class="main-footer"> <strong><a href="#">Al Masaood Auto. </a></strong>All rights reserved.
  <div class="float-right d-none d-sm-inline-block"> <b>Powered By </b> Marka Communications </div>
</footer> -->
<aside class="control-sidebar control-sidebar-dark"> </aside>
</div>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script> 
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script> 
<script>
    $.widget.bridge('uibutton', $.ui.button)

  </script> 
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> 
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script> 

<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script> 
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script> 

<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/js/bootstrap-datepicker.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/js/bootstrap-datepicker.min.js"></script>
 <script src="{{ asset('js/adminlte.js') }}"></script>


<script type="text/javascript">
 


  $(function () {

        $("#loader").hide()
$('body').css('display','block');
    // alert("inside jquery");
  $.fn.dataTable.ext.errorMode = "throw";
    // For UsersList
    var table1 = $('#example1').DataTable({
        // scrollY: 550,
        // scrollX: true,
        order:  [0, 'asc'] ,
        fixedColumns: true,
        processing: true,
        serverSide: true,
        method:'GET',
        lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
        language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        ajax: "{{ route('getallUsers') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'email', name: 'email'},
            {data: 'password', name: 'password'},
            {data:'edit',name: 'edit', orderable: false, searchable: false},// visible:false},
             {data: 'delete',name: 'delete', orderable: false, searchable: false},// visible:false},
             
        ],
        columnDefs: [{
            "defaultContent": "-",
            "targets": "_all"
          }]
    });


         // For Customers List 
       var table2 = $('#example2').DataTable({
        scrollY: 550,
        scrollX: true,
        fixedColumns: true,
        // order:  [8, 'desc'] ,
        order:  [0, 'asc'] ,
        dom:'lfBrtip',  
        processing: true,
        serverSide: true,
        method:'POST',
        lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
        language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        // fixedHeader: true,


        // ajax: "{{ route('getcustomers') }}",
        ajax: {
          url: "{{ route('getcustomers') }}",
          data: function (d) {
                d.model_id_filter = $('#model_id_filter').val(),
                //d.search = $('input[type="search"]').val()
                d.device_type_filter = $('#device_type_filter').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'username', name: 'username'},
            {data: 'mobile_number', name: 'mobile_number'},
            {data: 'email', name: 'email'},
            {data: 'main_brand_name', name: 'main_brand_name'},
            {data: 'model_name', name: 'model_name'},
            {data: 'car_registration_number', name: 'car_registration_number'},
            {data: 'reg_chasis_number', name: 'reg_chasis_number'},
            {data: 'created_at', name: 'created_at'},
            {data: 'device_type', name: 'device_type'}, 
            {data: 'status', name: 'status', orderable: false, searchable: false}, 
            {data:'edit',name: 'edit', orderable: false, searchable: false},// visible:false},
            {data:'chat',name: 'chat', orderable: false, searchable: false},// visible:false},
            {data:'notification',name: 'notification', orderable: false, searchable: false},// visible:false},
            {data:'last_active',name: 'last_active', orderable: false, searchable: false},// visible:false},
            {data:'brand_id', name: 'brand_id',visible:false}// visible:false},
             
        ] , 

           buttons: [
              {
                extend: 'excel',
                text: 'Generate Excel',
                title: 'Customers',
                 exportOptions: {
              columns: [0,1,2,3,4,5,6,7,8,9,10,14]
             
              }
              }
              ],
              columnDefs: [{
            "defaultContent": "",
           "targets": "_all"
          }]
          
         
    });

       // For New Cars / Preowned Car List 


       var table3 = $('#example3').DataTable({
         scrollY: 550,
         //scrollX: true,
        fixedColumns: true,
        // order:  [5, 'desc'] ,
        order:  [0, 'asc'] ,
        processing: true,
        serverSide: true,
        method:'POST',
                lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
                language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        ajax: {
          url: "{{ route('getnewcarsinfo') }}",
          data: function (d) {
                d.model_id_filter = $('#model_id_filter').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        // ajax: "{{ route('getnewcarsinfo') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'model_name', name: 'model_name'},
            {data: 'sort_order_app', name: 'sort_order_app'},
            {data: 'model_base_image_url', name: 'model_base_image_url', orderable: false, searchable: false},
            {data: 'versions',name: 'versions', orderable: false, searchable: false},// visible:false},
            {data: 'edit',name: 'edit', orderable: false, searchable: false},// visible:false},
            {data: 'delete',name: 'delete', orderable: false, searchable: false},// visible:false},
            {data:'main_brand_id', name: 'main_brand_id',visible:false}// visible:false},
 
        ],
        columnDefs: [{
            "defaultContent": "",
            "targets": "_all"
          }],

    });


        // For New Cars / Preowned Car List 

       var table4 = $('#example4').DataTable({
         scrollY: 550,
        // scrollX: true,
        fixedColumns: true,
        // order:  [5, 'desc'] ,
        order:  [0, 'asc'] ,

        processing: true,
        serverSide: true,
        method:'POST',
                lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
                language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        ajax: {
          url: "{{ route('getpreownedcarsinfo') }}",
          data: function (d) {
                d.model_id_filter = $('#model_id_filter').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        // ajax: "{{ route('getpreownedcarsinfo') }}",
         columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'model_name', name: 'model_name'},
            {data: 'sort_order_app', name: 'sort_order_app'},
            {data: 'model_base_image_url', name: 'model_base_image_url', orderable: false, searchable: false},
            {data: 'versions',name: 'versions', orderable: false, searchable: false},// visible:false},
            {data: 'edit',name: 'edit', orderable: false, searchable: false},// visible:false},
            {data: 'delete',name: 'delete', orderable: false, searchable: false},// visible:false},
            {data:'main_brand_id', name: 'main_brand_id',visible:false}// visible:false},
 
        ],
        columnDefs: [
            {
              "data": null,
              "defaultContent": "<a class='btn text-primary' href='#'>Versions</a>",
              "targets": -3
            },
            {
              "data": null,
              "defaultContent": "<a class='btn' href='#'><i class='fas fa-edit text-primary'></i></a>",
              "targets": -2
            },
            {
              "data": null,
              "defaultContent": "<a class='btn' href='#'><i class='fa fa-trash text-danger'></i></a>",
              "targets": -1
            }
          ]
    });

              // For New Cars / Preowned Car List 

       var table5 = $('#example5').DataTable({
         scrollY: 350,
        // scrollX: true,
        fixedColumns: true,
        // order:  [1, 'desc'] ,
        order:  [0, 'asc'] ,

        processing: true,
        serverSide: true,
        method:'POST',
                lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
                language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        ajax: "{{ route('getversioninfobymodel') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'version_name', name: 'version_name'},           
            {data: 'version_image_url', name: 'version_image_url', orderable: false, searchable: false},
            {data: 'starting_price', name: 'starting_price'},
            {data: 'specifications',name: 'specifications', orderable: false, searchable: false},// visible:false},
            {data: 'equipments',name: 'equipments', orderable: false, searchable: false},// visible:false},
            {data: 'interiors',name: 'interiors', orderable: false, searchable: false},// visible:false},
            {data: 'exteriors',name: 'exteriors', orderable: false, searchable: false},// visible:false},
            {data: 'accessories',name: 'accessories', orderable: false, searchable: false},// visible:false},
            {data: 'edit',name: 'edit', orderable: false, searchable: false},// visible:false},
            {data: 'delete',name: 'delete', orderable: false, searchable: false}// visible:false},
 
        ],
       columnDefs: [{
            "defaultContent": "",
            "targets": "_all"
          }]
    });

                    // For New Cars / Preowned Car List 

       var table6 = $('#example6').DataTable({
        scrollY: 550,
        //scrollX: true,
        fixedColumns: true,
        // order:  [1, 'desc'] ,
        order:  [0, 'asc'] ,

        processing: true,
        serverSide: true,
        method:'POST',
                lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
                language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        ajax: "{{ route('getversionspecification') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'category_name', name: 'car_specification_category.category_name'},           
            {data: 'specification', name: 'car_model_version_specifications.specification', orderable: false},
            {data: 'created_at',name: 'created_at', searchable: false},// visible:false},
            {data: 'edit',name: 'edit', orderable: false, searchable: false},// visible:false},
            {data: 'delete',name: 'delete', orderable: false, searchable: false}// visible:false},
 
        ],
       columnDefs: [{
            "defaultContent": "",
            "targets": "_all"
          }]
    });


                  // For Category list

       var table7 = $('#example7').DataTable({
        scrollY: 550,
        //scrollX: true,
        fixedColumns: true,
        // order:  [1, 'desc'] ,
        order:  [0, 'asc'] ,

        processing: true,
        serverSide: true,
        method:'POST',
                lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
                language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        ajax: "{{ route('getspecificationcategories') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'category_name', name: 'category_name'},           
            {data: 'edit',name: 'edit', orderable: false, searchable: false},// visible:false},
            {data: 'delete',name: 'delete', orderable: false, searchable: false}// visible:false},
 
        ],
       columnDefs: [{
            "defaultContent": "",
            "targets": "_all"
          }]
    });

      // For Test Drive

       var table8 = $('#example8').DataTable({
        // scrollY: 550,
        // scrollX: true,
        fixedColumns: true,
        dom: 'Bfrtip',
        // order:  [1, 'desc'] ,
        order:  [0, 'asc'] ,
         dom:'lfBrtip',
     
        
        processing: true,
        serverSide: false,
        method:'POST',
                lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
                language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        // ajax: "{{ route('gettestdrive') }}",

         ajax: {
          url: "{{ route('gettestdrive') }}",
          data: function (d) {
                d.model_id_filter = $('#model_id_filter').val(),
                d.search = $('input[type="search"]').val()
            }
        },

        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'username', name: 'customer.username'},           
            {data: 'mobile_number', name: 'customer.mobile_number'},
            {data: 'email', name: 'customer.email'},
            {data: 'model_name',name: 'car_model.model_name'},// visible:false},
            {data: 'appointment_on',name: 'appointment_on', orderable: false, searchable: false},// visible:false},
            {data: 'city',name: 'city_master.city'},// visible:false},
            {data: 'name',name: 'showroom.name'},// visible:false},
            {data:'main_brand_id', name: 'main_brand_id',visible:false}// visible:false},
 
        ],
         
       columnDefs: [{
            "defaultContent": "",
            "targets": "_all"
          }],
           buttons: [
            // {
              {
                extend: 'excel',
                text: 'Generate Excel',
                title: 'Test Drive',
                 exportOptions: {
              columns: ':visible'
             
              }
              }
              
             
            // }
            
        ]
    });


// For Test Drive

       var table9 = $('#example9').DataTable({
        // scrollY: 550,
        // scrollX: true,
        fixedColumns: true,
        dom: 'Bfrtip',
        // order:  [1, 'desc'] ,
        order:  [0, 'asc'] ,
         dom:'lfBrtip',
     
        
        processing: true,
        serverSide: false,
        method:'POST',
                lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
                language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        // ajax: "{{ route('gettestdrive') }}",

         ajax: {
          url: "{{ route('getquotes') }}",
          data: function (d) {
                d.model_id_filter = $('#model_id_filter').val(),
                d.search = $('input[type="search"]').val()
            }
        },

        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',  searchable: false},
            {data: 'username', name: 'customer.username'},           
            {data: 'mobile_number', name: 'customer.mobile_number'},
            {data: 'email', name: 'customer.email'},
            {data: 'model_name',name: 'car_model.model_name'},// visible:false},
            {data: 'created_at',name: 'created_at', orderable: false, searchable: false},// visible:false},
            {data: 'city',name: 'city_master.city'},// visible:false},
            {data: 'name',name: 'showroom.name'},// visible:false},
            {data:'main_brand_id', name: 'main_brand_id',visible:false}// visible:false},
 
        ],
         
       columnDefs: [{
            "defaultContent": "",
            "targets": "_all"
          }],
           buttons: [
            // {
              {
                extend: 'excel',
                text: 'Generate Excel',
                title: 'Quotes',
                 exportOptions: {
              columns: ':visible'
             
              }
              }
              
             
            // }
            
        ]
    });

                          // For New Cars / Preowned Car List 

       var table10 = $('#example10').DataTable({
        scrollY: 550,
       // scrollX: true,
        fixedColumns: true,
        // order:  [1, 'desc'] ,
        order:  [0, 'asc'] ,

        processing: true,
        serverSide: true,
        method:'POST',
                lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
                language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        ajax: "{{ route('getversionequipments') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},    
            {data: 'equipments', name: 'car_model_version_equipments.equipments', orderable: false},
            {data: 'created_at',name: 'created_at', searchable: false},// visible:false},
            {data: 'edit',name: 'edit', orderable: false, searchable: false},// visible:false},
            {data: 'delete',name: 'delete', orderable: false, searchable: false}// visible:false},
 
        ],
       columnDefs: [{
            "defaultContent": "",
            "targets": "_all"
          }]
    });

    var table11 = $('#example11').DataTable({
        scrollY: 550,
        scrollX: true,
        fixedColumns: true,
        // order:  [2, 'desc'] ,
        order:  [0, 'asc'] ,

        processing: true,
        serverSide: true,
        method:'POST',
                lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
                language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        ajax: {
          url: "{{ route('getlocationsinfo') }}",
          data: function (d) {
                d.model_id_filter = $('#model_id_filter').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        // ajax: "{{ route('getlocationsinfo') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'location_name', name: 'location.location_name'},
            {data: 'location_category_name', name: 'location_category.location_category_name'},
            {data: 'latitude', name: 'location.latitude'},
            {data: 'longitude', name: 'location.longitude'},
            {data: 'address', name: 'location.address'},
            {data: 'available_services', name: 'location.available_services'},
            {data: 'pincode', name: 'location.pincode'},
            {data: 'edit',name: 'edit', orderable: false, searchable: false},// visible:false},
            {data: 'delete',name: 'delete', orderable: false, searchable: false},// visible:false},
            {data:'main_brand_id', name: 'location.main_brand_id',visible:false},// visible:false},
            {data:'location_category_id', name: 'location.location_category_id',visible:false}// visible:false},
 
        ],
        columnDefs: [{
            "defaultContent": "",
            "targets": "_all"
          }],

    });

    // For Test Drive

       var table12 = $('#example12').DataTable({
        // dom: 'Bfrtip',
        scrollY: 550,
         scrollX: true,
        fixedColumns: true,
        // order:  [1, 'desc'] ,
        order:  [0, 'asc'] ,
         dom:'lfBrtip',
     
        
        processing: true,
        serverSide: false,
        method:'POST',
                lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
                language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        // ajax: "{{ route('gettestdrive') }}",

         ajax: {
          url: "{{ route('gettradein') }}",
          data: function (d) {
                d.model_id_filter = $('#model_id_filter').val(),
                d.search = $('input[type="search"]').val()
            }
        },

        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'customer_name', name: 'tradein.customer_name'},           
            {data: 'customer_mobile_number', name: 'tradein.customer_mobile_number'},
            {data: 'customer_email', name: 'tradein.customer_email'},
            {data: 'main_brand_name', name: 'tradein.main_brand_name'},
            {data: 'model_name',name: 'car_model.model_name'},// visible:false},
            {data: 'required_car',name: 'car_model.required_car'},// visible:false},
            {data: 'mileage',name: 'car_model.mileage'},// visible:false},
            {data: 'created_at',name: 'created_at', orderable: false, searchable: false},// visible:false},
            {data: 'trade_in_image',name: 'tradein.trade_in_image'},// visible:false},
            
            {data:'main_brand_id', name: 'main_brand_id',visible:false}// visible:false},
            
 
        ],
           buttons: [
            // {
              {
                extend: 'excel',
                text: 'Generate Excel',
                title: 'Trade In',
                 exportOptions: {
                   columns: [ 0,1,2,3,4,5,6,7,8]
             
              }
              }
              
             
            // }
            
        ],
       columnDefs: [{
            "defaultContent": "",
            "targets": "_all"
          }],
         
    });

        var table13 = $('#example13').DataTable({
        
        fixedColumns: true,
          dom:'lfBrtip',
        // order:  [2, 'desc'] ,
        order:  [0, 'asc'] ,

        processing: true,
        serverSide: true,
        method:'POST',
                lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
                language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        ajax: {
          url: "{{ route('getservicemenuinfo') }}",
          data: function (d) {
                d.model_id_filter = $('#model_id_filter').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        // ajax: "{{ route('getlocationsinfo') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'service_menu_title', name: 'service_menu.service_menu_title'},
            {data: 'service_menu_description', name: 'service_menu.service_menu_description'},
            
            {data: 'edit',name: 'edit', orderable: false, searchable: false},// visible:false},
            {data: 'delete',name: 'delete', orderable: false, searchable: false},// visible:false},
            {data:'main_brand_id', name: 'service_menu.main_brand_id',visible:false},// visible:false},
           // {data:'location_category_id', name: 'location.location_category_id',visible:false}// visible:false},
 
        ],
        columnDefs: [{
            "defaultContent": "",
            "targets": "_all",
            
          }],

           buttons: [
            // {
              {
                extend: 'excel',
                text: 'Generate Excel',
                title: 'Service Menu',
                 exportOptions: {
              //columns: ':visible'
                      columns: [ 0,1,2 ]
             
              }
              }
              
             
            // }
            
        ]

    });


         var table14 = $('#example14').DataTable({
          // scrollY: 550,
        // scrollX: true,
        fixedColumns: true,
          dom:'lfBrtip',
        // order:  [1, 'asc'] ,
        order:  [0, 'asc'] ,

        processing: true,
        serverSide: true,
        method:'POST',
                lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
                language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        ajax: {
          url: "{{ route('getserviceneededinfo') }}",
          data: function (d) {
                d.model_id_filter = $('#model_id_filter').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        // ajax: "{{ route('getlocationsinfo') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'service_needed_title', name: 'service_needed.service_needed_title'},
            {data: 'created_at', name: 'service_needed.created_at'},
            
            {data: 'edit',name: 'edit', orderable: false, searchable: false},// visible:false},
            {data: 'delete',name: 'delete', orderable: false, searchable: false},// visible:false},
            {data:'main_brand_id', name: 'service_needed.main_brand_id',visible:false},// visible:false},
           // {data:'location_category_id', name: 'location.location_category_id',visible:false}// visible:false},
 
        ],
        columnDefs: [{
            "defaultContent": "",
            "targets": "_all",
            
          }],

           buttons: [
            // {
              {
                extend: 'excel',
                text: 'Generate Excel',
                title: 'Service Needed',
                 exportOptions: {
              //columns: ':visible'
                      columns: [ 0,1,2 ]
             
              }
              }
              
             
            // }
            
        ]

    });

  var table15 = $('#example15').DataTable({
        // scrollY: 550,
        // scrollX: true,
        fixedColumns: true,
        dom:'lfBrtip',
        // order:  [1, 'asc'] ,
        order:  [0, 'asc'] ,

        processing: true,
        serverSide: true,
        method:'POST',
                lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
                language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        ajax: {
          url: "{{ route('getservicepackagesinfo') }}",
          data: function (d) {
                d.model_id_filter = $('#model_id_filter').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        // ajax: "{{ route('getlocationsinfo') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'service_package_title', name: 'service_package.service_package_title'},
            {data: 'service_package_price', name: 'service_package.service_package_price'},
            {data: 'service_package_description', name: 'service_package.service_package_description'},
            
            {data: 'edit',name: 'edit', orderable: false, searchable: false},// visible:false},
            {data: 'delete',name: 'delete', orderable: false, searchable: false},// visible:false},
            {data:'main_brand_id', name: 'service_package.main_brand_id',visible:false},// visible:false},
           // {data:'location_category_id', name: 'location.location_category_id',visible:false}// visible:false},
 
        ],
        columnDefs: [{
            "defaultContent": "",
            "targets": "_all",
            
          }],

           buttons: [
            // {
              {
                extend: 'excel',
                text: 'Generate Excel',
                title: 'Service Packages',
                 exportOptions: {
              //columns: ':visible'
                      columns: [ 0,1,2,3 ]
             
              }
              }
              
             
            // }
            
        ]

    });

  var table16 = $('#example16').DataTable({
        scrollY: 550,
        scrollX: true,
        fixedColumns: true,
          dom:'lfBrtip',
        // order:  [1, 'asc'] ,
        order:  [0, 'asc'] ,

        processing: true,
        serverSide: true,
        method:'POST',
                lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
                language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        ajax: {
          url: "{{ route('getappointmentsinfo') }}",
          data: function (d) {
                d.model_id_filter = $('#model_id_filter').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        // ajax: "{{ route('getlocationsinfo') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'customer_first_name', name: 'form_book_appointment.customer_first_name'},
            {data: 'mobile_number', name: 'form_book_appointment.mobile_number'},
            {data: 'email', name: 'form_book_appointment.email'},

            {data: 'chassis_number', name: 'form_book_appointment.chassis_number'},
            {data: 'model_name', name: 'form_book_appointment.car_model'},
            { data: 'service_needed_title', name: 'service_needed.service_needed_title'},
            {data: 'created_at', name: 'form_book_appointment.created_at'},
            {data: 'appointment_date', name: 'form_book_appointment.appointment_date'},
            {data: 'car_required', name: 'form_book_appointment.car_required'},
            {data: 'location_name', name: 'location.location_name' },
            {data: 'status', name: 'car_service_status.status' , orderable: false, searchable: false},
            {data: 'pickup_required', name: 'form_book_appointment.pickup_required'},
            
            {data: 'notifications',name: 'notifications', orderable: false, searchable: false},// visible:false},
           // {data: 'delete',name: 'delete', orderable: false, searchable: false},// visible:false},
            {data:'main_brand_id', name: 'form_book_appointment.main_brand_id',visible:false},// visible:false},
           // {data:'location_category_id', name: 'location.location_category_id',visible:false}// visible:false},
 
        ],
        columnDefs: [{
            "defaultContent": "",
            "targets": "_all",
            
          }],

           buttons: [
            // {
              {
                extend: 'excel',
                text: 'Generate Excel',
                title: 'Service Packages',
                 exportOptions: {
              //columns: ':visible'
                      columns: [ 0,1,2,3 ]
             
              }
              }
              
             
            // }
            
        ]

    });

             // For Customers List 
       var table17 = $('#example17').DataTable({
        scrollY: 550,
        scrollX: true,
        fixedColumns: true,
        // order:  [8, 'desc'] ,
        order:  [0, 'asc'] ,
        dom:'lfBrtip',  
        processing: true,
        serverSide: true,
        method:'POST',
        lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
        language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        // fixedHeader: true,


        // ajax: "{{ route('getcustomers') }}",
        ajax: {
          url: "{{ route('getinsurancerequest') }}",
          data: function (d) {
                d.model_id_filter = $('#model_id_filter').val(),
                //d.search = $('input[type="search"]').val()
                d.device_type_filter = $('#device_type_filter').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'username', name: 'username'},
            {data: 'mobile_number', name: 'mobile_number'},
            {data: 'email', name: 'email'},
            {data: 'car_registration_number', name: 'car_registration_number'},
            {data: 'main_brand_name', name: 'main_brand_name'},
            {data: 'model_name', name: 'model_name'},
            
            {data: 'reg_chasis_number', name: 'reg_chasis_number'},
            //{data: 'description', name: 'description' , orderable: false, searchable: false},
            {data: 'created_at', name: 'created_at'},
            // {data: 'device_type', name: 'device_type'}, 
            {data: 'status', name: 'status', orderable: false, searchable: false}, 
            // {data:'edit',name: 'edit', orderable: false, searchable: false},// visible:false},
            // {data:'chat',name: 'chat', orderable: false, searchable: false},// visible:false},
            {data:'comment',name: 'comment', orderable: false, searchable: false},// visible:false},
            {data:'brand_id', name: 'brand_id',visible:false}// visible:false},
             
        ] , 

           buttons: [
              {
                extend: 'excel',
                text: 'Generate Excel',
                title: 'Insurance Request',
                 exportOptions: {
              columns: [0,1,2,3,4,5,6,7,8,9,10]
             
              }
              }
              ],
              columnDefs: [{
            "defaultContent": "",
           "targets": "_all"
          }]
          
         
    });

     var table18 = $('#example18').DataTable({
        scrollY: 550,
        scrollX: true,
        fixedColumns: true,
        // order:  [8, 'desc'] ,
        order:  [0, 'asc'] ,
        dom:'lfBrtip',  
        processing: true,
        serverSide: true,
        method:'POST',
        lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
        language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        // fixedHeader: true,


        // ajax: "{{ route('getcustomers') }}",
        ajax: {
          url: "{{ route('getaccessoryrequest') }}",
          data: function (d) {
                d.model_id_filter = $('#model_id_filter').val(),
                //d.search = $('input[type="search"]').val()
                d.device_type_filter = $('#device_type_filter').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'username', name: 'username'},
            {data: 'mobile_number', name: 'mobile_number'},
            {data: 'email', name: 'email'},
            {data: 'car_registration_number', name: 'car_registration_number'},
            {data: 'user_profile_car_brand_label', name: 'main_brand_name'},
            {data: 'user_profile_car_model_label', name: 'model_name'},
            
            {data: 'user_profile_chassis_label', name: 'reg_chasis_number'},
            //{data: 'description', name: 'description' , orderable: false, searchable: false},
            {data: 'created_at', name: 'created_at'},
            {data: 'accessory_request', name: 'accessory_request' , orderable: false, searchable: false}, 
            {data:'comment',name: 'comment', orderable: false, searchable: false},// visible:false},
            {data: 'status', name: 'status', orderable: false, searchable: false}, 
             {data:'edit',name: 'edit', orderable: false, searchable: false},// visible:false},
             {data:'chat',name: 'chat', orderable: false, searchable: false},// visible:false},
            
            {data: 'notifications',name: 'notifications', orderable: false, searchable: false},// visible:false},
            {data:'brand_id', name: 'brand_id',visible:false}// visible:false},
             
        ] , 

           buttons: [
              {
                extend: 'excel',
                text: 'Generate Excel',
                title: 'Accessory Request',
                 exportOptions: {
              columns: [0,1,2,3,4,5,6,7,8,9,10]
             
              }
              }
              ],
              columnDefs: [{
            "defaultContent": "",
           "targets": "_all"
          }]
          
         
    });

        
var table19 = $('#example19').DataTable({
        fixedColumns: true,
        dom:'lfrtip',
         
        // order:  [2, 'asc'] ,
        order:  [0, 'asc'] ,

        processing: true,
        serverSide: true,
        method:'POST',
                lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
                language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        ajax: {
          url: "{{ route('getnewsandpromotionsinfo') }}",
          data: function (d) {
                d.model_id_filter = $('#model_id_filter').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        // ajax: "{{ route('getlocationsinfo') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'image_url', name: 'news_promotions.news_promotions_image_url'},
            {data: 'news_promotions_title', name: 'news_promotions.news_promotions_title'},
            {data: 'description', name: 'news_promotions.news_promotions_description'},

            {data: 'edit',name: 'edit', orderable: false, searchable: false},// visible:false},
            {data: 'delete',name: 'delete', orderable: false, searchable: false},// visible:false},
           
            {data:'main_brand_id', name: 'news_promotions.main_brand_id',visible:false},// visible:false},
           
 
        ],
        columnDefs: [{
            "defaultContent": "",
            "targets": "_all",
            
          }],

          
    });
  

      // For Customers List 
       var table20 = $('#example20').DataTable({
        scrollY: 550,
        scrollX: true,
        fixedColumns: true,
        // order:  [8, 'desc'] ,
        order:  [0, 'asc'] ,
        dom:'lfBrtip',  
        processing: true,
        serverSide: true,
        method:'POST',
        lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
        language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        // fixedHeader: true,


        // ajax: "{{ route('getcustomers') }}",
        ajax: {
          url: "{{ route('getcustomercars') }}",
          data: function (d) {
                d.model_id_filter = $('#model_id_filter').val(),
                //d.search = $('input[type="search"]').val()
                d.device_type_filter = $('#device_type_filter').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'username', name: 'username'},
            {data: 'mobile_number', name: 'mobile_number'},
            {data: 'email', name: 'email'},
            {data: 'main_brand_name', name: 'main_brand_name'},
            {data: 'model_name', name: 'model_name'},
            {data: 'car_registration_number', name: 'car_registration_number'},
            {data: 'reg_chasis_number', name: 'reg_chasis_number'},
            {data: 'created_at', name: 'created_at'},
            {data: 'device_type', name: 'device_type'}, 
            {data: 'status', name: 'status', orderable: false, searchable: false}, 
            {data:'edit',name: 'edit', orderable: false, searchable: false},// visible:false},
            {data:'chat',name: 'chat', orderable: false, searchable: false},// visible:false},
            {data:'notification',name: 'notification', orderable: false, searchable: false},// visible:false},
            {data:'brand_id', name: 'brand_id',visible:false}// visible:false},
             
        ] , 

           buttons: [
              {
                extend: 'excel',
                text: 'Generate Excel',
                title: 'Customer Cars',
                 exportOptions: {
              columns: [0,1,2,3,4,5,6,7,8,9,10]
             
              }
              }
              ],
              columnDefs: [{
            "defaultContent": "",
           "targets": "_all"
          }]
          
         
    });

       var table21 = $('#example21').DataTable({
        fixedColumns: true,
        dom:'lfrtip',
         
        // order:  [2, 'asc'] ,
        order:  [0, 'asc'] ,

        processing: true,
        serverSide: true,
        method:'POST',
                lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
                language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        ajax: {
          url: "{{ route('getonboardinginfo') }}",
          data: function (d) {
                d.model_id_filter = $('#model_id_filter').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        // ajax: "{{ route('getlocationsinfo') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'image_url', name: 'onboarding_screen.onboarding_screen_image_url'},
            
            {data: 'description', name: 'onboarding_screen.onboarding_screen_description'},
            {data: 'avail_offer', name: 'onboarding_screen.avail_offer',orderable: false, searchable: false},
            {data: 'like', name: 'onboarding_screen.like',orderable: false, searchable: false},
            {data: 'edit',name: 'edit', orderable: false, searchable: false},// visible:false},
            {data: 'delete',name: 'delete', orderable: false, searchable: false},// visible:false},
           
            {data:'main_brand_id', name: 'onboarding_screen.main_brand_id',visible:false},// visible:false},
           
 
        ],
        columnDefs: [{
            "defaultContent": "",
            "targets": "_all",
            
          }],

          
    });

        var table22 = $('#example22').DataTable({
        fixedColumns: true,
        dom:'lfrtip',
         
        // order:  [2, 'asc'] ,
        order:  [0, 'asc'] ,

        processing: true,
        serverSide: true,
        method:'POST',
                lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
                language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        ajax: {
          url: "{{ route('getcityinfo') }}",
          data: function (d) {
                d.model_id_filter = $('#model_id_filter').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        // ajax: "{{ route('getlocationsinfo') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'city', name: 'city_master.city'},
            {data: 'edit',name: 'edit', orderable: false, searchable: false},// visible:false},
            {data: 'delete',name: 'delete', orderable: false, searchable: false},// visible:false},
           
 
        ],
        columnDefs: [{
            "defaultContent": "",
            "targets": "_all",
            
          }],

          
    });


           // For Customers List 
       var table23 = $('#example23').DataTable({
        scrollY: 550,
        scrollX: true,
        fixedColumns: true,
        // order:  [1, 'asc'] ,
        order:  [0, 'asc'] ,
        dom:'lfBrtip',  
        processing: true,
        serverSide: true,
        method:'POST',
        lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
        language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        // fixedHeader: true,


        // ajax: "{{ route('getcustomers') }}",
        ajax: {
          url: "{{ route('getavailoffers') }}",
          data: function (d) {
                d.model_id_filter = $('#model_id_filter').val(),
                //d.search = $('input[type="search"]').val()
                d.device_type_filter = $('#device_type_filter').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'username', name: 'username'},
            {data: 'mobile_number', name: 'mobile_number'},
            {data: 'email', name: 'email'},
            {data: 'main_brand_name', name: 'main_brand_name'},
            {data: 'model_name', name: 'model_name'},
            {data: 'car_registration_number', name: 'car_registration_number'},
            {data: 'reg_chasis_number', name: 'reg_chasis_number'},
              {data: 'created_at', name: 'created_at'},
            {data: 'onboarding_screen_description', name: 'onboarding_screen_description'}, 
          
            {data: 'status', name: 'status', orderable: false, searchable: false}, 
            {data: 'comment', name: 'comment', orderable: false, searchable: false}, 
            // {data:'edit',name: 'edit', orderable: false, searchable: false},// visible:false},
            // {data:'chat',name: 'chat', orderable: false, searchable: false},// visible:false},
            // {data:'notification',name: 'notification', orderable: false, searchable: false},// visible:false},
            // {data:'last_active',name: 'last_active', orderable: false, searchable: false},// visible:false},
            {data: 'statusexport', name: 'statusexport', orderable: false, searchable: false,visible:false}, 
            {data:'brand_id', name: 'brand_id',visible:false}// visible:false},
             
        ] , 

           buttons: [
              {
                extend: 'excel',
                text: 'Generate Excel',
                title: 'Avail users list',
                 exportOptions: {
              columns: [0,1,2,3,4,5,6,7,8,9,12,11]
             
              }
              }
              ],
              columnDefs: [{
            "defaultContent": "",
           "targets": "_all"
          }]
          
         
    });

            // For Customers List 
       var table24 = $('#example24').DataTable({
        scrollY: 550,
        scrollX: true,
        fixedColumns: true,
        // order:  [1, 'asc'] ,
        order:  [0, 'asc'] ,
        dom:'lfBrtip',  
        processing: true,
        serverSide: true,
        method:'POST',
        lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
        language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        // fixedHeader: true,


        // ajax: "{{ route('getcustomers') }}",
        ajax: {
          url: "{{ route('getavailoffers') }}",
          data: function (d) {
                d.model_id_filter = $('#model_id_filter').val(),
                //d.search = $('input[type="search"]').val()
                d.device_type_filter = $('#device_type_filter').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'username', name: 'username'},
            {data: 'mobile_number', name: 'mobile_number'},
            {data: 'email', name: 'email'},
            {data: 'main_brand_name', name: 'main_brand_name'},
            {data: 'model_name', name: 'model_name'},
            {data: 'car_registration_number', name: 'car_registration_number'},
            {data: 'reg_chasis_number', name: 'reg_chasis_number'},
              {data: 'created_at', name: 'created_at'},
            // {data: 'onboarding_screen_description', name: 'onboarding_screen_description'}, 
          
            //{data: 'status', name: 'status', orderable: false, searchable: false}, 
            //{data: 'comment', name: 'comment', orderable: false, searchable: false}, 
            // {data:'edit',name: 'edit', orderable: false, searchable: false},// visible:false},
            // {data:'chat',name: 'chat', orderable: false, searchable: false},// visible:false},
            // {data:'notification',name: 'notification', orderable: false, searchable: false},// visible:false},
            // {data:'last_active',name: 'last_active', orderable: false, searchable: false},// visible:false},
            //{data: 'statusexport', name: 'statusexport', orderable: false, searchable: false,visible:false}, 
           
            {data:'brand_id', name: 'brand_id',visible:false}// visible:false},
          
             
        ] , 

           buttons: [
              {
                extend: 'excel',
                text: 'Generate Excel',
                title: 'Pickup Car',
                 exportOptions: {
              columns: [0,1,2,3,4,5,6,7,8,9]
             
              }
              }
              ],
              columnDefs: [{
            "defaultContent": "",
           "targets": "_all"
          }]
          
         
    });

              // For Customers List 
       var table25 = $('#example25').DataTable({
        scrollY: 550,
        scrollX: true,
        fixedColumns: true,
        // order:  [1, 'asc'] ,
        order:  [0, 'asc'] ,
        dom:'lfBrtip',  
        processing: true,
        serverSide: true,
        method:'POST',
        lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
        language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        // fixedHeader: true,


        // ajax: "{{ route('getcustomers') }}",
        ajax: {
          url: "{{ route('getpickupcar') }}",
          data: function (d) {
                d.model_id_filter = $('#model_id_filter').val(),
                //d.search = $('input[type="search"]').val()
                d.device_type_filter = $('#device_type_filter').val(),
                d.rental_car_id_filter = $('#rental_car_id_filter').val(),
                d.case_of_car_id_filter = $('#case_of_car_id_filter').val(),
                d.car_delivery_id_filter = $('#car_delivery_id_filter').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'mobile', name: 'mobile'},
            {data: 'email', name: 'email'},
            {data: 'car_delivery_location', name: 'car_delivery_location'},
            {data: 'address', name: 'address'},
            {data: 'case_id', name: 'case_id'},
            {data: 'rent_car', name: 'rent_car'},
              {data: 'created_at', name: 'created_at'},
            //{data: 'onboarding_screen_description', name: 'onboarding_screen_description'}, 
          
            //{data: 'status', name: 'status', orderable: false, searchable: false}, 
            //{data: 'comment', name: 'comment', orderable: false, searchable: false}, 
            // {data:'edit',name: 'edit', orderable: false, searchable: false},// visible:false},
            // {data:'chat',name: 'chat', orderable: false, searchable: false},// visible:false},
            // {data:'notification',name: 'notification', orderable: false, searchable: false},// visible:false},
            // {data:'last_active',name: 'last_active', orderable: false, searchable: false},// visible:false},
            //{data: 'statusexport', name: 'statusexport', orderable: false, searchable: false,visible:false}, 
            {data:'brand_id', name: 'brand_id',visible:false},// visible:false},
            {data:'del_filter_id', name: 'car_delivery_location',visible:false},// visible:false},
            {data:'rent_filter_id', name: 'rent_car',visible:false},// visible:false},
            {data:'case_filter_id', name: 'case_id',visible:false}// visible:false},
             
        ] , 

           buttons: [
              {
                extend: 'excel',
                text: 'Generate Excel',
                title: 'Avail users list',
                 exportOptions: {
              columns: [0,1,2,3,4,5,6,7,8]
             
              }
              }
              ],
              columnDefs: [{
            "defaultContent": "",
           "targets": "_all"
          }]
          
         
    });

               // For Customers List 
       var table26 = $('#example26').DataTable({
        scrollY: 550,
        scrollX: true,
        fixedColumns: true,
        // order:  [8, 'desc'] ,
        order:  [0, 'asc'] ,
        dom:'lfBrtip',  
        processing: true,
        serverSide: true,
        method:'POST',
        lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
        language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        // fixedHeader: true,


        // ajax: "{{ route('getcustomers') }}",
        ajax: {
          url: "{{ route('getcallbackrequest') }}",
          data: function (d) {
                d.model_id_filter = $('#model_id_filter').val(),
                //d.search = $('input[type="search"]').val()
                d.device_type_filter = $('#device_type_filter').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'username', name: 'username'},
            {data: 'mobile_number', name: 'mobile_number'},
            
            {data: 'car_registration_number', name: 'car_registration_number'},
            
            
            {data: 'reg_chasis_number', name: 'reg_chasis_number'},
            //{data: 'description', name: 'description' , orderable: false, searchable: false},
            {data: 'created_at', name: 'created_at'},
            // {data: 'device_type', name: 'device_type'}, 
            {data: 'status', name: 'status', orderable: false, searchable: false}, 
            // {data:'edit',name: 'edit', orderable: false, searchable: false},// visible:false},
            // {data:'chat',name: 'chat', orderable: false, searchable: false},// visible:false},
           
            {data:'comment',name: 'comment', orderable: false, searchable: false},// visible:false},
             {data: 'statusexport', name: 'statusexport', orderable: false, searchable: false,visible:false}, 
            {data:'brand_id', name: 'brand_id',visible:false}// visible:false},
             
        ] , 

           buttons: [
              {
                extend: 'excel',
                text: 'Generate Excel',
                title: 'Call Back Requests',
                 exportOptions: {
              columns: [0,1,2,3,4,5,8,7]
             
              }
              }
              ],
              columnDefs: [{
            "defaultContent": "",
           "targets": "_all"
          }]
          
         
    });  
             // For Customers List 
       var table27 = $('#example27').DataTable({
        scrollY: 550,
        scrollX: true,
        fixedColumns: true,
        // order:  [8, 'desc'] ,
        order:  [0, 'asc'] ,
        dom:'lfBrtip',  
        processing: true,
        serverSide: true,
        method:'POST',
        lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
        language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        // fixedHeader: true,


        // ajax: "{{ route('getcustomers') }}",
        ajax: {
          url: "{{ route('getemergencycallrequest') }}",
          data: function (d) {
                d.model_id_filter = $('#model_id_filter').val(),
                //d.search = $('input[type="search"]').val()
                d.device_type_filter = $('#device_type_filter').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'username', name: 'username'},
            {data: 'mobile_number', name: 'mobile_number'},
            
            {data: 'car_registration_number', name: 'car_registration_number'},
            
            
            {data: 'reg_chasis_number', name: 'reg_chasis_number'},
            //{data: 'description', name: 'description' , orderable: false, searchable: false},
            {data: 'created_at', name: 'created_at'},
            {data: 'latitude', name: 'latitude'},
            {data: 'longitude', name: 'longitude'},
            // {data: 'device_type', name: 'device_type'}, 
            {data: 'status', name: 'status', orderable: false, searchable: false}, 
            // {data:'edit',name: 'edit', orderable: false, searchable: false},// visible:false},
            // {data:'chat',name: 'chat', orderable: false, searchable: false},// visible:false},
           
            {data:'comment',name: 'comment', orderable: false, searchable: false},// visible:false},
             {data: 'statusexport', name: 'statusexport', orderable: false, searchable: false,visible:false}, 
            {data:'brand_id', name: 'brand_id',visible:false}// visible:false},
             
        ] , 

           buttons: [
              {
                extend: 'excel',
                text: 'Generate Excel',
                title: 'Emergency call Requests',
                 exportOptions: {
              columns: [0,1,2,3,4,5,6,7,10,9]
             
              }
              }
              ],
              columnDefs: [{
            "defaultContent": "",
           "targets": "_all"
          }]
          
         
    });


        var table28 = $('#example28').DataTable({
        fixedColumns: true,
        dom:'lfrtip',
         
        // order:  [2, 'asc'] ,
        order:  [0, 'asc'] ,

        processing: true,
        serverSide: true,
        method:'POST',
                lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
                language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        ajax: {
          url: "{{ route('getcorporatesolutionsinfo') }}",
          data: function (d) {
                d.model_id_filter = $('#model_id_filter').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        // ajax: "{{ route('getlocationsinfo') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'title', name: 'corporate_solutions.corporate_solutions_title'},
            {data: 'description', name: 'corporate_solutions.corporate_solutions_description'},
            {data: 'edit',name: 'edit', orderable: false, searchable: false},// visible:false},
            {data: 'delete',name: 'delete', orderable: false, searchable: false},// visible:false},
           
 
        ],
        columnDefs: [{
            "defaultContent": "",
            "targets": "_all",
            
          }],

          
    });


        var table29 = $('#example29').DataTable({
         scrollY: 550,
         //scrollX: true,
        fixedColumns: true,
        // order:  [5, 'desc'] ,
        order:  [0, 'asc'] ,
        processing: true,
        serverSide: true,
        method:'POST',
                lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
                language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        ajax: {
          url: "{{ route('getnotificationsinfo') }}",
          data: function (d) {
                d.model_id_filter = $('#model_id_filter').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        // ajax: "{{ route('getnewcarsinfo') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
             {data: 'notify_image', name: 'notify_image', orderable: false, searchable: false},
            {data: 'title', name: 'title'},
             
           
            {data: 'description',name: 'description'},// visible:false},
            {data: 'edit',name: 'edit', orderable: false, searchable: false},// visible:false},
            {data: 'delete',name: 'delete', orderable: false, searchable: false},// visible:false},
            {data:'main_brand_id', name: 'main_brand_id',visible:false}// visible:false},
 
        ],
        columnDefs: [{
            "defaultContent": "",
            "targets": "_all"
          }],

    });

        var table30 = $('#example30').DataTable({
        fixedColumns: true,
                dom:'lfBrtip',  

         
        order:  [0, 'asc'] ,

        processing: true,
        serverSide: true,
        method:'POST',
                lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50,100, "All"] ],
                language: {
            "url": <?php echo '"'.$language_trans.'"'; ?>
        },
        ajax: {
          url: "{{ route('getcorporatesolutionsenquiryinfo') }}",
          data: function (d) {
                d.model_id_filter = $('#model_id_filter').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        // ajax: "{{ route('getlocationsinfo') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'corporate_solutions_title', name: 'corporate_solutions_enquiry.corporate_solutions_title'},
            {data: 'first_name', name: 'corporate_solutions_enquiry.first_name'},
            {data: 'last_name', name: 'corporate_solutions_enquiry.last_name'},
            {data: 'email', name: 'corporate_solutions_enquiry.email'},
            {data: 'mobile_number', name: 'corporate_solutions_enquiry.mobile_number'},
            {data: 'leasing_options_required', name: 'corporate_solutions_enquiry.leasing_options_required',searchable: false},
            {data: 'created_at', name: 'corporate_solutions_enquiry.created_at',searchable: false},// visible:false},
            {data:'main_brand_id', name: 'main_brand_id',visible:false}// visible:false},
           
 
        ],
         buttons: [
              {
                extend: 'excel',
                text: 'Generate Excel',
                title: 'Corporate Solutions Enquiry',
                 exportOptions: {
              columns: [0,1,2,3,4,5,6,7]
             
              }
              }
              ],
        columnDefs: [{
            "defaultContent": "",
            "targets": "_all",
            
          }],

          
    });

 // $('#model_id_filter').change(function(e){
     
 //        table2.draw();
 //          e.preventDefault();

 //    });

 $('#model_id_filter').on("change", function(event){
    var brand_id = $('select[name="model_id_filter"]').val();
    console.log(brand_id);

    table2.columns(14).search(brand_id).draw();
    table23.columns(13).search(brand_id).draw();
    table27.columns(10).search(brand_id).draw();
    table25.columns(9).search(brand_id).draw();
    table20.columns(14).search(brand_id).draw();
    
    table8.columns(8).search(brand_id).draw();
    table9.columns(8).search(brand_id).draw();
    table17.columns(12).search(brand_id).draw();
    


    //table2.fnFilter("^"+ $(this).val() +"$", 9, false, false)

});

$('#car_delivery_id_filter').on("change", function(event){
    var brand_id = $('select[name="car_delivery_id_filter"]').val();
    console.log(brand_id);
     table25.columns(10).search(brand_id).draw();
});

$('#rental_car_id_filter').on("change", function(event){
    var rental_car_id_filter = $('select[name="rental_car_id_filter"]').val();
    console.log(rental_car_id_filter);
     table25.columns(12).search(rental_car_id_filter).draw();
});

$('#case_of_car_id_filter').on("change", function(event){
    var case_of_car_id_filter = $('select[name="case_of_car_id_filter"]').val();
    // console.log(case_of_car_id_filter);
     table25.columns(13).search(case_of_car_id_filter).draw();
});


 $('#device_type_filter').on("change", function(event){
    var device_type = $('select[name="device_type_filter"]').val();
    console.log("hello");

    table2.columns(9).search(device_type).draw();
    table20.columns(9).search(device_type).draw();
    
    //table8.columns(8).search(brand_id).draw();
    //table9.columns(8).search(brand_id).draw();


    //table2.fnFilter("^"+ $(this).val() +"$", 9, false, false)

});
      $('#brand_change').on("change", function(event){
    var brand_id = $('select[id="brand_change"]').val();
    // var change_header = $('select[id="brand_change"]').find(":selected").text();
    // console.log(change_header);
   // var change_h1 = $('#change_h1').text(change_header);

    table3.columns(7).search(brand_id).draw();
    table4.columns(7).search(brand_id).draw();
    table11.columns(10).search(brand_id).draw();
    table13.columns(5).search(brand_id).draw();
    table14.columns(5).search(brand_id).draw();
    table15.columns(6).search(brand_id).draw();
    table19.columns(6).search(brand_id).draw();
    table21.columns(7).search(brand_id).draw();
    table16.columns(14).search(brand_id).draw();
    //console.log(brand_id);
    if(brand_id != 4 )
    {
      $('#addbtndiv').show();
     //table3.columns(9).search(brand_id).draw();
    }
    else
    {
      $('#addbtndiv').hide();
    }


    //table2.fnFilter("^"+ $(this).val() +"$", 9, false, false)

});   
       $('#category_change').on("change", function(event){
    var category_id = $('select[id="category_change"]').val();
 
    table11.columns(11).search(category_id).draw();
 
});   

  });





    $('#main_brand_id').change(function(){
        $.get("{{ url('admin/getmodels/dropdown')}}", 
        { option: $(this).val(),car_owned_type: $('#car_owned_type').val() }, 
        function(data) {
            $('#main_model_id').empty(); 
            $('#main_version_id').empty(); 
            $.each(data, function(key, element) {
                $('#main_model_id').append("<option value='" + key +"'>" + element + "</option>");
            });
        });
    });

     $('#main_model_id').change(function(){
        $.get("{{ url('admin/getversions/dropdown')}}", 
        { option: $('#main_model_id').val() }, 
        function(data) {
          console.log($('#main_model_id').val());
            $('#main_version_id').empty(); 
            $.each(data, function(key, element) {
                $('#main_version_id').append("<option value='" + key +"'>" + element + "</option>");
            });
        });
    });

</script>
 

<script type="text/javascript">
    $(document).ready(function() {
  
      $(".btn-success").click(function(){ 
          // $(".clone").show();
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $(document).on("click", ".openImageDialog", function () {
        // alert("tradein"+$(this).data('id'));
    var myImageId = $(this).data('id');
     $(".modal-body #my_image").attr("src", myImageId);
});

//        $('#imagemodal_tradein').on("click", ".popup2", function () {
//  var imgsrc = $(this).attr('data-id');
//  console.log(imgsrc);
//  $('#my_image').attr('src',imgsrc);
// });

 

      //  $(".btn-success-accessories").click(function(){ 
      //     //  var html = $(".clone").html();
      //     // $(".increment").after(html);
      //     $("input").prop('required',true);

      // });
      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
          $(this).parents(".clone").remove();
      });
     $('.pop').on('click', function() {
      // alert("hi"+$(this).find('img').attr('src'));
      var id = $(this).find('img').attr('id');
      var description = $(this).find('img').attr('data');

      $('.imagepreview').attr('src', $(this).find('img').attr('src'));
      $('#imagemodal').modal('show');   
      // console.log(id);
       $('#delete').attr('value',id);
       $('#showdescription').val(description);
       // $('#delete').attr('value',id); 
       // console.log(id);
       // deleteItem(id); 
    });   


  

        
   var i = 1;
  $('.file-upload-box-wrapper').delegate('.cancel-entry', 'click', function(){
    if(i>1){
      $(this).parent().parent().remove();
      i--;
    }
  });
  $('.add-file-upload-btn').click(function(){
    // console.log($(this));
    $('.file-upload-box:first').clone().insertBefore($(this));
    i++;
  });
// attr({"id":"filename"+i})
//     $('.custom-file-input').on('change', function () {

//        var fileName = $(this).val().split("\\").pop();
//   $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  
//   //      var fileName = document.getElementById("filename").files[0].name;
//   // var nextSibling = e.target.nextElementSibling
//   // nextSibling.innerText = fileName
//     // let fileName = Array.from(this.files).map(x => x.name).join(', ')
//     // $(this).siblings('.custom-file-label').addClass("selected").html(fileName);
// });

    });

    // $('#delete').on('click', function() {
    //   console.log($(this).find('img').attr('id'));
    //     // deleteItem($(this).find('img').attr('id'))

    //     }); 
    function deleteItem(id) {
    if (confirm("Are you sure you want to delete the record?")) {
         var id = $(id).attr('value');
         var version_id = $('#version_id_del').val();
         // console.log(id);
         $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/interior/deleteimage') }}",

               data:{'id':id,'version_id':version_id},
               success:function(data) {
                  location.reload();
               }
            });
    }
    return false;
}    

function deleteNotificationItem(id) {
    if (confirm("Are you sure you want to delete the record?")) {
         var id = $(id).attr('value');
         // var version_id = $('#version_id_del').val();
         // console.log(id);
         $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/notifications/deleteimage') }}",

               data:{'id':id},
               success:function(data) {
                  location.reload();
               }
            });
    }
    return false;
}

    function deleteItemexterior(id) {
    if (confirm("Are you sure you want to delete the record?")) {
         var id = $(id).attr('value');
         var version_id = $('#version_id_del').val();
         // console.log(id);
         $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/exterior/deleteimage') }}",

               data:{'id':id,'version_id':version_id},
               success:function(data) {
                  location.reload();
               }
            });
    }
    return false;
}


 function deleteItemmodelimage(id) {
    if (confirm("Are you sure you want to delete the record?")) {
         var id = $(id).attr('value');
         //var version_id = $('#version_id').val();
         // console.log(id);
         $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/model/deleteimage') }}",

               data:{'id':id},
               success:function(data) {
                console.log(data);
                  location.reload();
               }
            });
    }
    return false;
}

 function deleteItemnewspromotionsimage(id) {
    if (confirm("Are you sure you want to delete the record?")) {
         var id = $(id).attr('value');
         //var version_id = $('#version_id').val();
         // console.log(id);
         $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/newspromotions/deleteimage') }}",

               data:{'id':id},
               success:function(data) {
                console.log(data);
                  location.reload();
               }
            });
    }
    return false;
}
 function deleteItemonboardingimage(id) {
    if (confirm("Are you sure you want to delete the record?")) {
         var id = $(id).attr('value');
         //var version_id = $('#version_id').val();
         // console.log(id);
         $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/onboarding/deleteimage') }}",

               data:{'id':id},
               success:function(data) {
                console.log(data);
                  location.reload();
               }
            });
    }
    return false;
}

 function deleteServicemenu(id) {
    if (confirm("Are you sure you want to delete the record?")) {
         // var id = $(id).attr('value');
         //var version_id = $('#version_id').val();
           // console.log(id);
         $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/servicemenu/delete') }}",

               data:{'id':id},
               success:function(data) {
                console.log(data);
                  location.reload();
               }
            });
    }
    return false;
}

 function deleteServiceNeeded(id) {
    if (confirm("Are you sure you want to delete the record?")) {
         // var id = $(id).attr('value');
         //var version_id = $('#version_id').val();
           // console.log(id);
         $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/serviceneeded/delete') }}",

               data:{'id':id},
               success:function(data) {
                console.log(data);
                   location.reload();
               }
            });
    }
    return false;
}

 function deleteServicePackage(id) {
    if (confirm("Are you sure you want to delete the record?")) {
         // var id = $(id).attr('value');
         //var version_id = $('#version_id').val();
           // console.log(id);
         $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/servicepackage/delete') }}",

               data:{'id':id},
               success:function(data) {
                console.log(data);
                   location.reload();
               }
            });
    }
    return false;
}

 function deleteNewsPromotions(id) {
    if (confirm("Are you sure you want to delete the record?")) {
         // var id = $(id).attr('value');
         //var version_id = $('#version_id').val();
           // console.log(id);
         $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/newspromotions/delete') }}",

               data:{'id':id},
               success:function(data) {
                console.log(data);
                   location.reload();
               }
            });
    }
    return false;
}

 function deleteOnboarding(id) {
    if (confirm("Are you sure you want to delete the record?")) {
         // var id = $(id).attr('value');
         //var version_id = $('#version_id').val();
           // console.log(id);
         $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/onboarding/delete') }}",

               data:{'id':id},
               success:function(data) {
                console.log(data);
                   location.reload();
               }
            });
    }
    return false;
}


 function deleteItemmodel(id) {
    if (confirm("Are you sure you want to delete the record?")) {
         //var id = $('delete_'+id).attr('value');
         //var version_id = $('#version_id').val();
          // console.log(id);
         $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/getmodels/delete') }}",

               data:{'id':id},
               success:function(data) {
                //console.log(data);
                   location.reload();
               }
            });
    }
    return false;
}

 function deleteItemcategory(id) {
    if (confirm("Are you sure you want to delete the record?")) {
         //var id = $('delete_'+id).attr('value');
         //var version_id = $('#version_id').val();
          // console.log(id);
         $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/specification/category/delete') }}",

               data:{'id':id},
               success:function(data) {
                //console.log(data);
                   location.reload();
               }
            });
    }
    return false;
}

 function deleteItemnotification(id) {
    if (confirm("Are you sure you want to delete the record?")) {
         //var id = $('delete_'+id).attr('value');
         //var version_id = $('#version_id').val();
          // console.log(id);
         $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/getnotifications/delete') }}",

               data:{'id':id},
               success:function(data) {
                //console.log(data);
                   location.reload();
               }
            });
    }
    return false;
}


 function deleteItemlocation(id) {
    if (confirm("Are you sure you want to delete the record?")) {
         //var id = $('delete_'+id).attr('value');
         //var version_id = $('#version_id').val();
          // console.log(id);
         $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/locations/delete') }}",

               data:{'id':id},
               success:function(data) {
                //console.log(data);
                   location.reload();
               }
            });
    }
    return false;
}

 function deleteItemcity(id) {
    if (confirm("Are you sure you want to delete the record?")) {
         //var id = $('delete_'+id).attr('value');
         //var version_id = $('#version_id').val();
          // console.log(id);
         $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/city/delete') }}",

               data:{'id':id},
               success:function(data) {
                //console.log(data);
                   location.reload();
               }
            });
    }
    return false;
}


 function deleteItemcorporatesolution(id) {
    if (confirm("Are you sure you want to delete the record?")) {
         //var id = $('delete_'+id).attr('value');
         //var version_id = $('#version_id').val();
          // console.log(id);
         $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/corporatesolution/delete') }}",

               data:{'id':id},
               success:function(data) {
                //console.log(data);
                   location.reload();
               }
            });
    }
    return false;
}


 function deleteItemversion_id(id) {
    if (confirm("Are you sure you want to delete the record?")) {
         //var id = $('delete_'+id).attr('value');
         //var version_id = $('#version_id').val();
          // console.log(id);
         $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/getversioninfo/delete') }}",

               data:{'id':id},
               success:function(data) {
                //console.log(data);
                   location.reload();
               }
            });
    }
    return false;
}

 function deleteItemversion(id) {
    if (confirm("Are you sure you want to delete the record?")) {
          var id = $(id).attr('value');
         //var version_id = $('#version_id').val();
            // console.log(id);
         $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/getversion/delete') }}",

               data:{'id':id},
               success:function(data) {
                console.log(data);
                    location.reload();
               }
            });
    }
    return false;
}


 function UpdateInsuranceStatus(id) {
    if (confirm("Are you sure you want to Change the status?")) {
          // var id = $(id).attr('value');
          var status = $('#status'+id).val();
         //var version_id = $('#version_id').val();
            // console.log(id);
         $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/updateinsurancerequest') }}",

               data:{'id':id,'status':status},
               success:function(data) {
                console.log(data);
                    location.reload();
               }
            });
    }
    return false;
} 


 function UpdateCallbackStatus(id) {
    if (confirm("Are you sure you want to Change the status?")) {
          var status = $('#status'+id).val();
         $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
               type:'POST',
               url: "{{ url('admin/updatecallbackrequest') }}",
               data:{'id':id,'status':status},
               success:function(data) {
                 //console.log(data);
                    location.reload();
               }
            });
    }
    return false;
}
 function UpdateEmergencyCallbackStatus(id) {
    if (confirm("Are you sure you want to Change the status?")) {
          var status = $('#status'+id).val();
         $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
               type:'POST',
               url: "{{ url('admin/updateemergencycallbackrequest') }}",
               data:{'id':id,'status':status},
               success:function(data) {
                 //console.log(data);
                    location.reload();
               }
            });
    }
    return false;
} 


function UpdateAvailoffersStatus(id) {
    if (confirm("Are you sure you want to Change the status?")) {
          // var id = $(id).attr('value');
          var status = $('#status'+id).val();
         //var version_id = $('#version_id').val();
            // console.log(id);
         $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/updateavailoffersrequest') }}",

               data:{'id':id,'status':status},
               success:function(data) {
                console.log(data);
                    location.reload();
               }
            });
    }
    return false;
}

function UpdateServiceStatus(id) {
    if (confirm("Are you sure you want to Change the status?")) {
          // var id = $(id).attr('value');
          var status = $('#status'+id).val();
         //var version_id = $('#version_id').val();
            // console.log(id);
         $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/updateservicestatusrequest') }}",

               data:{'id':id,'status':status},
               success:function(data) {
                console.log(data);
                    location.reload();
               }
            });
    }
    return false;
}

 function UpdateAccessoryStatus(id) {
    if (confirm("Are you sure you want to Change the status?")) {
          // var id = $(id).attr('value');
          var status = $('#status'+id).val();
         //var version_id = $('#version_id').val();
            // console.log(id);
         $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/updateaccessoryrequest') }}",

               data:{'id':id,'status':status},
               success:function(data) {
                // console.log(data);
                     location.reload();
               }
            });
    }
    return false;
}


 function UpdateInsuranceComment(id) {  
    if (confirm("Are you sure you want to Submit the comment?")) {
          // var id = $(id).attr('value');
          var comment = $('#comment').val();
     
          var fk_insurance_id = $('#addcomment').attr('data-insurance');
          var fk_user_id = $('#addcomment').attr('data-user');
 
           $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/updateinsurancecomment') }}",

               data:{'comment':comment,'fk_insurance_id':fk_insurance_id,'fk_user_id':fk_user_id},
               success:function(data) {
                // console.log(data);
                    location.reload();
               }
            });
         
    }
    return false;
} 

 function UpdateCallbackComment(id) {  
    if (confirm("Are you sure you want to Submit the comment?")) {
          // var id = $(id).attr('value');
          var comment = $('#comment').val();
     
          var fk_insurance_id = $('#addcomment').attr('data-insurance');
          var fk_user_id = $('#addcomment').attr('data-user');
 
           $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/updatecallbackcomment') }}",

               data:{'comment':comment,'fk_insurance_id':fk_insurance_id,'fk_user_id':fk_user_id},
               success:function(data) {
                // console.log(data);
                    location.reload();
               }
            });
         
    }
    return false;
} 

 function UpdateEmergencyCallbackComment(id) {  
    if (confirm("Are you sure you want to Submit the comment?")) {
          // var id = $(id).attr('value');
          var comment = $('#comment').val();
     
          var fk_insurance_id = $('#addcomment').attr('data-insurance');
          var fk_user_id = $('#addcomment').attr('data-user');
 
           $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/updateemergencycallbackcomment') }}",

               data:{'comment':comment,'fk_insurance_id':fk_insurance_id,'fk_user_id':fk_user_id},
               success:function(data) {
                // console.log(data);
                    location.reload();
               }
            });
         
    }
    return false;
} 

function UpdateAvailoffersComment(id) {  
    if (confirm("Are you sure you want to Submit the comment?")) {
          // var id = $(id).attr('value');
          var comment = $('#comment').val();
     
          var fk_availoffer_id = $('#addcomment').attr('data-availoffer');
          var fk_user_id = $('#addcomment').attr('data-user');
 
           $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/updateavailofferscomment') }}",

               data:{'comment':comment,'fk_availoffer_id':fk_availoffer_id,'fk_user_id':fk_user_id},
               success:function(data) {
                  //console.log(data);
                   location.reload();
               }
            });
         
    }
    return false;
}

 function UpdateAccessoryComment(id) {  
    if (confirm("Are you sure you want to Submit the comment?")) {
          // var id = $(id).attr('value');
          var comment = $('#comment').val();
     
          var fk_accessory_id = $('#addcommentaccessory').attr('data-fk_accessory_id');
          var fk_accessory_request_id = $('#addcommentaccessory').attr('data-fk_accessory_request_id');
          var fk_user_id = $('#addcommentaccessory').attr('data-user');
 
           $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/updateaccessorycomment') }}",

               data:{'comment':comment,'fk_accessory_id':fk_accessory_id,'fk_accessory_request_id':fk_accessory_request_id,'fk_user_id':fk_user_id},
               success:function(data) {
                // console.log(data);
                    location.reload();
               }
            });
         
    }
    return false;
}
 
 function myFunction(id) {
  var x = document.getElementById("password"+id);
  // console.log(x.type);
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}


     function readURLone(input)
     {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#display_image')
            .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }

     function commentDialogopen(req_id,fk_user_id)
     {
          $(".popupcomment").click(function() {
           // alert("inside comment popup function");
           $('#fk_insurance_id').attr('val', req_id);
           $('#fk_user_id').attr('val', fk_user_id);
           
           $('#addcomment').attr('data-insurance', req_id);

           $('#addcomment').attr('data-user', fk_user_id);

           // $('#insurance_comments_show').attr('val', insurancecomment);
           

              $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/getinsurancecommentajax') }}",

               data:{'id':req_id},
               success:function(data) {
              // console.log(data);
               $("#cardbodycomments").html("");
               if(data != 0)
               {
                  $("#cardbodycomments").html("");
                  $.each(data, function(index, value){
                    if(index != 0)
                    {
                      $("#cardbodycomments").append("<br/>");
                    }

                    $("#cardbodycomments").append("<p style='font-size:large'>" + value.comment + "</p>");


                  $("#cardbodycomments").append("<div class='commenttitle'><sub style='font-size:small'> <span class='name'>" + value.name +"    </span><span class='date'>"+value.created_at+"</span></sub></div>");
                  

                  });

                 //$('#cardbodycomments').html(data);//Show fetched data from database
               }
               else
               {
                  $("#cardbodycomments").html("");
                  $("#cardbodycomments").append("<p> No Records Found </p>");
               }
               //cardbodycomments
                    //location.reload();
               }
            });

            $('#commentmodal').modal('show'); 

      });
    } 


    function commentCallbackDialogopen(req_id,fk_user_id)
     {
          $(".popupcomment").click(function() {
           // alert("inside comment popup function");
           $('#fk_insurance_id').attr('val', req_id);
           $('#fk_user_id').attr('val', fk_user_id);
           
           $('#addcomment').attr('data-insurance', req_id);

           $('#addcomment').attr('data-user', fk_user_id);

           // $('#insurance_comments_show').attr('val', insurancecomment);
           

              $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/getcallbackcommentajax') }}",

               data:{'id':req_id},
               success:function(data) {
              // console.log(data);
               $("#cardbodycomments").html("");
               if(data != 0)
               {
                  $("#cardbodycomments").html("");
                  $.each(data, function(index, value){
                    if(index != 0)
                    {
                      $("#cardbodycomments").append("<br/>");
                    }

                    $("#cardbodycomments").append("<p style='font-size:large'>" + value.comment + "</p>");


                  $("#cardbodycomments").append("<div class='commenttitle'><sub style='font-size:small'> <span class='name'>" + value.name +"    </span><span class='date'>"+value.created_at+"</span></sub></div>");
                  

                  });

                 //$('#cardbodycomments').html(data);//Show fetched data from database
               }
               else
               {
                  $("#cardbodycomments").html("");
                  $("#cardbodycomments").append("<p> No Records Found </p>");
               }
               //cardbodycomments
                    //location.reload();
               }
            });

            $('#commentmodal').modal('show'); 

      });
    } 

    function commentEmergencyCallbackDialogopen(req_id,fk_user_id)
     {
          $(".popupcomment").click(function() {
           // alert("inside comment popup function");
           $('#fk_insurance_id').attr('val', req_id);
           $('#fk_user_id').attr('val', fk_user_id);
           
           $('#addcomment').attr('data-insurance', req_id);

           $('#addcomment').attr('data-user', fk_user_id);

           // $('#insurance_comments_show').attr('val', insurancecomment);
           

              $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/getemergencycallbackcommentajax') }}",

               data:{'id':req_id},
               success:function(data) {
              // console.log(data);
               $("#cardbodycomments").html("");
               if(data != 0)
               {
                  $("#cardbodycomments").html("");
                  $.each(data, function(index, value){
                    if(index != 0)
                    {
                      $("#cardbodycomments").append("<br/>");
                    }

                    $("#cardbodycomments").append("<p style='font-size:large'>" + value.comment + "</p>");


                  $("#cardbodycomments").append("<div class='commenttitle'><sub style='font-size:small'> <span class='name'>" + value.name +"    </span><span class='date'>"+value.created_at+"</span></sub></div>");
                  

                  });

                 //$('#cardbodycomments').html(data);//Show fetched data from database
               }
               else
               {
                  $("#cardbodycomments").html("");
                  $("#cardbodycomments").append("<p> No Records Found </p>");
               }
               //cardbodycomments
                    //location.reload();
               }
            });

            $('#commentmodal').modal('show'); 

      });
    } 

    function commentDialogopenavailoffers(req_id,fk_user_id)
     {
          $(".popupcomment").click(function() {
           // alert("inside comment popup function");
           $('#fk_availoffer_id').attr('val', req_id);
           $('#fk_user_id').attr('val', fk_user_id);
           
           $('#addcomment').attr('data-availoffer', req_id);

           $('#addcomment').attr('data-user', fk_user_id);

           // $('#insurance_comments_show').attr('val', insurancecomment);
           

              $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/getavailofferscommentajax') }}",

               data:{'id':req_id},
               success:function(data) {
              // console.log(data);
               $("#cardbodycomments").html("");
               if(data != 0)
               {
                  $("#cardbodycomments").html("");
                  $.each(data, function(index, value){
                    if(index != 0)
                    {
                      $("#cardbodycomments").append("<br/>");
                    }

                    $("#cardbodycomments").append("<p style='font-size:large'>" + value.comment + "</p>");


                  $("#cardbodycomments").append("<div class='commenttitle'><sub style='font-size:small'> <span class='name'>" + value.name +"    </span><span class='date'>"+value.created_at+"</span></sub></div>");
                  

                  });

                 //$('#cardbodycomments').html(data);//Show fetched data from database
               }
               else
               {
                  $("#cardbodycomments").html("");
                  $("#cardbodycomments").append("<p> No Records Found </p>");
               }
               //cardbodycomments
                    //location.reload();
               }
            });

            $('#commentmodal').modal('show'); 

      });
    }

    function commentDialogopenAccessory(accessory_req_id,fk_user_id,accessory_enquiry_id)
     {
          $(".popupcommentaccessory").click(function() {
           // alert("inside comment popup function");
           $('#fk_accessory_id').attr('val', accessory_req_id);
           $('#fk_accessory_request_id').attr('val', accessory_enquiry_id);
           $('#fk_user_id').attr('val', fk_user_id);
           
           $('#addcommentaccessory').attr('data-fk_accessory_id', accessory_req_id);
           $('#addcommentaccessory').attr('data-fk_accessory_request_id', accessory_enquiry_id);

           $('#addcommentaccessory').attr('data-user', fk_user_id);

   
     // $('.imagepreview').attr('src', $(this).find('img').attr('src'));
      //$('#imagemodal').modal('show');   

           // $('#insurance_comments_show').attr('val', insurancecomment);
           

              $.ajax({
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
               type:'POST',
               url: "{{ url('admin/getaccessoryrequestcommentajax') }}",

               data:{'id':accessory_req_id},
               success:function(data) {
              // console.log(data);
               $("#cardbodycommentsaccessory").html("");
               if(data != 0)
               {
                  $("#cardbodycommentsaccessory").html("");
                  $.each(data, function(index, value){
                    $('.imagepreview').attr('src', value.image_url);
                    // $('#showaccessorydescription').attr('src', value.accessories_description);
                    $('#showaccessorydescription').val(value.accessories_description);
                    $('#showaccessorytitle').val(value.accessories_title);

                    if(index != 0)
                    {
                      $("#cardbodycommentsaccessory").append("<br/>");
                    }

                    $("#cardbodycommentsaccessory").append("<p style='font-size:large'>" + value.comment + "</p>");


                  $("#cardbodycommentsaccessory").append("<div class='commenttitle'><sub style='font-size:small'> <span class='name'>" + value.name +"    </span><span class='date'>"+value.created_at+"</span></sub></div>");
                  

                  });

                 //$('#cardbodycommentsaccessory').html(data);//Show fetched data from database
               }
               else
               {
                  $("#cardbodycommentsaccessory").html("");
                  $("#cardbodycommentsaccessory").append("<p> No Records Found </p>");
               }
               //cardbodycommentsaccessory
                    //location.reload();
               }
            });

            $('#commentmodal').modal('show'); 

      });
    }

    // $('.popupcomment').on('click', function() {
    //   //alert("inside comment popup function");
    //   console.log("inside comment popup");
    //   $('#commentmodal').modal('show'); 
   
    // });   
      

$("#start_date").datepicker({
        todayBtn:  1,
        autoclose: true,
         format: "yyyy-mm-dd",
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#end_date').datepicker('setStartDate', minDate);
    });
    
    $("#end_date").datepicker()
        .on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#start_date').datepicker('setEndDate', minDate);
        });


</script>

</body>
</html>
