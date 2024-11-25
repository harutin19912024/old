@extends('layouts.admin')

@section('content')
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
        <a>Deal</a>
      </li>
    </ol>
  </div>

</header>

<section id="content" class="table-layout animated fadeIn">

        <!-- begin: .tray-center -->
    <div class="tray tray-center">
        
        <div class="panel mb25 mt5">
           
            <div class="panel-body p25 pb5">
              <div class="tab-content pn br-n admin-form">
                  <div class="section row mbn">
                    <div class="col-sm-8">
                      <label class="field option mt10">
                        <!--<input type="checkbox" name="info" checked>-->
                        <span class=""></span>Add Deal
                      </label>
                    </div>
                    <div class="col-sm-4">
                      <p class="text-right">
                          <a href="/deals/create" class="btn btn-primary" type="button">Add Deal</a>
                      </p>
                    </div>
                  </div>
                  <!-- end section -->

                
              </div>
            </div>
          </div>
        
        <div class="panel">
            <div class="panel-body pn">
              <div class="table-responsive">
                <table class="table admin-form theme-warning tc-checkbox-1 fs13">
                  <thead>
                    <tr class="bg-light">
                      <th class="text-center">Type</th>
                      <th class="">Property Address</th>
                      <th class="">MLS</th>
                      <th class="">Price</th>
                      <th class="">Seller Commision</th>
                      <th class="">Buyer Commision</th>
                      <th class="">Offer Date</th>
                      <th class="">Inspection Date</th>
                      <th class="">PNS Date</th>
                      <th class="">Mortage Contingency Date</th>
                      <th class="">Closing Date</th>
                      <th class="">Email</th>
                      <th class=""></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $row)
                    <tr>
                        <td>{{ $row->type}}</td>
                        <td>{{ $row->property_address}}</td>
                        <td>{{ $row->mls}}</td>
                        <td>{{ $row->price}}</td>
                        <td>{{ $row->seller_commision}}</td>
                        <td>{{ $row->buyer_commision}}</td>
                        <td>{{ $row->offer_date}}</td>
                        <td>{{ $row->inspection_date}}</td>
                        <td>{{ $row->pns_date}}</td>
                        <td>{{ $row->mortage_contingency_date}}</td>
                        <td>{{ $row->closing_date}}</td>
                        <td>{{ $row->email}}</td>
                        <td>
                        <form action="{{ route('deals.destroy', $row->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button>Delete</button>
                        </form>
                          <a href="{{ route('deals.edit', $row->id) }}">edit</a>
                        </td>
                    </tr>
                @endforeach
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="panel-footer clearfix">
                    {{ $data->links() }}
            </div>
        </div>
</div>
</section>
        
@endsection

@section('page-js-script')
<script type="text/javascript">
   
</script>
@stop