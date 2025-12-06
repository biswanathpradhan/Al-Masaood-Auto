  <?php 
$language_id = Session::get('language_id');
$dashboard_translations = getbackendTranslations('dashboard ',null,$language_id);
$breadcrumb_translations = getbackendTranslations('breadcrumb ',null,$language_id);
 ?>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">@if ($dashboard_translations['dashboard_heading_dashboard']) {{$dashboard_translations['dashboard_heading_dashboard']}} @else Dashboard  @endif </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">@if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
            <li class="breadcrumb-item active">@if ($breadcrumb_translations['breadcrumb_dashboard']) {{$breadcrumb_translations['breadcrumb_dashboard']}} @else Dashboard @endif</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
     <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-ion-1">
              <div class="inner">
                <h3>{{getDashboardcount()['livechatcount']}}</h3>
                <p>@if ($dashboard_translations['live_chat']) {{$dashboard_translations['live_chat']}} @else LIVE CHAT  @endif</p>
              </div>
              <div class="icon">
                <i class="ion ion-chatboxes-wrapper ion-chat">&nbsp;</i>
              </div>
              <a href="{{env('APP_URL')}}/admin/customers" class="small-box-footer">@if ($dashboard_translations['more_info']) {{$dashboard_translations['more_info']}} @else @if ($dashboard_translations['more_info']) {{$dashboard_translations['more_info']}} @else More info @endif @endif <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-ion-2">
              <div class="inner">
                <h3>{{getDashboardcount()['emergencycallcount']}}</h3>
                
                <p>@if ($dashboard_translations['emergency_call']) {{$dashboard_translations['emergency_call']}} @else EMERGENCY CALL  @endif</p>
              </div>
              <div class="icon">
                <i class="ion ion-chatboxes-wrapper ion-emergency-call">&nbsp;</i>
              </div>
              <a href="{{env('APP_URL')}}/admin/emergencycall" class="small-box-footer">@if ($dashboard_translations['more_info']) {{$dashboard_translations['more_info']}} @else More info @endif <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-ion-4">
              <div class="inner">
                <h3>{{getDashboardcount()['callbackrequestcount']}}</h3>
                <p>@if ($dashboard_translations['callback_request']) {{$dashboard_translations['callback_request']}} @else CALL BACK REQUEST @endif</p>
              </div>
              <div class="icon">
                <i class="ion ion-chatboxes-wrapper call-back-request">&nbsp;</i>
              </div>
              <a href="{{env('APP_URL')}}/admin/callbackrequest" class="small-box-footer">@if ($dashboard_translations['more_info']) {{$dashboard_translations['more_info']}} @else More info @endif <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->


          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-ion-3">
              <div class="inner">
                <h3>{{getDashboardcount()['pickupcarcount']}} </h3>
                <p>@if ($dashboard_translations['pickup_call']) {{$dashboard_translations['pickup_call']}} @else PICKUP CALL @endif</p>
              </div>
              <div class="icon">
                <i class="ion ion-chatboxes-wrapper pickup-car">&nbsp;</i>
              </div>
              <a href="{{env('APP_URL')}}/admin/pickupcar" class="small-box-footer">@if ($dashboard_translations['more_info']) {{$dashboard_translations['more_info']}} @else More info @endif <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-ion-6">
              <div class="inner">
                <h3>{{getDashboardcount()['testdrivecount']}}</h3>
                <p>@if ($dashboard_translations['test_drive']) {{$dashboard_translations['test_drive']}} @else TEST DRIVE @endif</p>
              </div>
              <div class="icon">
                <i class="ion ion-chatboxes-wrapper test-drive">&nbsp;</i>
              </div>
              <a href="{{env('APP_URL')}}/admin/testdrive" class="small-box-footer">@if ($dashboard_translations['more_info']) {{$dashboard_translations['more_info']}} @else More info @endif <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->


          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-ion-7">
              <div class="inner">
                <h3>{{getDashboardcount()['quotescount']}}</h3>
                <p>@if ($dashboard_translations['get_a_quote']) {{$dashboard_translations['get_a_quote']}} @else GET A QUOTE @endif</p>
              </div>
              <div class="icon">
                <i class="ion ion-chatboxes-wrapper get-a-quote">&nbsp;</i>
              </div>
              <a href="{{env('APP_URL')}}/admin/quotes" class="small-box-footer">@if ($dashboard_translations['more_info']) {{$dashboard_translations['more_info']}} @else More info @endif <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-ion-8">
              <div class="inner">
                <h3>{{getDashboardcount()['availofferscount']}}</h3>
                <p>@if ($dashboard_translations['avail_offers']) {{$dashboard_translations['avail_offers']}} @else AVAIL OFFERS @endif</p>
              </div>
              <div class="icon">
                <i class="ion ion-chatboxes-wrapper avail-offers">&nbsp;</i>
              </div>
              <a href="{{env('APP_URL')}}/admin/availoffers" class="small-box-footer">@if ($dashboard_translations['more_info']) {{$dashboard_translations['more_info']}} @else More info @endif <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

      <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-ion-11">
              <div class="inner">
                <h3>{{getDashboardcount()['appointmentscount']}}</h3>
                <p>@if ($dashboard_translations['appointment']) {{$dashboard_translations['appointment']}} @else APPOINTMENT @endif</p>  
              </div>
              <div class="icon">
                <i class="ion ion-chatboxes-wrapper appointment"></i>
              </div>
              <a href="{{env('APP_URL')}}/admin/appointments" class="small-box-footer">@if ($dashboard_translations['more_info']) {{$dashboard_translations['more_info']}} @else More info @endif <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

      <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-ion-11">
              <div class="inner">
                <h3>{{getDashboardcount()['tradeincount']}}</h3>
                <p>@if ($dashboard_translations['trade_in']) {{$dashboard_translations['trade_in']}} @else TRADE IN @endif</p>
              </div>
              <div class="icon">
                <i class="ion ion-chatboxes-wrapper trade-in"></i>
              </div>
              <a href="{{env('APP_URL')}}/admin/tradein" class="small-box-footer">@if ($dashboard_translations['more_info']) {{$dashboard_translations['more_info']}} @else More info @endif <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->  

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-ion-12">
              <div class="inner">
                <h3>{{getDashboardcount()['leasecarcount']}}</h3>
                <p>@if ($dashboard_translations['lease_this_car']) {{$dashboard_translations['lease_this_car']}} @else LEASE THIS CAR @endif</p>
              </div>
              <div class="icon">
                <i class="ion ion-chatboxes-wrapper lease-car"></i>
              </div>
              <a href="#" class="small-box-footer">@if ($dashboard_translations['more_info']) {{$dashboard_translations['more_info']}} @else More info @endif <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->  

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-ion-13">
              <div class="inner">
                <h3>{{getDashboardcount()['accessoryrequestcount']}}</h3>
                <p>@if ($dashboard_translations['accessory_request']) {{$dashboard_translations['accessory_request']}} @else ACCESSORY REQUEST @endif</p>
              </div>
              <div class="icon">
                <i class="ion ion-chatboxes-wrapper accessory-request"></i>
              </div>
              <a href="{{env('APP_URL')}}/admin/accessoryrequest" class="small-box-footer">@if ($dashboard_translations['more_info']) {{$dashboard_translations['more_info']}} @else More info @endif <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->  

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-ion-14">
              <div class="inner">
                <h3>{{getDashboardcount()['insurancerequestcount']}}</h3>
                <p>@if ($dashboard_translations['dashboard_insurance_request']) {{$dashboard_translations['dashboard_insurance_request']}} @else INSURANCE REQUEST @endif</p>
              </div>
              <div class="icon">
                <i class="ion ion-chatboxes-wrapper insurance-request"></i>
              </div>
              <a href="{{env('APP_URL')}}/admin/insurancerequest" class="small-box-footer">@if ($dashboard_translations['more_info']) {{$dashboard_translations['more_info']}} @else More info @endif <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->  

        </div>
        <!-- /.row -->
       

        </div>
        <!-- /.row -->
      
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->