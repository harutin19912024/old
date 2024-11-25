@extends('layouts.admin')

@section('content')
<!-- Start: Topbar -->
<header id="topbar">
  <div class="topbar-left">
    <ol class="breadcrumb">
      <li class="crumb-active">
        <a href="/">Dashboard</a>
      </li>
      <li class="crumb-icon">
        <a href="/">
          <span class="glyphicon glyphicon-home"></span>
        </a>
      </li>
      <li class="crumb-link">
        <a>{{ Route::currentRouteNamed('users.create') ? 'Add' : 'Edit' }} User</a>
      </li>
      <!--<li class="crumb-trail">Dashboard</li>-->
      @if(Session::has('message'))
            <div class="alert alert-info">
                <strong>{{Session::get('message')}}</strong>
            </div>
        @endif
    </ol>
  </div>

</header>
<!-- End: Topbar -->
<?php // var_dump($errors->first('type') );die; ?>
<section id="content" class="table-layout animated fadeIn">

        <!-- begin: .tray-center -->
        <div class="tray tray-center">

          <div class="mw1000 center-block">

            <div class="tray tray-center">

            <!-- Validation Example -->
            <div class="admin-form theme-primary mw1000 center-block" style="padding-bottom: 175px;">
            <div class="panel">
                <div class="panel-heading">
                  <span class="panel-title">Add User</span>
                </div>
                <div class="panel-body">

                    <form id="admin-form" class="form-horizontal" role="form" method="POST" action="{{ Route::currentRouteNamed('users.create') ? route('users.store') : route('users.update', ['id' => $data->id]) }}" autocomplete="off">
                    <input type="hidden" name="_method" value="{{ Route::currentRouteNamed('users.create') ? 'POST' : 'PUT' }}">
                    {{ csrf_field() }}
                    
                    <div class="form-group">
                      <label for="role" class="col-lg-3 control-label">Role</label>
                      <div class="col-lg-8">
                        <label for="firstname" class="field {{ $errors->has('type') ? 'state-error' : ''}}">
                            <select class="gui-input" id="type" name="role">
                                <option value="">Select Role...</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ (!is_null(old('role')) && old('role') == $role->id) || (isset($data) && $data->hasRole($role->name)) ? 'selected' : '' }} >{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </label>
                          @if($errors->has('role'))
							<em for="role" class="state-error">{{$errors->first('role') }}</em>
                          @endif
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="name" class="col-lg-3 control-label">Full Name</label>
                      <div class="col-lg-8">
                        <label for="name" class="field {{ $errors->has('name') ? 'state-error' : ''}}">
                            <input type="text" value="{{ !is_null(old('name')) ? old('name') : (isset($data) ? $data->name : '') }}" name="name" id="name" class="gui-input" placeholder="name">
                        </label>
                          @if($errors->has('name'))
                          <em for="name" class="state-error">{{ $errors->first('name') }}</em>
                          @endif
                      </div>
                    </div>
					
					<div class="form-group">
                      <label for="username" class="col-lg-3 control-label">Username</label>
                      <div class="col-lg-8">
                        <label for="username" class="field {{ $errors->has('username') ? 'state-error' : ''}}">
                            <input type="text" value="{{ !is_null(old('username')) ? old('username') : (isset($data) ? $data->username : '') }}" name="username" id="username" class="gui-input" placeholder="Username">
                        </label>
                          @if($errors->has('username'))
                          <em for="username" class="state-error">{{ $errors->first('username') }}</em>
                          @endif
                      </div>
                    </div>
					
					<div class="form-group">
                      <label for="password" class="col-lg-3 control-label">Password</label>
                      <div class="col-lg-8">
                        <label for="password" class="field {{ $errors->has('password') ? 'state-error' : ''}}">
                            <input type="text" value="" name="password" id="password" class="gui-input" placeholder="password">
                        </label>
                          @if($errors->has('password'))
                          <em for="password" class="state-error">{{ $errors->first('password') }}</em>
                          @endif
                      </div>
                    </div>
                    					
                    <div class="form-group">
                      <label for="license" class="col-lg-3 control-label">License</label>
                      <div class="col-lg-8">
                        <label for="license" class="field {{ $errors->has('license') ? 'state-error' : ''}}">
                            <input type="text" value="{{ !is_null(old('license')) ? old('license') : (isset($data) ? $data->license : '') }}" name="license" id="license" class="gui-input" placeholder="License">
                        </label>
                          @if($errors->has('license'))
                          <em for="license" class="state-error">{{ $errors->first('license') }}</em>
                          @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="license_expired_at" class="col-lg-3 control-label">License Expired At</label>
                      <div class="col-lg-8">
                        <label for="license_expired_at" class="field {{ $errors->has('license_expired_at') ? 'state-error' : ''}}">
                            <input type="text" value="{{ !is_null(old('license_expired_at')) ? date('d-m-Y', strtotime(old('license_expired_at'))) : (isset($data) && $data->license_expired_at ? date('d-m-Y', strtotime($data->license_expired_at)) : '') }}" name="license_expired_at" id="license_expired_at" class="gui-input" placeholder="Offer date">
                        </label>
                          @if($errors->has('license_expired_at'))
                          <em for="license_expired_at" class="state-error">{{ $errors->first('license_expired_at') }}</em>
                          @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="commision" class="col-lg-3 control-label">Commision</label>
                      <div class="col-lg-8">
                        <label for="commision" class="field {{ $errors->has('commision') ? 'state-error' : ''}}">
                            <input type="text" value="{{ !is_null(old('commision')) ? old('commision') : (isset($data) ? $data->commision : '') }}" name="commision" id="commision" class="gui-input" placeholder="Enter commision">
                        </label>
                          @if($errors->has('commision'))
                          <em for="commision" class="state-error">{{ $errors->first(commision) }}</em>
                          @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="mls_id" class="col-lg-3 control-label">Mls Id</label>
                      <div class="col-lg-8">
                        <label for="mls_id" class="field {{ $errors->has('mls_id') ? 'state-error' : ''}}">
                            <input type="text" value="{{ !is_null(old('mls_id')) ? old('mls_id') : (isset($data) ? $data->mls_id : '') }}" name="mls_id" id="mls_id" class="gui-input" placeholder="Seller commision">
                        </label>
                          @if($errors->has('mls_id'))
                          <em for="mls_id" class="state-error">{{ $errors->first('mls_id') }}</em>
                          @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="email" class="col-lg-3 control-label">Email</label>
                      <div class="col-lg-8">
                        <label for="firstname" class="field {{ $errors->has('email') ? 'state-error' : ''}}">
                            <input type="text" value="{{ !is_null(old('email')) ? old('email') : (isset($data) ? $data->email : '') }}" name="email" id="email" class="gui-input" placeholder="Email">
                        </label>
                          @if($errors->has('email'))
                          <em for="firstname" class="state-error">{{ $errors->first('email') }}</em>
                          @endif
                      </div>
                    </div>
                    
                    <div class=" text-right">
                        <button type="submit" class="button btn-primary"> Validate Form </button>
                        <a href="/users" type="reset" class="button"> Cancel </a>
                    </div>
                  </form>
                </div>
            </div>

            </div>
            <!-- end: .admin-form -->

        </div>
            <!-- Begin: Admin Form -->

          </div>
        </div>
        <!-- end: .tray-center -->

</section>


@endsection

@section('page-js-script')
<script type="text/javascript">
    jQuery(document).ready(function() {
        var demo1 = jQuery('.demo1').bootstrapDualListbox({
            nonSelectedListLabel: 'Options',
            selectedListLabel: 'Selected',
            preserveSelectionOnMove: 'moved',
            moveOnSelect: true,
            
        });
        jQuery('#license_expired_at').datetimepicker({
            format: 'DD-MM-YYYY',
            ampm: false,
            autoclose: true,
            todayBtn: true,
            minuteStep: 5
        });
    });
</script>
@stop