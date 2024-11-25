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
                        <span class=""></span>Add User
                      </label>
                    </div>
                    <div class="col-sm-4">
                      <p class="text-right">
                          <a href="/users/create" class="btn btn-primary" type="button">Add User</a>
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
                      <th class="">Username</th>
                      <th class="">Role</th>
                      <th class="">Full Name</th>
                      <th class="">License</th>
                      <th class="">License Expired At</th>
                      <th class="">Email</th>
                      <th class="">Commision</th>
                      <th class="">Mls Id</th>
                      <th class=""></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $row)
                    <tr>
                        <td>{{ $row->username}}</td>
                        <td> 
							@foreach($row->roles as $role)
							{{ $role->name }}
							@endforeach
						</td>
                        <td>{{ $row->name}}</td>
                        <td>{{ $row->license}}</td>
                        <td>{{ $row->license_expired_at}}</td>
                        <td>{{ $row->email}}</td>
                        <td>{{ $row->commision}}</td>
                        <td>{{ $row->mls_id}}</td>
                        <td>
							<form action="{{ route('users.destroy', $row->id) }}" method="POST">
								@method('DELETE')
								@csrf
								<button>Delete</button>
							</form>
                            <a href="{{ route('users.edit', $row->id) }}">edit</a>
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