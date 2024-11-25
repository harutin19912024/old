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

    </ol>
  </div>

</header>

<section id="content" class="table-layout animated fadeIn">

        <!-- begin: .tray-center -->
    <div class="tray tray-center">
        
        
        
        <div class="panel" id="spy4">
            <div class="panel-heading">
              <span class="panel-title">
                <span class="fa fa-arrows-v"></span>Expanding Rows</span>
              <div class="pull-right">
              </div>
            </div>
            <div class="panel-body pn">

              <table class="table footable fw-labels">
                <thead>
                  <tr>
                    <th>
                      type
                    </th>
                    <th>
                      Property address
                    </th>
                    <th>
                      Inspection Date
                    </th>
                    <th >
                      PNS  date
                    </th>
                    <th data-toggle="true">
                      Mortage contingency date
                    </th>
                    <th data-hide="all">
                      Details
                    </th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($data as $row)
                    
                    @php
                        $now = \Carbon\Carbon::now();
                        $inspection_date = \Carbon\Carbon::createFromFormat('d/m/Y H:i:s', $row->inspection_date);
                        $inspection = $now->diffInDays($inspection_date,false);
                        
                        $pns_date = \Carbon\Carbon::createFromFormat('d/m/Y H:i:s', $row->pns_date);
                        $pns = $now->diffInDays($pns_date,false);
                        
                        $mortage_contingency_date = \Carbon\Carbon::createFromFormat('d/m/Y H:i:s', $row->mortage_contingency_date);
                        $mortage_contingency = $now->diffInDays($mortage_contingency_date,false);
                        
                        $seven_days_before = [
                            'inspection_date' => ($inspection<=7 && $inspection>0)?true:false,
                            'pns_date' => ($pns<=7 && $pns>0)?true:false,
                            'mortage_contingency_date' => ($mortage_contingency<=7 && $mortage_contingency>0)?true:false,
                        ];
                        
                        $past_due_dates = [
                            'inspection_date' => ($inspection<=0)?true:false,
                            'pns_date' => ($pns<=0)?true:false,
                            'mortage_contingency_date' => ($mortage_contingency<=0)?true:false,
                        ];
                        $row_class = "row-success";
                        if($past_due_dates['inspection_date'] || $past_due_dates['pns_date'] || $past_due_dates['mortage_contingency_date']){
                            $row_class = "row-danger";
                        }elseif($seven_days_before['inspection_date'] || $seven_days_before['pns_date'] || $seven_days_before['mortage_contingency_date']){
                            $row_class = "row-warning";
                        }   
                        $danger_class = "label-danger";
                        $warning_class = "label-warning";
                        $success_class = "label-success";
                        
                        $span_classes = [
                            'inspection_date' => ($inspection<=0)?$danger_class:(($inspection<=7 && $inspection>0)?$warning_class:$success_class),
                            'pns_date' => ($pns<=0)?$danger_class:(($pns<=7 && $pns>0)?$warning_class:$success_class),
                            'mortage_contingency_date' => ($mortage_contingency<=0)?$danger_class:(($mortage_contingency<=7 && $mortage_contingency>0)?$warning_class:$success_class),
                        ];
                    @endphp
                    <tr class="{{ $row_class }}">
                        <td>{{ $row->type}}</td>
                        <td>{{ $row->property_address}}</td>
                        <td><span class="label {{ $span_classes['inspection_date'] }}">{{ $row->inspection_date}}</span></td>
                        <td><span class="label {{ $span_classes['pns_date'] }}">{{ $row->pns_date}}</span></td>
                        <td><span class="label {{ $span_classes['mortage_contingency_date'] }}">{{ $row->mortage_contingency_date}}</span></td>
                        <td>
                            <div>Mls: {{ $row->mls}}</div>
                            <div>price: {{ $row->price}}</div>
                            <div>Seller commision: {{ $row->seller_commision}}</div>
                            <div>Buyer commision: {{ $row->buyer_commision}}</div>
                            <div>Offer date {{ $row->offer_date}}</div>
                            <div>Inspection date: {{ $row->inspection_date}}</div>
                            <div>PNS date: {{ $row->pns_date}}</div>
                            <div>Mortage contingency date: {{ $row->mortage_contingency_date}}</div>
                            <div>Closing date: {{ $row->closing_date}}</div>
                            <div>Email: {{ $row->email}}</div>
                            
                        </td>
                      </tr>
<!--                    <tr>
                        <td>{{ $row->type}}</td>
                        <td>{{ $row->property_address}}</td>

                        <td>
                        <form action="{{ route('deals.destroy', $row->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button>Delete</button>
                        </form>
                            <a href="{{ route('deals.edit', $row->id) }}">edit</a>
                        </td>
                    </tr>-->
                @endforeach
                  <!-- Primary Row -->
                  

                  <!-- Info Row -->
<!--                  <tr class="row-info">
                    <td>
                      <span class="label label-info">Info</span>
                    </td>
                    <td>This is a Footable expandable <b class="text-info">"Info"</b> row</td>
                    <td>You can use this style by formatting the table row like this <code>&lt;tr class=&quot;row-info&quot;&gt;</code></td>
                  </tr>
              
                   Success Row 
                  <tr class="row-success">
                    <td>
                      <span class="label label-success">Success</span>
                    </td>
                    <td>This is a Footable expandable <b class="text-success">"Success"</b> row</td>
                    <td>You can use this style by formatting the table row like this <code>&lt;tr class=&quot;row-success&quot;&gt;</code></td>
                  </tr>

                   Warning Row 
                  <tr class="row-warning">
                    <td>
                      <span class="label label-warning">Warning</span>
                    </td>
                    <td>This is a Footable expandable <b class="text-warning">"Warning"</b> row</td>
                    <td>You can use this style by formatting the table row like this <code>&lt;tr class=&quot;row-warning&quot;&gt;</code></td>
                  </tr>

                   Danger Row 
                  <tr class="row-danger">
                    <td>
                      <span class="label label-danger">Danger</span>
                    </td>
                    <td>This is a Footable expandable <b class="text-danger">"Danger"</b> row</td>
                    <td>You can use this style by formatting the table row like this <code>&lt;tr class=&quot;row-danger&quot;&gt;</code></td>
                  </tr>

                   Alert Row 
                  <tr class="row-alert">
                    <td>
                      <span class="label label-alert">Alert</span>
                    </td>
                    <td>This is a Footable expandable <b class="text-alert">"Alert"</b> row</td>
                    <td>You can use this style by formatting the table row like this <code>&lt;tr class=&quot;row-alert&quot;&gt;</code></td>
                  </tr>

                   System Row 
                  <tr class="row-system">
                    <td>
                      <span class="label label-system">System</span>
                    </td>
                    <td>This is a Footable expandable <b class="text-system">"System"</b> row</td>
                    <td>You can use this style by formatting the table row like this <code>&lt;tr class=&quot;row-system&quot;&gt;</code></td>
                  </tr>

                   Dark Row 
                  <tr class="row-dark">
                    <td>
                      <span class="label label-dark">Dark</span>
                    </td>
                    <td>This is a Footable expandable <b class="text-dark">"Dark"</b> row</td>
                    <td>You can use this style by formatting the table row like this <code>&lt;tr class=&quot;row-dark&quot;&gt;</code></td>
                  </tr>-->

                </tbody>
              </table>
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
   $('.footable').footable({ paginate:false });
</script>
@stop