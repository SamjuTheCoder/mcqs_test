@extends('layouts.layout')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        My Exam Answers
 
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">My Exam Answers</a></li>
       
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
          
            <!-- /.box-header -->
            <!-- form start -->
            
        
        <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                       <th>SN</th>
                       <th>Questions</th>
                       <th>Answer</th>
                       <th>Score</th>
                  </tr>
                  </thead>
                  <tbody>
                  @php 
                  $i=1; 
                  $score=0;
                  @endphp
                  @foreach($myAnswers as $question)
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $question->question }}</td>
                    <td>{{ $question->answer }} @if($question->correct_answer==null) <i  class="fa fa-remove" style="color:red"></i> @else <i  class="fa fa-check" style="color:green"></i> @endif</td>
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