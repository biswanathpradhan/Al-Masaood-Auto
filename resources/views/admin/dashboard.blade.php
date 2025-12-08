@extends('layouts.maindashboard')
 
 <?php 
$language_id = Session::get('language_id');
$navigation_translations = getbackendTranslations('navigation',null,$language_id);
 ?>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-gray text-sm">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

 
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">   
          <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-language" ></i>
          <span class="badge badge-warning navbar-badge"></span> @if ($navigation_translations['navigation_language']) {{$navigation_translations['navigation_language']}} @else Language&nbsp;&nbsp; @endif  
        </a>

         <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          
          <div class="dropdown-divider"></div>
          <a href="{{route('changelanguage', 1)}}" class="dropdown-item">
            <i class="fa fa-language"></i> English
         
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{route('changelanguage', 2)}}" class="dropdown-item">
           <i class="fa fa-language"></i> ╪╣╪▒╪¿┘ë
          </a>
          <div class="dropdown-divider"></div>
           
        </div>
       
      </li>
    
@if(getUserAccessDetails() != '')
@if(in_array("29",getUserAccessDetails()))
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link"   href="{{env('APP_URL')}}/admin/getnotification">
          <i class="far fa-bell"></i>
            @if ($navigation_translations['navigation_notifications']) {{$navigation_translations['navigation_notifications']}} @else Notifications &nbsp;&nbsp; @endif  
        </a>
     <!--    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div> -->
      </li>
		  @endif
       @endif
       @if(getUserAccessDetails() != '')
      @if(in_array("31",getUserAccessDetails()))
		<!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" href="{{env('APP_URL')}}/admin/availoffers">
          <i class="fa fa-compass"></i>
          <span class="badge badge-danger navbar-badge"></span>
           @if ($navigation_translations['navigation_avail_offers']) {{$navigation_translations['navigation_avail_offers']}} @else  Avail Offers &nbsp;&nbsp; @endif

        </a>
        
      </li>
      @endif
       @endif
        @if(getUserAccessDetails() != '')
		@if(in_array("28",getUserAccessDetails()))
	<li class="nav-item d-none d-sm-inline-block">
	<a href="#" class="nav-link" data-toggle="dropdown" ><i class="fa fa-wrench fa-sm"></i>  @if ($navigation_translations['navigation_specs']) {{$navigation_translations['navigation_specs']}} @else  Specs @endif </a>

  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          
          <div class="dropdown-divider"></div>
            <a href="{{route('addcategory')}}" class="dropdown-item">
              Add Specification Category
         
          </a>  
          <a href="{{route('addspecification')}}" class="dropdown-item">
              Specifications
         
          </a>  <a href="{{route('addequipment')}}" class="dropdown-item">
              Equipments
          </a>  <a href="{{route('addinterior')}}" class="dropdown-item">
              Interiors
         
          </a>  
        <!--   <a href="{{route('addaccessories')}}" class="dropdown-item">
             Exteriors
          </a>  
 -->
        <!--   <a href="{{route('addaccessories')}}" class="dropdown-item">
              Add Accessories
         
          </a> -->
          <!-- <div class="dropdown-divider"></div>
          <a href="{{route('changelanguage', 2)}}" class="dropdown-item">
           <i class="fa fa-language"></i> ╪╣╪▒╪¿┘ë
          </a>
          <div class="dropdown-divider"></div> -->
           
        </div>

	</li>
   @endif
     @endif
     @if(getUserAccessDetails() != '')
    @if(in_array("32",getUserAccessDetails()))
	<li class="nav-item d-none d-sm-inline-block">
	<a href="#" class="nav-link" data-toggle="dropdown" ><i class="fa fa-upload fa-sm"></i> @if ($navigation_translations['navigation_brochure']) {{$navigation_translations['navigation_brochure']}} @else  Brochure @endif </a>
   <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          
          <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              Upload Brochure
         
          </a>  
          <a href="{{route('updatebrochure',url_encode(1))}}" class="dropdown-item">
              Nissan
         
          </a>  <a href="{{route('updatebrochure',url_encode(2))}}" class="dropdown-item">
              Renault
          </a>  <a href="{{route('updatebrochure',url_encode(3))}}" class="dropdown-item">
              Infinity
         
          </a>  
       
           
        </div>

	</li>
  @endif
  @endif
	<li class="nav-item d-none d-sm-inline-block">

    <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out-alt"></i> @if ($navigation_translations['navigation_signout']) {{$navigation_translations['navigation_signout']}} @else  Sign out @endif  
                                    </a>

                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
	</li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
 
