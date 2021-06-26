@extends('layouts.layout')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Students
 
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Students</a></li>
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
            <form role="form" method="post" action="{{ route('saveStudent') }}">
                @csrf
              <div class="box-body">

               <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">Fullname</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="fullname" placeholder="Enter Fullname" value="{{ old('fullname') }}" required>
 
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">Registration Nubmer</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="registration_number" placeholder="Enter Registration Number" value="{{ old('registration_number') }}" required>
  
                </div>

               <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">Sex</label>
                  <select id="class" class="form-control" name="sex" >
                                    <option value="">Choose...</option>
                                    @foreach($sex as $s)
                                    <option value="{{ $s->id }}" {{ ($sexx == $s->id || old("sex") == $s->id )? "selected" :"" }}>{{$s->sex}} </option>
                                    @endforeach
                    </select>
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">Class</label>
                  <select id="class" class="form-control" name="class" >
                                    <option value="">Choose...</option>
                                    @foreach($class as $s)
                                    <option value="{{ $s->id }}" {{ ($classx == $s->id || old("class") == $s->id )? "selected" :"" }}>{{$s->class}} </option>
                                    @endforeach
                    </select>
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">House</label>
                  <select id="class" class="form-control" name="house" >
                                    <option value="">Choose...</option>
                                    @foreach($getHouse as $s)
                                    <option value="{{ $s->id }}" {{ ($housex == $s->id || old("house") == $s->id )? "selected" :"" }}>{{$s->house}} </option>
                                    @endforeach
                    </select>
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">Parent</label>
                  <select id="parent" class="form-control" name="parent" >
                                    <option value="">Choose...</option>
                                    @foreach($parent as $s)
                                    <option value="{{ $s->id }}" {{ ($parentx == $s->id || old("parent") == $s->id )? "selected" :"" }}>{{$s->fullname}} </option>
                                    @endforeach
                    </select>
                    <a href="{{ route('addParent') }}" target="_blank" class="badge badge-success"> add parent</a> <a style="cursor:pointer" id="refresh" class="badge badge-warning"> Refresh</a>
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
                       <th>Reg Number</th>
                       <th>Sex</th>
                       <th>Class</th>
                       <th>House</th>
                       <th>Parent</th>
                       <th colspan="2">Action</th>

                  </tr>
                  </thead>
                  <tbody>
                  @php $i=1;  @endphp
                  @foreach($getStudents as $details)
                  <tr>
                   <td>{{ $i++ }}</td>
                   <td>{{ $details->studentName }}</td>
                   <td>{{ $details->registration_number }}</td>
                   <td>{{ $details->sex }}</td>
                    <td>{{  $details->class }}</td>
                    <td>{{  $details->house }}</td>
                    <td>{{  $details->parentName }}</td>
                   
                    <td>
                    <a onclick="deleteRecord('{{ base64_encode($details->id) }}')"><button class="btn btn-danger" title="Delete Record"><i class="fa fa-trash"></i></button></a>
                    </td>
                  
                  </tr>
                 @endforeach
                  </tbody>
                </table>

                {{ $getStudents->links() }}
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

    $("#class").change(function(e){
    
        //console.log(e);
        var class_id = e.target.value;
        //ajax
        $.get('get-subject?class_id='+class_id, function(data){
         $('#subject').empty();

        $.each(data, function(index, obj){
        $('#subject').append( '<option value="'+obj.id+'">'+obj.subject+'</option>' );
        });
        
        
        })
    });
    

});

$(document).ready(function(){

$("#refresh").click(function(e){

    //console.log(e);
    
    //ajax
    $.get('get-parent', function(data){
     $('#parent').empty();

    $.each(data, function(index, obj){
    $('#parent').append( '<option value="'+obj.id+'">'+obj.fullname+'</option>' );
    });
    
    
    })
});


});
 

</script>

@endsection