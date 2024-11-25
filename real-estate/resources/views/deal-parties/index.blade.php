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
        <a>Deal Parties </a>
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
                        <span class=""></span>Add deal parties
                      </label>
                    </div>
                    <div class="col-sm-4">
                      <p class="text-right">
                          <a href="/deal-parties/create" class="btn btn-primary" type="button">Add deal parties</a>
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
                      <th class="">Email</th>
                      <th class="">Office Phone Number</th>
                      <th class="">Cell Phone Number</th>
                      <th class="">Role</th>
                      <th class="">Address1</th>
                      <th class="">Address2</th>
                      <th class="">City</th>
                      <th class="">State</th>
                      <th class="">Zip Code</th>
                      <th class=""></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $row)
                        <tr>
                            <td>{{ $row->name}}</td>
                            <td>{{ $row->email}}</td>
                            <td>{{ $row->office_phone_number}}</td>
                            <td>{{ $row->cell_phone_number}}</td>
                            <td>{{ $row->role}}</td>
                            <td>{{ $row->address1}}</td>
                            <td>{{ $row->address2}}</td>
                            <td>{{ $row->city}}</td>
                            <td>{{ $row->state}}</td>
                            <td>{{ $row->zip_code}}</td>
                            <td>
                                <form action="{{ route('deal-parties.destroy', $row->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button>Delete</button>
                                    <a href="{{ route('deal-parties.edit', $row->id) }}">edit</a>
                                </form>
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