@extends('layouts.layout')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Parents
 
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Parents</a></li>
        <li class="active">Add</li>
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
            <form role="form" method="post" action="{{ route('saveParent') }}">
                @csrf
              <div class="box-body">

               <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">Fullname</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="fullname" placeholder="Enter Fullname" value="{{ old('fullname') }}" required>
 
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter Email" value="{{ old('email') }}" required>
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">Phone</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="phone" placeholder="Enter Phone" value="{{ old('phone') }}" required>
                </div>

               <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">State</label>
                    <select class="form-control" id="state" name="state" >
                            <option value="">Choose...</option>
                        @foreach($states as $s)
                            <option value="{{ $s->id }}" {{ ($statesx == $s->id || old("state") == $s->id )? "selected" :"" }}>{{$s->state}} </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">LGA</label>
                  <select class="form-control" id="lga" name="lga" >
                        <option value="">Choose...</option>
                                   
                    </select>
                </div>

                <div class="form-group col-md-8">
                  <label for="exampleInputEmail1">Address</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="address" placeholder="Enter Address" value="{{ old('address') }}" required>
  
                </div>
            </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
        <hr>
            <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                  <tr>
                       <th>SN</th>
                       <th>Fullname</th>
                       <th>Email</th>
                       <th>Phone</th>
                       <th>State</th>
                       <th>LGA</th>
                       <th>Address</th>
                       <th colspan="2">Action</th>

                  </tr>
                  </thead>
                  <tbody>
                  @php $i=1;  @endphp
                  @foreach($parents as $details)
                  <tr>
                   <td>{{ $i++ }}</td>
                   <td>{{ $details->fullname }}</td>
                   <td>{{ $details->email }}</td>
                   <td>{{ $details->phone }}</td>
                    <td>{{  $details->state }}</td>
                    <td>{{  $details->lga }}</td>
                    <td>{{  $details->address }}</td>
                   
                    <td>
                    <a onclick="deleteRecord('{{ base64_encode($details->id) }}')"><button class="btn btn-danger" title="Delete Record"><i class="fa fa-trash"></i></button></a>
                    </td>
                  
                  </tr>
                 @endforeach
                  </tbody>
                </table>

                {{ $parents->links() }}
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
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>  
    <script>
        CKEDITOR.replace( 'editor' );
    </script>
<script>
    function deleteRecord(x)
    {
        var i = confirm('Do you eally want to delete?');

        if(i==true)
        {
            document.location = "/delete-exams/"+x;
        }
    }

    function activateExam(x)
    {
        var i = confirm('             Do you eally want to Activate Exam?');

        if(i==true)
        {
            document.location = "/activate-exam/"+x;
        }
    }

    function deactivateExam(x)
    {
        var i = confirm('             Do you eally want to De-Activate Exam?');

        if(i==true)
        {
            document.location = "/deactivate-exam/"+x;
        }
    }
</script>
<script>

$(document).ready(function(){

    $("#state").change(function(e){
    
        //console.log(e);
        var state_id = e.target.value;
        //ajax
        $.get('get-lga?state_id='+state_id, function(data){
         $('#lga').empty();

        $.each(data, function(index, obj){
        $('#lga').append( '<option value="'+obj.id+'">'+obj.lga+'</option>' );
        });
        
        
        })
    });
    

});
 

</script>

@endsection