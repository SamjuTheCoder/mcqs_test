@extends('layouts.layout')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Result Preview
 
      </h1>
      <ol class="breadcrumb">
        <li><a href="/homr"><i class="fa fa-dashboard"></i> Home</a></li>
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
               

               
                <div class="card"> 
                  @if($current_subject==null)
                  @else
                   <h3> {{ $current_subject->subject }}</h3>
                  @endif
                </div>
                
                <div class="card"> 
                <table class="table no-margin">
                  <thead>
                  <tr>
                       <th>SN</th>
                       <th>Questions</th>
                       <th>Answers</th>
                       <th>Supplied Answer</th>
                       <th>Score</th>
                  </tr>
                  </thead>
                  <tbody>
                  @php 
                  $i=1; 
                  $score=0;
                  @endphp
                  @foreach($scores as $question)
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $question->question }}</td>
                    <td>{{ strip_tags($question->answer) }}</td>
                    <td>{{ $question->subjective_answer }} @if($question->correct_answer==null) <i  class="fa fa-remove" style="color:red"></i> @else <i  class="fa fa-check" style="color:green"></i> @endif</td>
                    <td>@if($question->correct_answer==null) {{ '0'}} @else {{ $question->score }} @php $score+=$question->score @endphp @endif</td>
                  </tr>
                 @endforeach
                  <tr>
                  <td><strong>Total Score</strong></td>
                  <td></td>
                  <td></td>
                  <td><strong>{{ $score }}</strong></td>
                 </tr>
                  </tbody>
                </table>
                </div>
              
                
               
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
    function deleteRecord(x)
    {
        var i = confirm('Do you eally want to delete?');

        if(i==true)
        {
            document.location = "/delete-answers/"+x;
        }
    }
</script>

@endsection