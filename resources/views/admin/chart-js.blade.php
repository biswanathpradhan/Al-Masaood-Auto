<<<<<<< HEAD
@extends('layouts.maindashboard')
<?php 
$language_id = Session::get('language_id');
$navigation_translations = getbackendTranslations('navigation',null,$language_id);
$service_menu_translations = getbackendTranslations('',null,$language_id);
$breadcrumb_translations = getbackendTranslations('breadcrumb ',null,$language_id);
$corporate_translations = getbackendTranslations('',null,$language_id);

 ?> 
 
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/css/bootstrap-datepicker.css">
<link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">


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

          <i class="fa fa-language"></i>

          <span class="badge badge-warning navbar-badge"></span>  Language   

        </a>

 

         <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">


          <div class="dropdown-divider"></div>

          <a href="http://amaauto.markacommunications.com/admin/languageupdate/1" class="dropdown-item">

            <i class="fa fa-language"></i> English


          </a>

          <div class="dropdown-divider"></div>

          <a href="http://amaauto.markacommunications.com/admin/languageupdate/2" class="dropdown-item">

           <i class="fa fa-language"></i> عربى

          </a>

          <div class="dropdown-divider"></div>


        </div>


      </li>


      <!-- Notifications Dropdown Menu -->

      <li class="nav-item dropdown">

        <a class="nav-link" href="/admin/getnotification">

          <i class="far fa-bell"></i>

             Notifications   

        </a>

      </li>

                                      <!-- Messages Dropdown Menu -->

      <li class="nav-item dropdown">

        <a class="nav-link" href="/admin/availoffers">

          <i class="fa fa-compass"></i>

          <span class="badge badge-danger navbar-badge"></span>

            Avail Offers 

        </a>


      </li>

                                 <li class="nav-item d-none d-sm-inline-block">

    <a href="#" class="nav-link" data-toggle="dropdown"><i class="fa fa-wrench fa-sm"></i>   Specs  </a>

 

  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">


          <div class="dropdown-divider"></div>

            <a href="http://amaauto.markacommunications.com/admin/specification/category/add" class="dropdown-item">

              Add Specification Category


          </a>  

          <a href="http://amaauto.markacommunications.com/admin/specification/add" class="dropdown-item">

              Specifications


          </a>  <a href="http://amaauto.markacommunications.com/admin/equipment/add" class="dropdown-item">

              Equipments

          </a>  <a href="http://amaauto.markacommunications.com/admin/interiors/add" class="dropdown-item">

              Interiors


          </a>  
        </div>

 

    </li>

                     <li class="nav-item d-none d-sm-inline-block">

    <a href="#" class="nav-link" data-toggle="dropdown"><i class="fa fa-upload fa-sm"></i>  Brochure  </a>

   <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">


          <div class="dropdown-divider"></div>

            <a href="#" class="dropdown-item">

              Upload Brochure


          </a>  

          <a href="http://amaauto.markacommunications.com/admin/brochure/updatebrochure/MQ==" class="dropdown-item">

              Nissan


          </a>  <a href="http://amaauto.markacommunications.com/admin/brochure/updatebrochure/Mg==" class="dropdown-item">

              Renault

          </a>  <a href="http://amaauto.markacommunications.com/admin/brochure/updatebrochure/Mw==" class="dropdown-item">

              Infinity


          </a>  



        </div>

 

    </li>

        <li class="nav-item d-none d-sm-inline-block">

 

    <a class="nav-link" href="http://amaauto.markacommunications.com/logout" onclick="event.preventDefault();

                                                     document.getElementById('logout-form').submit();">

                                        <i class="fa fa-sign-out-alt"></i>  Sign Out   

                                    </a>

 

                                     <form id="logout-form" action="http://amaauto.markacommunications.com/logout" method="POST" style="display: none;">

                                        <input type="hidden" name="_token" value="u6iW6VtAiBXpOuDgrgccNZ7Nl5tcmCUhbOINdIig">                                    </form>

    </li>

    </ul>

  </nav>

 <div class="content-wrapper">
   <div class="content-header">
       
              <div class="container-fluid">
