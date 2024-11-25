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
        <a>{{ Route::currentRouteNamed('deal-status.create') ? 'Add' : 'Edit' }} Deal</a>
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

            <div class="tray tray-center">

            <!-- Validation Example -->
            <div class="admin-form theme-primary mw1000 center-block" style="padding-bottom: 175px;">
            <div class="panel">
                <div class="panel-heading">
                  <span class="panel-title">Add deal status</span>
                </div>
                <div class="panel-body">

                    <form id="admin-form" class="form-horizontal" role="form" method="POST" action="{{ Route::currentRouteNamed('deal-status.create') ? route('deal-status.store') : route('deal-status.update', ['id' => $data->id]) }}" autocomplete="off">
                    
                    <input type="hidden" name="_method" value="{{ Route::currentRouteNamed('deal-status.create') ? 'POST' : 'PUT' }}">
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