@if (Route::current()->getName() == 'dashboard')
  @include('admin.dashboardWidget')
@endif
@if (Route::current()->getName() == 'manageusers')
  @include('admin.manageUsers')
@endif

@if (Route::current()->getName() == 'adduser')
  @include('admin.add_user')
@endif

@if (Route::current()->getName() == 'edituser')
  @include('admin.edit_user')
@endif

@if (Route::current()->getName() == 'customers')
  @include('admin.customerlist')
@endif

@if (Route::current()->getName() == 'availoffers')
  @include('admin.availoffers')
@endif

@if (Route::current()->getName() == 'pickupcar')
  @include('admin.pickupcar')
@endif

@if (Route::current()->getName() == 'callbackrequest')
  @include('admin.callbackrequest')
@endif

@if (Route::current()->getName() == 'emergencycall')
  @include('admin.emergencycall')
@endif

@if (Route::current()->getName() == 'customercars')
  @include('admin.customercarslist')
@endif
@if (Route::current()->getName() == 'getnewcars')
  @include('admin.models')
@endif

@if (Route::current()->getName() == 'getnotification')
  @include('admin.notifications')
@endif
@if (Route::current()->getName() == 'getpreownedcars')
  @include('admin.modelspreowned')
@endif
@if (Route::current()->getName() == 'addnewcars')
  @include('admin.addcar')
@endif

@if (Route::current()->getName() == 'sendcustomernotification')
  @include('admin.add_customer_notification')
@endif

@if (Route::current()->getName() == 'addnotification')
  @include('admin.addnotification')
@endif

@if (Route::current()->getName() == 'editnotification')
  @include('admin.editnotification')
@endif
@if (Route::current()->getName() == 'addspecification')
  @include('admin.addspecification')
@endif
@if (Route::current()->getName() == 'editspecification')
  @include('admin.editspecification')
@endif
@if (Route::current()->getName() == 'addequipment')
  @include('admin.addequipment')
@endif

@if (Route::current()->getName() == 'getversioninfobymodellist')
  @include('admin.versionlist')
@endif
@if (Route::current()->getName() == 'getversionspecificationlist')
  @include('admin.specificationlist')
@endif
@if (Route::current()->getName() == 'getversionequipmentlist')
  @include('admin.equipmentlist')
@endif

@if (Route::current()->getName() == 'addcategory')
  @include('admin.addcategory')
@endif

@if (Route::current()->getName() == 'editcategory')
  @include('admin.editcategory')
@endif

@if (Route::current()->getName() == 'getcategorylist')
  @include('admin.categorylist')
@endif

@if (Route::current()->getName() == 'addversion')
  @include('admin.addversion')
@endif

@if (Route::current()->getName() == 'addservicemenu')
  @include('admin.addservicemenu')
@endif

@if (Route::current()->getName() == 'addserviceneeded')
  @include('admin.addserviceneeded')
@endif

@if (Route::current()->getName() == 'addservicepackage')
  @include('admin.addservicepackage')
@endif

@if (Route::current()->getName() == 'editversion')
  @include('admin.editversion')
@endif
@if (Route::current()->getName() == 'editservicemenu')
  @include('admin.editservicemenu')
@endif

@if (Route::current()->getName() == 'editserviceneeded')
  @include('admin.editserviceneeded')
@endif

