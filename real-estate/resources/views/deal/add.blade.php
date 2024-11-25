@extends('layouts.admin')

@section('content')
<?php // var_dump(\App\Deal::$deal_types);die;?>
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
        <a>{{ Route::currentRouteNamed('deals.create') ? 'Add' : 'Edit' }} Deal</a>
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
                  <span class="panel-title">Add Deal</span>
                </div>
                <div class="panel-body">

                    <form id="admin-form" class="form-horizontal" role="form" method="POST" action="{{ Route::currentRouteNamed('deals.create') ? route('deals.store') : route('deals.update', ['id' => $data->id]) }}" autocomplete="off">
                    <input type="hidden" name="_method" value="{{ Route::currentRouteNamed('deals.create') ? 'POST' : 'PUT' }}">
                    {{ csrf_field() }}
                    
                    <div class="form-group">
                      <label for="type" class="col-lg-3 control-label">Type</label>
                      <div class="col-lg-8">
                        <label for="firstname" class="field {{ $errors->has('type') ? 'state-error' : ''}}">
                            <select  class="gui-input" id="type" name="type">
                                <option value="">Select deal type...</option>
                                @foreach(\App\Deal::$deal_types as $type)
                                    <option value="{{ $type }}" {{ (!is_null(old('type')) && isset($data) && $type == old('type')) ? 'selected' : ((isset($data) && $data->type == $type ) ? 'selected'  : '') }} >{{ $type }}</option>
                                @endforeach
