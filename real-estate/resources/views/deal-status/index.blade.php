@extends('layouts.admin')

@section('content')
<header id="topbar">
  <div class="topbar-left">
    <ol class="breadcrumb">
      <li class="crumb-active">
        <a href="">Dashboard</a>
      </li>
      <li class="crumb-icon">
        <a href="/">
          <span class="glyphicon glyphicon-home"></span>
        </a>
      </li>
      <li class="crumb-link">
        <a>Deal Statuses </a>
      </li>
      <!--<li class="crumb-trail">Dashboard</li>-->
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
                        <span class=""></span>Add deal status
                      </label>
                    </div>
                    <div class="col-sm-4">
                      <p class="text-right">
                          <a href="/deal-status/create" class="btn btn-primary" type="button">Add deal status</a>
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
                      <th class="text-center">Name</th>
                      <th class="">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $row)
                        <tr>
                            <td>{{ $row->name}}</td>
                            <td>
                                <form action="{{ route('deal-status.destroy', $row->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button>Delete</button>
                                </form>
                                <a href="{{ route('deal-status.edit', $row->id) }}">edit</a>
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