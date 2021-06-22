@extends('layouts.layout')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Exam Instruction
 
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
            <div class="table-responsive" style="margin-left:20px;margin-right:20px; font-size:19px">
               
            @if($exam_status==null)

                @if($readme==null)
                <div class="card"> 
                   <h3> Exam will start soon. Check back later</h3>
                </div>
                @else
                <div class="card"> 
                    <h3><strong>{{ $readme->examname }} [<span style="color:blue">{{ $readme->subject }}</span>]</strong></h3>
                    <h4><strong>Time: </strong> {{ $readme->hour ? $readme->hour.'hrs' : '' }} : {{ $readme->mins ? $readme->mins.'mins' : '' }} <strong>Term:</strong> {{ $readme->term }} <strong>Session: </strong>{{ $readme->session }} <strong>No. of Questions: </strong>{{ $count_question }} <strong>Questions Type: </strong>{{ $title->questionType }}</h4>
                   <div class="instruction">{!! $readme->instruction !!}</div>
                </div>
                @endif
                @php  $count = DB::table('student_exam_times')->where('studentID',Auth::user()->id)->first();  @endphp
              
                <form method="get" action="{{ route('takeExam') }}">
                  @csrf
                <input type="hidden" class="form-control" id="equestion" name="equestion" value="{{ base64_encode($readme->eid) }}">                
               
                <button type="submit" class="btn btn-primary button-style">Start <i class="fa fa-arrow-right"></i></button>
                </form>
            @else
            <div class="card"> 
                    <h3><strong>{{ $readme->examname }} [<span style="color:blue">{{ $readme->subject }}</span>]</strong></h3>
                    <h4><strong>Time: </strong> {{ $readme->hour ? $readme->hour.'hrs' : '' }} : {{ $readme->mins ? $readme->mins.'mins' : '' }} <strong>Term:</strong> {{ $readme->term }} <strong>Session: </strong>{{ $readme->session }} <strong>No. of Questions: </strong>{{ $count_question }} <strong>Questions Type: </strong>{{ $title->questionType }}</h4>
                   <div class="instruction">Exam has already been taken!</div>
                </div>
            @endif
              
               
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

@endsection