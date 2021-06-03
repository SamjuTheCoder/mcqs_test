@extends('layouts.layout')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Assign User to Role
 
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">User - Role</a></li>
        <li class="active">Assign</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      @if(session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
                <strong></strong> {{ session('success') }}</div>
                @endif
                @if(session('error_message'))
                <div class="alert alert-error alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
                <strong>Error!</strong> {{ session('error_message') }}</div>
                @endif
                
                @if (count($errors) > 0)
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                                </button>
                                <strong>Error!</strong> 
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                @endif
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
         
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{ route('saveassignuserRole') }}">
                @csrf
              <div class="box-body">
                           
              <div class="row">
              <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Role</label>
                  <select id="select-state" class="form-control" name="role" >
                                    <option value="">Choose...</option>
                                    @foreach($role as $pd)
                                    <option value="{{ $pd->id }}" {{ ($rolex == $pd->id || old("role") == $pd->id )? "selected" :"" }}>{{$pd->rolename}} </option>
                                    @endforeach
                                </select> 
                </div>

                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Module Name</label>
                  <select id="select-state" class="form-control" name="user" >
                                    <option value="">Choose...</option>
                                    @foreach($user as $pd)
                                    <option value="{{ $pd->id }}" {{ ($userx == $pd->id || old("user") == $pd->id )? "selected" :"" }}>{{$pd->name}} </option>
                                    @endforeach
                                </select> 
                </div>

              </div>
              
                               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Assign</button>
              </div>
            </form>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                  <tr>
                       <th>SN</th>
                       <th>Role Name</th>
                       <th>User</th>
                       <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @php $i=1;  @endphp
                  @foreach($user_role as $r)
                  <tr>
                   <td>{{ $i++ }}</td>
                    <td>{{ $r->rolename }}</td>
                    <td>{{ $r->name }} </td>
                    <td><a onclick="deleteRecord('{{ base64_encode($r->uid) }}')"><button class="btn btn-info"><i class="fa fa-trash"></i></button></a></td>
                  </tr>
                 @endforeach
                
                </tbody>
                </table>
               
              </div>
              {{ $user_role->links() }}
          </div>
          <!-- /.box -->
            
          
          <!-- /.box -->

        </div>
        <!--/.col (left) -->
        <!-- right column -->
       
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
@endsection

@section('script')
<script>
    function deleteRecord(x)
    {
        var i = confirm('Do you eally want to delete?');

        if(i==true)
        {
            document.location = "/delete-user-role/"+x;
        }
    }
</script>

<script>

    $(document).ready(function () {
          $('select').selectize({
              sortField: 'text'
          });
      });

</script>
@endsection