<section class="content">
 

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
						    
    <h1 class="m-0 text-dark">List of Customers Downloaded V/s Signed Up</h1>
    
    <form method="post" action="chart-js/submit" enctype="multipart/form-data">
        {{ csrf_field() }}
    <div class="form-row">
           
            <div class="col-md-3">
            <label for="exampleInputEmail1">To date </label>
                   <input class="form-control" type="date" placeholder="" id="to_date" name="to_date">
              </div>
               <div class="col-md-3">

             <label for="exampleInputEmail1">From date </label>
                  <input class="form-control" type="date" placeholder="" id="from_date" name="from_date">
            </div>
                
                 <div class="col" style="margin-top: 2rem;">
                     <label for=""> </label>
                    <button type="submit" id="dateSearch" class="btn btn-primary" ><i class="fa fa-search"></i> Search</button>
                </div>
 
          </div>
          </form>

    
    <?php 
    $registered=array();
    $unregistered=array();
    $date=array();
    
    foreach($customers as $key=>$value){
        
        $registered[]=$value->registered;
        $unregistered[]=$value->unregistered;
        $date[]=$value->created_at;
    }
       $registered=json_encode($registered);
       $unregistered=json_encode($unregistered);
       $date=json_encode($date);
   // print_r($registered);exit;
    //print_r($unregistered);
    ?>
    
    <div id="container"></div>
    </div>
</div>
</div>
</div>

</section>
</div>
</div>

</div>

<script src="https://code.highcharts.com/highcharts.js"></script>

