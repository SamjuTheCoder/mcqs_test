@extends('layouts.layout')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Exam Subjects
 
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Exams</a></li>
        <li class="active">Take</li>
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
        
            <br>
            <br>
            <div class="table-responsive" style="margin-left:20px;margin-right:20px;">
                
                <h4>Welcome: {{ Auth::user()->name }}, please select subject below to write your exam.</h4>
                <div class="card"> 
                
                <table> 
                    @foreach($examinfo as $exam)
                    <div>
                    <a href="proceed/{{base64_encode($exam->subjectID)}}" class="badge badge-info"><h4 style="font-weight:bold"><span class="fa fa-dashboard"></span> {{ $exam->subject}} [ <span style="color:white">{{ $exam->type}} - {{ $exam->term}}- {{ $exam->session}}</span> ] </h4></a>
                    </div>
                    <br> 
                    @endforeach
                </table>
                
                </div>
               
                <input type="hidden" class="form-control" id="question" name="question" value="">
              
                <p>&nbsp;</p>
             
                
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

    function funcTaken()
    {
      alert('Exam has been taken');
    }
    
</script>
@endsection