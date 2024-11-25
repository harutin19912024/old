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
        <a>{{ Route::currentRouteNamed('deal-parties.create') ? 'Add' : 'Edit' }} Deal</a>
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
<section id="content" class="table-layout animated fadeIn">

        <!-- begin: .tray-center -->
        <div class="tray tray-center">

          <div class="mw1000 center-block">

            <!-- Begin: Content Header -->
<!--            <div class="content-header">
              <h2>Add Deal</h2>
              <p class="lead">We even included dozens of prebuilt form layouts so you can leave work early</p>
            </div>-->
            <div class="tray tray-center">

            <!-- Begin: Content Header -->
<!--            <div class="content-header">
              <h2> AdminForms makes <b>Validation</b> is easier than ever</h2>
              <p class="lead">Use the Admin Forms you know and love to help build the perfect form.</p>
            </div>-->

            <!-- Validation Example -->
            <div class="admin-form theme-primary mw1000 center-block" style="padding-bottom: 175px;">
            <div class="panel">
                <div class="panel-heading">
                  <span class="panel-title">Add deal parties</span>
                </div>
                <div class="panel-body">

                    <form id="admin-form" class="form-horizontal" role="form" method="POST" action="{{ Route::currentRouteNamed('deal-parties.create') ? route('deal-parties.store') : route('deal-parties.update', ['id' => $data->id]) }}" autocomplete="off">
                    <input type="hidden" name="id" value="{{ $edit_id ?? '' }}">
                    <input type="hidden" name="_method" value="{{ Route::currentRouteNamed('deal-parties.create') ? 'POST' : 'PUT' }}">
                    {{ csrf_field() }}
                    
                    
                    <div class="form-group">
                      <label for="name" class="col-lg-3 control-label">name</label>
                      <div class="col-lg-8">
                        <label for="name" class="field {{ $errors->has('name') ? 'state-error' : ''}}">
                            <input type="text" value="{{ !is_null(old('name')) ? old('name') : (isset($data) ? $data->name : '') }}" name="name" id="name" class="gui-input" placeholder="Name">
                        </label>
                          @if($errors->has('name'))
                          <em for="name" class="state-error">Enter name</em>
                          @endif
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="email" class="col-lg-3 control-label">Email</label>
                      <div class="col-lg-8">
                        <label for="email" class="field {{ $errors->has('email') ? 'state-error' : ''}}">
                            <input type="text" value="{{ !is_null(old('email')) ? old('email') : (isset($data) ? $data->email : '') }}" name="email" id="email" class="gui-input" placeholder="Email">
                        </label>
                          @if($errors->has('email'))
                          <em for="email" class="state-error">Enter Email</em>
                          @endif
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="office_phone_number" class="col-lg-3 control-label">Office phone number</label>
                      <div class="col-lg-8">
                        <label for="office_phone_number" class="field {{ $errors->has('office_phone_number') ? 'state-error' : ''}}">
                            <input type="text" value="{{ !is_null(old('office_phone_number')) ? old('office_phone_number') : (isset($data) ? $data->office_phone_number : '') }}" name="office_phone_number" id="office_phone_number" class="gui-input" placeholder="Office phone number">
                        </label>
                          @if($errors->has('office_phone_number'))
                          <em for="office_phone_number" class="state-error">Enter Office phone number</em>
                          @endif
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="cell_phone_number" class="col-lg-3 control-label">Cell phone number</label>
                      <div class="col-lg-8">
                        <label for="cell_phone_number" class="field {{ $errors->has('cell_phone_number') ? 'state-error' : ''}}">
                            <input type="text" value="{{ !is_null(old('cell_phone_number')) ? old('cell_phone_number') : (isset($data) ? $data->cell_phone_number : '') }}" name="cell_phone_number" id="cell_phone_number" class="gui-input" placeholder="Cell phone number">
                        </label>
                          @if($errors->has('cell_phone_number'))
                          <em for="cell_phone_number" class="state-error">Enter Cell phone number</em>
                          @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="role" class="col-lg-3 control-label">Role</label>
                      <div class="col-lg-8">
                        <label for="role" class="field {{ $errors->has('role') ? 'state-error' : ''}}">
                            <select  class="gui-input" id="role" name="role">
                                <option value="">Select role...</option>
                                @foreach(\App\DealParty::$roles as $role)
                                    <option value="{{ $role }}" {{ (!is_null(old('type')) && isset($data) && $role == old('role')) ? 'selected' : ((isset($data) && $data->role == $role ) ? 'selected'  : '') }} >{{ $role }}</option>
                                @endforeach
                            </select>
                        </label>
                          @if($errors->has('role'))
                          <em for="role" class="state-error">Select role</em>
                          @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="address1" class="col-lg-3 control-label">Address 1</label>
                      <div class="col-lg-8">
                        <label for="address1" class="field {{ $errors->has('address1') ? 'state-error' : ''}}">
                            <input type="text" value="{{ !is_null(old('address1')) ? old('address1') : (isset($data) ? $data->address1 : '') }}" name="address1" id="address1" class="gui-input" placeholder="Seller address 1">
                        </label>
                          @if($errors->has('address1'))
                          <em for="address1" class="state-error">Enter address 1</em>
                          @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="address2" class="col-lg-3 control-label">Address 2</label>
                      <div class="col-lg-8">
                        <label for="address2" class="field {{ $errors->has('address2') ? 'state-error' : ''}}">
                            <input type="text" value="{{ !is_null(old('address2')) ? old('address2') : (isset($data) ? $data->address2 : '') }}" name="address2" id="address2" class="gui-input" placeholder="Buyer address 2">
                        </label>
                          @if($errors->has('address2'))
                          <em for="address2" class="state-error">Enter address 2</em>
                          @endif
                      </div>
                    </div>

                  
                    <div class="form-group">
                      <label for="city" class="col-lg-3 control-label">City</label>
                      <div class="col-lg-8">
                        <label for="city" class="field {{ $errors->has('city') ? 'state-error' : ''}}">
                            <input type="text" value="{{ !is_null(old('city')) ? old('city') : (isset($data) ? $data->city : '') }}" name="city" id="city" class="gui-input" placeholder="City">
                        </label>
                          @if($errors->has('city'))
                          <em for="city" class="state-error">Enter city</em>
                          @endif
                      </div>
                    </div>
                  
                    <div class="form-group">
                      <label for="state" class="col-lg-3 control-label">State</label>
                      <div class="col-lg-8">
                        <label for="state" class="field {{ $errors->has('state') ? 'state-error' : ''}}">
                            <input type="text" value="{{ !is_null(old('state')) ? old('state') : (isset($data) ? $data->state : '') }}" name="state" id="state" class="gui-input" placeholder="State">
                        </label>
                          @if($errors->has('state'))
                          <em for="state" class="state-error">Enter state</em>
                          @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="zip_code" class="col-lg-3 control-label">Zip code</label>
                      <div class="col-lg-8">
                        <label for="zip_code" class="field {{ $errors->has('zip_code') ? 'state-error' : ''}}">
                            <input type="text" value="{{ !is_null(old('zip_code')) ? old('zip_code') : (isset($data) ? $data->zip_code : '') }}" name="zip_code" id="zip_code" class="gui-input" placeholder="Zip code">
                        </label>
                          @if($errors->has('zip_code'))
                          <em for="zip_code" class="state-error">Enter Zip code</em>
                          @endif
                      </div>
                    </div>


                    <div class=" text-right">
                        <button type="submit" class="button btn-primary"> Validate Form </button>
                        <a href="/deals" type="reset" class="button"> Cancel </a>
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
        jQuery('#offer_date').datepicker(); 
        $( "#inspection_date").datetimepicker({
            format: 'DD/MM/YYYY HH:mm:ss',
            ampm: false,
            autoclose: true,
            todayBtn: true,
            minuteStep: 5
        });
        $( "#pns_date").datetimepicker({
            format: 'DD/MM/YYYY HH:mm:ss',
            ampm: false,
            autoclose: true,
            todayBtn: true,
            minuteStep: 5
        });
        $( "#mortage_contingency_date").datetimepicker({
            format: 'DD/MM/YYYY HH:mm:ss',
            ampm: false,
            autoclose: true,
            todayBtn: true,
            minuteStep: 5
        });
        $( "#closing_date").datetimepicker({
            format: 'DD/MM/YYYY HH:mm:ss',
            ampm: false,
            autoclose: true,
            todayBtn: true,
            minuteStep: 5
        });
    });
</script>
@stop