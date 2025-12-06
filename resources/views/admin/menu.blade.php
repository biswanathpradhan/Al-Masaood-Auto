<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			<li class="nav-item">
				<a href="{{env('APP_URL')}}/admin/dashboard" @if (Route::current()->getName() == "dashboard") class="nav-link active" @else class="nav-link" @endif>
				  <i class="nav-icon fa fa-tachometer-alt"></i><p>Dashboard</p>
				</a>
			</li>
			<!-- <li class="nav-item">
				<a href="../pages/gallery.html" class="nav-link">
				  <i class="nav-icon fa fa-envelope"></i><p>Chat</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="../pages/gallery.html" class="nav-link">
				  <i class="nav-icon fa fa-phone-square"></i><p>Emergency call service</p>
				</a>
			</li> 
			<li class="nav-item">
				<a href="../pages/gallery.html" class="nav-link">
				  <i class="nav-icon fa fa-phone-square"></i><p>Call Back Request</p>
				</a>
			</li>-->
			<li class="nav-item">
				<a href="{{env('APP_URL')}}/admin/manageusers" @if (Route::current()->getName() == "manageusers") class="nav-link active" @else class="nav-link" @endif>
				  <i class="nav-icon ion ion-person-add"></i><p>Managing Users</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="{{env('APP_URL')}}/admin/customers" @if (Route::current()->getName() == "customers") class="nav-link active" @else class="nav-link" @endif>
				  <i class="nav-icon ion ion-person-add"></i><p>Customers</p>
				</a>
			</li>
			<!-- <li class="nav-item">
				<a href="../pages/gallery.html" class="nav-link">
				  <i class="nav-icon fa ion-easel"></i><p>Onboarding Screens</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="../pages/gallery.html" class="nav-link">
				  <i class="nav-icon fa fa-car"></i><p>New Car Models</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="../pages/gallery.html" class="nav-link">
				  <i class="nav-icon fa fa-car"></i><p>Pre Owned Cars Models</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="../pages/gallery.html" class="nav-link">
				  <i class="nav-icon fa fa-flag"></i><p>Corporate Solutions</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="../pages/gallery.html" class="nav-link">
				  <i class="nav-icon fa fa-flag"></i><p>Service Menu</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="../pages/gallery.html" class="nav-link">
				  <i class="nav-icon fa fa-flag"></i><p>Service Needed</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="../pages/gallery.html" class="nav-link">
				  <i class="nav-icon fa fa-flag"></i><p>Service Packages</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="../pages/gallery.html" class="nav-link">
				  <i class="nav-icon fa fa-flag"></i><p>Appointments</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="../pages/gallery.html" class="nav-link">
				  <i class="nav-icon fa fa-flag"></i><p>Pickup Car</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="../pages/gallery.html" class="nav-link">
				  <i class="nav-icon fa fa-flag"></i><p>News &amp; Promotions</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="../pages/gallery.html" class="nav-link">
				  <i class="nav-icon fa fa-flag"></i><p>Location/Showroom</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="../pages/gallery.html" class="nav-link">
				  <i class="nav-icon fa fa-flag"></i><p>Test Drive</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="../pages/gallery.html" class="nav-link">
				  <i class="nav-icon fa fa-flag"></i><p>Get A Quote</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="../pages/gallery.html" class="nav-link">
				  <i class="nav-icon fa fa-flag"></i><p>Trade In</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="../pages/gallery.html" class="nav-link">
				  <i class="nav-icon fa fa-flag"></i><p>City</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="../pages/gallery.html" class="nav-link">
				  <i class="nav-icon fa fa-key"></i><p>Change Password</p>
				</a>
			</li>-->
			<li class="nav-item">
		 
				<a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form2').submit();">
                                        <i class="nav-icon fa fa-sign-out-alt"></i> Sign out
                                    </a>

                                     <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
			</li>
         
			
        </ul>
      </nav>