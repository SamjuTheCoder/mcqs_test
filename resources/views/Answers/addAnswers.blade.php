@extends('layouts.layout')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Answers
 
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Answers</a></li>
        <li class="active">Add</li>
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
         
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{ route('saveAnswer') }}">
                @csrf
              <div class="box-body">
              
                <div class="form-group">
                  <label for="exampleInputEmail1">Question</label>
                  <select id="select-state" class="form-control" name="question" >
                                    <option value="">Choose...</option>
                                    @foreach($question as $pd)
                                    <option value="{{ $pd->qid }}" {{ ($questionx == $pd->qid || old("question") == $pd->qid )? "selected" :"" }}>{{$pd->question}} </option>
                                    @endforeach
                                </select>
                </div>
              
              <div class="row">
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Answer</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="answer" placeholder="Enter Answer" required>
                  <label>
                    <input type="checkbox" name="correct_answer" value="1"> Is correct answer?
                  </label>
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
                       <th>Questions</th>
                       <th>Answer</th>
                       <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @php $i=1;  @endphp
                  @foreach($answer as $ans)
                  <tr>
                   <td>{{ $i++ }}</td>
                    <td>{{ $ans->question }}</td>
                    <td>{{ $ans->answer }} @if($ans->correct_answer==1)<span class="fa fa-check" style="color:red"></span>@else @endif</td>
                    <td><a onclick="deleteRecord('{{ base64_encode($ans->id) }}')"><button class="btn btn-info"><i class="fa fa-trash"></i></button></a></td>
                  </tr>
                 @endforeach
                
                </tbody>
                </table>
               
              </div>
              {{ $answer->links() }}
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

<script>

    $(document).ready(function () {
          $('select').selectize({
              sortField: 'text'
          });
      });

</script>
@endsection