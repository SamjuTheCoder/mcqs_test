@extends('layouts.layout')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Questions
 
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
              <div class="box-body">
              
                <div class="form-group col-md-10">
                  <label for="exampleInputEmail1">Question</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="question" placeholder="Enter Questions" value="{{ old('question') }}" required>
                  <input type="hidden" class="form-control" id="exam" name="exam" value="{{ $examID }}">
                
                </div>

                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Mark</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="score" placeholder="Enter Score" value="{{ old('score') }}" >
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
                       <th>Questions</th>
                       <th>Mark</th>
                       <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @php $i=1;  @endphp
                  @foreach($questions as $question)
                  <tr>
                   <td>{{ $i++ }}</td>
                    <td>{{ $question->question }}</td>
                    <td>{{ $question->score }}</td>
                    <td><a onclick="deleteRecord('{{ base64_encode($question->qid) }}')"><button class="btn btn-danger" title="Delete Record"><i class="fa fa-trash"></i></button></a></td>
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