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
            <h1 class="m-0 text-dark">@if ($manage_users_translations['heading_manage_users']) {{$manage_users_translations['heading_manage_users']}} @else Managing Users @endif </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa fa-tachometer-alt"></i> @if ($breadcrumb_translations['breadcrumb_home']) {{$breadcrumb_translations['breadcrumb_home']}} @else Home @endif</a></li>
              <li class="breadcrumb-item active">@if ($breadcrumb_translations['breadcrumb_admin_manage']) {{$breadcrumb_translations['breadcrumb_admin_manage']}} @else Admin Manage @endif </li>
            </ol>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-md-2">
            <a type="button" class="btn-sm btn-primary" href="{{route('adduser')}}">@if ($manage_users_translations['btn_create_new']) {{$manage_users_translations['btn_create_new']}} @else Create New @endif </a>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary card-outline">
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>@if ($manage_users_translations['Id']) {{$manage_users_translations['Id']}} @else ID @endif</th>
                    <th>@if ($manage_users_translations['email']) {{$manage_users_translations['email']}} @else Email @endif</th>
                    <th>@if ($manage_users_translations['password']) {{$manage_users_translations['password']}} @else Password @endif</th>
                    <th>@if ($manage_users_translations['edit']) {{$manage_users_translations['edit']}} @else Edit @endif</th>
                    <th>@if ($manage_users_translations['action']) {{$manage_users_translations['action']}} @else Action @endif</th>
                  </tr>
                </thead>
                <tbody>
                   
                </tbody>
               
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>