@if (Route::current()->getName() == 'editservicepackage')
  @include('admin.editservicepackage')
@endif

@if (Route::current()->getName() == 'editnewspromotion')
  @include('admin.editnewspromotions')
@endif

@if (Route::current()->getName() == 'editonboarding')
  @include('admin.editonboarding')
@endif

@if (Route::current()->getName() == 'getversioninterior')
  @include('admin.editinterior')
@endif

@if (Route::current()->getName() == 'getversionexterior')
  @include('admin.editexterior')
@endif
@if (Route::current()->getName() == 'gettestdrivelist')
  @include('admin.testdrive')
@endif
@if (Route::current()->getName() == 'gettradeinlist')
  @include('admin.tradein')
@endif

@if (Route::current()->getName() == 'getcorporatesolutionslist')
  @include('admin.corporatesolutions')
@endif

@if (Route::current()->getName() == 'getcorporatesolutionsenquirylist')
  @include('admin.corporate_enquiries')
@endif

@if (Route::current()->getName() == 'getservicepackagerequestlist')
  @include('admin.servicepackagerequest')
@endif

@if (Route::current()->getName() == 'locationshowroomlist')
  @include('admin.locationslist')
@endif

@if (Route::current()->getName() == 'citylist')
  @include('admin.citylist')
@endif

@if (Route::current()->getName() == 'addlocation')
  @include('admin.addlocation')
@endif

@if (Route::current()->getName() == 'addcity')
  @include('admin.addcity')
@endif

@if (Route::current()->getName() == 'addcorporatesolutions')
  @include('admin.addcorporatesolution')
@endif

@if (Route::current()->getName() == 'editlocation')
  @include('admin.editlocation')
@endif
 
 @if (Route::current()->getName() == 'editcity')
  @include('admin.editcity')
@endif
 
  @if (Route::current()->getName() == 'editcorporatesolution')
  @include('admin.editcorporatesolution')
@endif
 


@if (Route::current()->getName() == 'getquoteslist')
  @include('admin.quotes')
@endif

@if (Route::current()->getName() == 'editnewcar')
  @include('admin.editcar')
@endif

@if (Route::current()->getName() == 'getversionaccessories')
  @include('admin.editaccessories')
@endif

@if (Route::current()->getName() == 'editcustomer')
  @include('admin.editcustomer')
@endif

@if (Route::current()->getName() == 'getservicemenu')
  @include('admin.servicemenu')
@endif

@if (Route::current()->getName() == 'getserviceneeded')
  @include('admin.serviceneeded')
@endif
@if (Route::current()->getName() == 'getservicepackages')
  @include('admin.servicepackages')
@endif

@if (Route::current()->getName() == 'getappointments')
  @include('admin.appointments')
@endif


@if (Route::current()->getName() == 'getnewspromotions')
  @include('admin.newspromotions')
@endif

@if (Route::current()->getName() == 'getonboarding')
  @include('admin.onboarding')
@endif

@if (Route::current()->getName() == 'addaccessories')
  @include('admin.addaccessories')
@endif

@if (Route::current()->getName() == 'updatebrochure')
  @include('admin.updatebrochure')
@endif

@if (Route::current()->getName() == 'addinterior')
  @include('admin.addinterior')
@endif

@if (Route::current()->getName() == 'addNewspromotion')
  @include('admin.addnewspromotion')
@endif

@if (Route::current()->getName() == 'addonboarding')
  @include('admin.addonboarding')
@endif

@if (Route::current()->getName() == 'insurancerequest')
  @include('admin.insurancerequestlist')
@endif
 
 @if (Route::current()->getName() == 'accessoryrequest')
  @include('admin.accessoryrequestlist')
@endif
 
  </div>
  <!-- /.content-wrapper -->

   
<script>
   
  if(window.location.pathname == '/newsite/admin/dashboard')
  {
      setTimeout(function(){
      window.location.reload(1);
      }, 10000);
  }

</script>
