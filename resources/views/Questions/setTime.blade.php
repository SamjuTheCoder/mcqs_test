@extends('layouts.layout')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Set Exam Time
 
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Exam Time</a></li>
        <li class="active">Set</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
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
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{ route('saveTime') }}">
                @csrf
              <div class="box-body">
              
             
              <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">Academic Session</label>
                  <select id="select-state" class="form-control" name="session" >
                                    <option value="">Choose...</option>
                                    @foreach($session as $pd)
                                    <option value="{{ $pd->session }}" {{ ($sessionx == $pd->session || old("session") == $pd->session )? "selected" :"" }}>{{$pd->session}} </option>
                                    @endforeach
                    </select> 
                </div>
                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">Term</label>
                  <select id="select-state" class="form-control" name="term" >
                                    <option value="">Choose...</option>
                                    @foreach($term as $pd)
                                    <option value="{{ $pd->semester }}" {{ ($termx== $pd->semester || old("term") == $pd->semester )? "selected" :"" }}>{{$pd->semester}} </option>
                                    @endforeach
                    </select>   </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">Academic Year</label>
                  <select id="select-state" class="form-control" name="year" >
                                    <option value="">Choose...</option>
                                    @foreach($year as $pd)
                                    <option value="{{ $pd->year }}" {{ ($yearx == $pd->year || old("year") == $pd->year )? "selected" :"" }}>{{$pd->year}} </option>
                                    @endforeach
                    </select>
                </div>
                <div class="box-footer">
                <button type="submit" class="btn btn-primary">Set Time</button>
              </div>
              </div>
              <!-- /.box-body -->

             
            </form>
        <hr>
            <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                  <tr>
                       <th>SN</th>
                       <th>Session</th>
                       <th>Term</th>
                       <th>Year</th>
                       <!-- <th>Action</th> -->
                  </tr>
                  </thead>
                  <tbody>
                  @php $i=1;  @endphp
                  @foreach($times as $time)
                  <tr>
                   <td>{{ $i++ }}</td>
                    <td>{{  $time->session }}</td>
                    <td>{{  $time->term }}</td>
                    <td>{{  $time->year }}</td>
                    <!-- <td><a onclick="deleteRecord('{{ base64_encode($time->qid) }}')"><button class="btn btn-info"><i class="fa fa-trash"></i></button></a></td>-->
                  </tr> 
                  @endforeach
                  </tbody>
                </table>
              </div>
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
            document.location = "/delete-questions/"+x;
        }
    }
</script>
@endsection