<script type="text/javascript">
    var registered = <?php echo $registered; ?>;
    var unregistered = <?php echo $unregistered; ?>;
    var date = <?php echo ($date); ?>;
    Highcharts.chart('container', {
        title: {
            text: 'New User, 2023'
        },
        subtitle: {
           // text: 'Source: positronx.io'
        },
        xAxis: {
            categories: date
       // categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
       //         'October', 'November', 'December'
         //   ]
        },
        yAxis: {
            title: {
                text: 'Number of New Users'
            }
        },
        legend: {
            layout: 'horizontal',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Signup',
            data: registered
        },
        {
            name: 'Downloaded',
            data: unregistered
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
    
     
        

   
   $("#from_date").datepicker({
        todayBtn:  1,
        autoclose: true,
         format: "yyyy-mm-dd",
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#to_date').datepicker('setStartDate', minDate);
    });
    
    $("#to_date").datepicker()
        .on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#from_date').datepicker('setEndDate', minDate);
        });

 
    
</script>
</html>

=======
@extends('layouts.maindashboard')
<?php 
$language_id = Session::get('language_id');
$navigation_translations = getbackendTranslations('navigation',null,$language_id);
$service_menu_translations = getbackendTranslations('',null,$language_id);
$breadcrumb_translations = getbackendTranslations('breadcrumb ',null,$language_id);
$corporate_translations = getbackendTranslations('',null,$language_id);

 ?> 
 
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/css/bootstrap-datepicker.css">
<link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">


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

          <i class="fa fa-language"></i>

          <span class="badge badge-warning navbar-badge"></span>  Language   

        </a>

 

         <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">


          <div class="dropdown-divider"></div>

          <a href="http://amaauto.markacommunications.com/admin/languageupdate/1" class="dropdown-item">

            <i class="fa fa-language"></i> English


          </a>

          <div class="dropdown-divider"></div>

          <a href="http://amaauto.markacommunications.com/admin/languageupdate/2" class="dropdown-item">

           <i class="fa fa-language"></i> عربى

          </a>

          <div class="dropdown-divider"></div>


        </div>


      </li>


      <!-- Notifications Dropdown Menu -->

      <li class="nav-item dropdown">

        <a class="nav-link" href="/admin/getnotification">

          <i class="far fa-bell"></i>

             Notifications   

        </a>

      </li>

                                      <!-- Messages Dropdown Menu -->

      <li class="nav-item dropdown">

        <a class="nav-link" href="/admin/availoffers">

          <i class="fa fa-compass"></i>

          <span class="badge badge-danger navbar-badge"></span>

            Avail Offers 

        </a>


      </li>

                                 <li class="nav-item d-none d-sm-inline-block">

    <a href="#" class="nav-link" data-toggle="dropdown"><i class="fa fa-wrench fa-sm"></i>   Specs  </a>

 

  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">


          <div class="dropdown-divider"></div>

            <a href="http://amaauto.markacommunications.com/admin/specification/category/add" class="dropdown-item">

              Add Specification Category


          </a>  

          <a href="http://amaauto.markacommunications.com/admin/specification/add" class="dropdown-item">

              Specifications


          </a>  <a href="http://amaauto.markacommunications.com/admin/equipment/add" class="dropdown-item">

              Equipments

          </a>  <a href="http://amaauto.markacommunications.com/admin/interiors/add" class="dropdown-item">

              Interiors


          </a>  
        </div>

 

    </li>

                     <li class="nav-item d-none d-sm-inline-block">

    <a href="#" class="nav-link" data-toggle="dropdown"><i class="fa fa-upload fa-sm"></i>  Brochure  </a>

   <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">


          <div class="dropdown-divider"></div>

            <a href="#" class="dropdown-item">

              Upload Brochure


          </a>  

          <a href="http://amaauto.markacommunications.com/admin/brochure/updatebrochure/MQ==" class="dropdown-item">

              Nissan


          </a>  <a href="http://amaauto.markacommunications.com/admin/brochure/updatebrochure/Mg==" class="dropdown-item">

              Renault

          </a>  <a href="http://amaauto.markacommunications.com/admin/brochure/updatebrochure/Mw==" class="dropdown-item">

              Infinity


          </a>  



        </div>

 

    </li>

        <li class="nav-item d-none d-sm-inline-block">

 

    <a class="nav-link" href="http://amaauto.markacommunications.com/logout" onclick="event.preventDefault();

                                                     document.getElementById('logout-form').submit();">

                                        <i class="fa fa-sign-out-alt"></i>  Sign Out   

                                    </a>

 

                                     <form id="logout-form" action="http://amaauto.markacommunications.com/logout" method="POST" style="display: none;">

                                        <input type="hidden" name="_token" value="u6iW6VtAiBXpOuDgrgccNZ7Nl5tcmCUhbOINdIig">                                    </form>

    </li>

    </ul>

  </nav>

 <div class="content-wrapper">
   <div class="content-header">
       
              <div class="container-fluid">
<section class="content">
 

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
						    
    <h1 class="m-0 text-dark">List of Customers Downloaded V/s Signed Up</h1>
    
    <form method="post" action="chart-js/submit" enctype="multipart/form-data">
        {{ csrf_field() }}
    <div class="form-row">
           
            <div class="col-md-3">
            <label for="exampleInputEmail1">To date </label>
                   <input class="form-control" type="date" placeholder="" id="to_date" name="to_date">
              </div>
               <div class="col-md-3">

             <label for="exampleInputEmail1">From date </label>
                  <input class="form-control" type="date" placeholder="" id="from_date" name="from_date">
            </div>
                
                 <div class="col" style="margin-top: 2rem;">
                     <label for=""> </label>
                    <button type="submit" id="dateSearch" class="btn btn-primary" ><i class="fa fa-search"></i> Search</button>
                </div>
 
          </div>
          </form>

    
    <?php 
    $registered=array();
    $unregistered=array();
    $date=array();
    
    foreach($customers as $key=>$value){
        
        $registered[]=$value->registered;
        $unregistered[]=$value->unregistered;
        $date[]=$value->created_at;
    }
       $registered=json_encode($registered);
       $unregistered=json_encode($unregistered);
       $date=json_encode($date);
   // print_r($registered);exit;
    //print_r($unregistered);
    ?>
    
    <div id="container"></div>
    </div>
</div>
</div>
</div>

</section>
</div>
</div>

</div>

<script src="https://code.highcharts.com/highcharts.js"></script>

<script type="text/javascript">
    var registered = <?php echo $registered; ?>;
    var unregistered = <?php echo $unregistered; ?>;
    var date = <?php echo ($date); ?>;
    Highcharts.chart('container', {
        title: {
            text: 'New User, 2023'
        },
        subtitle: {
           // text: 'Source: positronx.io'
        },
        xAxis: {
            categories: date
       // categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
       //         'October', 'November', 'December'
         //   ]
        },
        yAxis: {
            title: {
                text: 'Number of New Users'
            }
        },
        legend: {
            layout: 'horizontal',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Signup',
            data: registered
        },
        {
            name: 'Downloaded',
            data: unregistered
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
    
     
        

   
   $("#from_date").datepicker({
        todayBtn:  1,
        autoclose: true,
         format: "yyyy-mm-dd",
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#to_date').datepicker('setStartDate', minDate);
    });
    
    $("#to_date").datepicker()
        .on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#from_date').datepicker('setEndDate', minDate);
        });

 
    
</script>
</html>

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
 