<!--                                <option value="buy">Buy</option>
                                <option value="sell">Sell</option>
                                <option value="rent">Rent</option>-->
                            </select>
                        </label>
                          @if($errors->has('type'))
                          <em for="firstname" class="state-error">{{$errors->first('type') }}</em>
                          @endif
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="property_address" class="col-lg-3 control-label">Property address</label>
                      <div class="col-lg-8">
                        <label for="firstname" class="field {{ $errors->has('property_address') ? 'state-error' : ''}}">
                            <input type="text" value="{{ !is_null(old('property_address')) ? old('property_address') : (isset($data) ? $data->property_address : '') }}" name="property_address" id="property_address" class="gui-input" placeholder="Property address">
                        </label>
                          @if($errors->has('property_address'))
                          <em for="firstname" class="state-error">{{ $errors->first('property_address') }}</em>
                          @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="mls" class="col-lg-3 control-label">MLS</label>
                      <div class="col-lg-8">
                        <label for="firstname" class="field {{ $errors->has('mls') ? 'state-error' : ''}}">
                            <input type="text" value="{{ !is_null(old('mls')) ? old('mls') : (isset($data) ? $data->mls : '') }}" name="mls" id="mls" class="gui-input" placeholder="Property address">
                        </label>
                          @if($errors->has('mls'))
                          <em for="firstname" class="state-error">{{ $errors->first('mls') }}</em>
                          @endif
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="price" class="col-lg-3 control-label">Price</label>
                      <div class="col-lg-8">
                        <label for="firstname" class="field {{ $errors->has('price') ? 'state-error' : ''}}">
                            <input type="text" value="{{ !is_null(old('price')) ? old('price') : (isset($data) ? $data->price : '') }}" name="price" id="price" class="gui-input" placeholder="Enter Price">
                        </label>
                          @if($errors->has('price'))
                          <em for="firstname" class="state-error">{{ $errors->first('price') }}</em>
                          @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="seller_commision" class="col-lg-3 control-label">Seller commision</label>
                      <div class="col-lg-8">
                        <label for="firstname" class="field {{ $errors->has('seller_commision') ? 'state-error' : ''}}">
                            <input type="text" value="{{ !is_null(old('seller_commision')) ? old('seller_commision') : (isset($data) ? $data->seller_commision : '') }}" name="seller_commision" id="seller_commision" class="gui-input" placeholder="Seller commision">
                        </label>
                          @if($errors->has('seller_commision'))
                          <em for="firstname" class="state-error">{{ $errors->first('seller_commision') }}</em>
                          @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="buyer_commision" class="col-lg-3 control-label">Buyer commision</label>
                      <div class="col-lg-8">
                        <label for="firstname" class="field {{ $errors->has('buyer_commision') ? 'state-error' : ''}}">
                            <input type="text" value="{{ !is_null(old('buyer_commision')) ? old('buyer_commision') : (isset($data) ? $data->buyer_commision : '') }}" name="buyer_commision" id="buyer_commision" class="gui-input" placeholder="Buyer commision">
                        </label>
                          @if($errors->has('buyer_commision'))
                          <em for="firstname" class="state-error">{{ $errors->first('buyer_commision') }}</em>
                          @endif
                      </div>
                    </div>

                  
                    <div class="form-group">
                      <label for="offer_date" class="col-lg-3 control-label">Offer date</label>
                      <div class="col-lg-8">
                        <label for="firstname" class="field {{ $errors->has('offer_date') ? 'state-error' : ''}}">
                            <input type="text" value="{{ !is_null(old('offer_date')) ? old('offer_date') : (isset($data) ? $data->offer_date : '') }}" name="offer_date" id="offer_date" class="gui-input" placeholder="Offer date">
                        </label>
                          @if($errors->has('offer_date'))
                          <em for="firstname" class="state-error">{{ $errors->first('offer_date') }}</em>
                          @endif
                      </div>
                    </div>
                  
                    <div class="form-group">
                      <label for="inspection_date" class="col-lg-3 control-label">Inspection date</label>
                      <div class="col-lg-8">
                        <label for="firstname" class="field {{ $errors->has('inspection_date') ? 'state-error' : ''}}">
                            <input type="text" value="{{ !is_null(old('inspection_date')) ? old('inspection_date') : (isset($data) ? $data->inspection_date : '') }}" name="inspection_date" id="inspection_date" class="gui-input" placeholder="Inspection date">
                        </label>
                          @if($errors->has('inspection_date'))
                          <em for="firstname" class="state-error">{{ $errors->first('inspection_date') }}</em>
                          @endif
                      </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inspection_date" class="col-lg-3 control-label">Inspection date</label>
                        <div class="col-lg-8">
                            <label for="firstname" class="field">
                                <div class="checkbox-custom checkbox-success mb5">
                                    <input type="checkbox" value="1" id="inspection_passed" {{ !is_null(old('inspection_passed')) ? 'checked'  : (isset($data) && $data->inspection_passed ? 'checked' : '') }} name="inspection_passed">
                                    <label for="inspection_passed">Success</label>
                                </div>
                            </label>
                          </div>
                    </div>

                    <div class="form-group">
                      <label for="pns_date" class="col-lg-3 control-label">PNS date</label>
                      <div class="col-lg-8">
                        <label for="firstname" class="field {{ $errors->has('pns_date') ? 'state-error' : ''}}">
                            <input type="text" value="{{ !is_null(old('pns_date')) ? old('pns_date') : (isset($data) ? $data->pns_date : '') }}" name="pns_date" id="pns_date" class="gui-input" placeholder="PNS date">
                        </label>
                          @if($errors->has('pns_date'))
                          <em for="firstname" class="state-error">{{ $errors->first('pns_date') }}</em>
                          @endif
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="inspection_date" class="col-lg-3 control-label">PNS date passed</label>
                        <div class="col-lg-8">
                            <label for="firstname" class="field">
                                <div class="checkbox-custom checkbox-success mb5">
                                    <input type="checkbox" value="1" id="pns_passed" {{ !is_null(old('pns_passed')) ? 'checked'  : (isset($data) && $data->pns_passed ? 'checked' : '') }} name="pns_passed">
                                    <label for="pns_passed">Success</label>
                                </div>
                            </label>
                          </div>
                    </div>
                    <div class="form-group">
                      <label for="mortage_contingency_date" class="col-lg-3 control-label">Mortage contingency date</label>
                      <div class="col-lg-8">
                        <label for="firstname" class="field {{ $errors->has('mortage_contingency_date') ? 'state-error' : ''}}">
                            <input type="text" value="{{ !is_null(old('mortage_contingency_date')) ? old('mortage_contingency_date') : (isset($data) ? $data->mortage_contingency_date : '') }}" name="mortage_contingency_date" id="mortage_contingency_date" class="gui-input" placeholder="Mortage contingency date">
                        </label>
                          @if($errors->has('mortage_contingency_date'))
                          <em for="firstname" class="state-error">{{ $errors->first('mortage_contingency_date') }}</em>
                          @endif
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="inspection_date" class="col-lg-3 control-label">PNS date passed</label>
                        <div class="col-lg-8">
                            <label for="firstname" class="field">
                                <div class="checkbox-custom checkbox-success mb5">
                                    <input type="checkbox" value="1" id="mortage_contingency_passed" {{ !is_null(old('mortage_contingency_passed')) ? 'checked'  : (isset($data) && $data->mortage_contingency_passed ? 'checked' : '') }} name="mortage_contingency_passed">
                                    <label for="mortage_contingency_passed">Success</label>
                                </div>
                            </label>
                          </div>
                    </div>
                    <div class="form-group">
                      <label for="closing_date" class="col-lg-3 control-label">Closing date</label>
                      <div class="col-lg-8">
                        <label for="firstname" class="field {{ $errors->has('closing_date') ? 'state-error' : ''}}">
                            <input type="text" value="{{ !is_null(old('closing_date')) ? old('closing_date') : (isset($data) ? $data->closing_date : '') }}" name="closing_date" id="closing_date" class="gui-input" placeholder="Closing date">
                        </label>
                          @if($errors->has('closing_date'))
                          <em for="firstname" class="state-error">{{ $errors->first('closing_date') }}</em>
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

                    <div class="form-group">
                      <label for="fuel_type_id" class="col-lg-3 control-label">Choose Status</label>
                      <div class="col-lg-8">
                        <label for="fuel_type_id" class="field {{ $errors->has('deal_status_id') ? 'state-error' : ''}}">
                            <select  class="gui-input" id="deal_status_id" name="deal_status_id">
                              <option value="">Select status...</option>
                              @foreach($dealStatuses as $status)
                              <option value="{{ $status->id }}" {{ (!is_null(old('deal_status_id')) && isset($data) && $status->id == old('deal_status_id')) ? 'selected' : ((isset($data) && $data->deal_status_id == $status->id ) ? 'selected'  : '') }} >{{ $status->name }}</option>
                              @endforeach
                            </select>
                        </label>
                          @if($errors->has('deal_status_id'))
                          <em for="fuel_type_id" class="state-error">{{ $errors->first('deal_status_id') }}</em>
                          @endif
                      </div>
                    </div>
                    
                    <div class="panel-heading">
                       <span class="panel-title">Select Deal Parties </span>
                     </div>
                     <div class="panel-body p25">
                       <select class="demo1" multiple="multiple" size="10" name="deal_participants[]">
               
                            @foreach($dealParty as $party)
                                  <option @if(isset($data) && in_array($party->id, $data->participants->pluck('deal_parties_id')->toArray()))selected="selected"@endif value="{{ $party->id }}" >{{ $party->name }}</option>
                            @endforeach

                       </select>
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
        var demo1 = jQuery('.demo1').bootstrapDualListbox({
            nonSelectedListLabel: 'Options',
            selectedListLabel: 'Selected',
            preserveSelectionOnMove: 'moved',
            moveOnSelect: true,
            
        });
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