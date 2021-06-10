@extends('layouts.layout')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View Questions
 
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Question</a></li>
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
            <form role="form" method="post" action="{{ route('saveQuestions') }}">
                @csrf
              <div style="margin-left:10px;font-size:20px;"> 
              Exam Title: <span style="color:blue">{{ $title->examname }}</span>, 
              Exam Type: <span style="color:blue">{{ $title->type }}</span>, 
              Exam Session : <span style="color:blue">{{ $title->session }}</span>, 
              Exam Class: <span style="color:blue">{{ $title->class }}</span><br/>
              
              </div>
              
            </form>
        <hr>
            <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                  <tr>
                       <th>SN</th>
                       <th>Questions</th>
                       <th>Options</th>
                       <th colspan="2">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @php $i=1;  @endphp
                  @foreach($questions as $question)
                  @php $options_count=DB::table('answers')->where('question_id',$question->qid)->count(); @endphp
                  <tr>
                   <td>{{ $i++ }}</td>
                    <td>{{ $question->question }} [<span style="color:green;font-weight:bold"> {{ $question->score }} marks</span>]</td>
                    <td><span class="badge">{{ $options_count}}</span></td>
                    <td>
                    <a href="/add-options/{{ base64_encode($question->qid) }}" target="_blank"><button class="btn btn-info" title="Add Options to Questions"><i class="fa fa-plus"></i></button></a>
                    <a onclick="deleteRecord('{{ base64_encode($question->qid) }}')"><button class="btn btn-danger" title="Delete Record"><i class="fa fa-trash"></i></button></a></td>
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