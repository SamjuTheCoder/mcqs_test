@extends('layouts.layout')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Assign Teacher to Class
 
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Teacher</a></li>
        <li class="active">Assign to Class</li>
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
            <form role="form" method="post" action="{{ route('assignTeacher') }}">
                @csrf
              <div class="box-body">
                                
              <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Teacher</label>
                  <select id="teacher" class="form-control" name="teacher" >
                                    <option value="">Choose...</option>
                                    @foreach($teacher as $s)
                                    <option value="{{ $s->id }}" {{ ($teacherx == $s->id || old("teacher") == $s->id )? "selected" :"" }}>{{$s->fullname}} </option>
                                    @endforeach
                    </select>
                </div>

                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Class</label>
                  <select id="class" class="form-control" name="class" >
                                    <option value="">Choose...</option>
                                    @foreach($class as $s)
                                    <option value="{{ $s->id }}" {{ ($classx == $s->id || old("class") == $s->id )? "selected" :"" }}>{{$s->class}} </option>
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
                       <th>Teacher</th>
                       <th>Class</th>
                     
                       <th colspan="2">Action</th>

                  </tr>
                  </thead>
                  <tbody>
                  @php $i=1;  @endphp
                  @foreach($teacherclass as $details)
                  <tr>
                   <td>{{ $i++ }}</td>
                    <td>{{  $details->fullname }}</td>
                    <td>{{  $details->class }}</td>
                   
                    <td>
                    <a onclick="deleteRecord('{{ base64_encode($details->id) }}')"><button class="btn btn-danger" title="Delete Record"><i class="fa fa-trash"></i></button></a>
                    </td>
                  
                  </tr>
                 @endforeach
                  </tbody>
                </table>
                {{ $teacherclass->links() }}
               
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

$(document).ready(function(){

$("#teacher").change(function(e){

    //console.log(e);
    var class_id = e.target.value;

    document.location="/load-teacher-class/"+ class_id;
    //ajax
    // $.get('get-subject?class_id='+class_id, function(data){
    //  $('#subject').empty();

    // $.each(data, function(index, obj){
    // $('#subject').append( '<option value="'+obj.id+'">'+obj.subject+'</option>' );
    // });
    // })
 });

});

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
 

</script>

@endsection