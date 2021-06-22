@extends('layouts.layout')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create Exam
 
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Exam</a></li>
        <li class="active">Create</li>
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
            <form role="form" method="post" action="{{ route('saveExams') }}">
                @csrf
              <div class="box-body">

               <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Exam Type</label>
                  <select id="select-state" class="form-control" name="examtype" >
                                    <option value="">Choose...</option>
                                    @foreach($examtype as $pd)
                                    <option value="{{ $pd->id }}" {{ ($examtypex == $pd->id || old("examtype") == $pd->id )? "selected" :"" }}>{{$pd->type}} </option>
                                    @endforeach
                    </select> 
                </div>

                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Term</label>
                  <select id="select-state" class="form-control" name="term" >
                                    <option value="">Choose...</option>
                                    @foreach($term as $pd)
                                    <option value="{{ $pd->semester }}" {{ ($termx== $pd->semester || old("term") == $pd->semester )? "selected" :"" }}>{{$pd->semester}} </option>
                                    @endforeach
                    </select>   
                </div>

               <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Class</label>
                  <select id="class" class="form-control" name="class" >
                                    <option value="">Choose...</option>
                                    @foreach($class as $pd)
                                    <option value="{{ $pd->id }}" {{ ($classx == $pd->id || old("class") == $pd->id )? "selected" :"" }}>{{$pd->class}} </option>
                                    @endforeach
                    </select>
                </div>

                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Subject</label>
                  <select id="subject" class="form-control" name="subject" >
                                    <option value="">Choose...</option>
                                    
                    </select>
                </div>

              <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Academic Session</label>
                  <select id="select-state" class="form-control" name="session" >
                                    <option value="">Choose...</option>
                                    @foreach($session as $pd)
                                    <option value="{{ $pd->session }}" {{ ($sessionx == $pd->session || old("session") == $pd->session )? "selected" :"" }}>{{$pd->session}} </option>
                                    @endforeach
                    </select> 
                </div>

                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Academic Year</label>
                  <select id="select-state" class="form-control" name="year" >
                                    <option value="">Choose...</option>
                                    @foreach($year as $pd)
                                    <option value="{{ $pd->year }}" {{ ($yearx == $pd->year || old("year") == $pd->year )? "selected" :"" }}>{{$pd->year}} </option>
                                    @endforeach
                    </select>
                </div>
                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Question Type</label>
                  <select id="select-state" class="form-control" name="question_type" required >
                                    <option value="">Choose...</option>s
                                    @foreach($questiontype as $pd)
                                    <option value="{{ $pd->id }}" {{ ($questiontypex == $pd->id || old("question_type") == $pd->id )? "selected" :"" }}>{{$pd->questionType}} </option>
                                    @endforeach
                    </select> 
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Exam Title</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="exam" placeholder="Enter Name" value="{{ old('exam') }}" required>
                </div>

                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Exam Time(Hours)</label>
                  
                  <select name="quizTimeHour" class="form-control">
                                        <option value="">Select</option>
                                                                                    <option value="00" selected> 0 Hour(s) </option>
                                                                                    <option value="01" > 1 Hour(s) </option>
                                                                                    <option value="02" > 2 Hour(s) </option>
                                                                                    <option value="03" > 3 Hour(s) </option>
                                                                                    <option value="04" > 4 Hour(s) </option>
                                                                                    <option value="05" > 5 Hour(s) </option>
                                                                                    <option value="06" > 6 Hour(s) </option>
                                                                                    <option value="07" > 7 Hour(s) </option>
                                                                                    <option value="08" > 8 Hour(s) </option>
                                                                                    <option value="09" > 9 Hour(s) </option>
                                                                                    <option value="10" > 10 Hour(s) </option>
                                                                                    <option value="11" > 11 Hour(s) </option>
                                                                                    <option value="12" > 12 Hour(s) </option>
                                                                                    <option value="13" > 13 Hour(s) </option>
                                                                                    <option value="14" > 14 Hour(s) </option>
                                                                                    <option value="15" > 15 Hour(s) </option>
                                                                                    <option value="16" > 16 Hour(s) </option>
                                                                                    <option value="17" > 17 Hour(s) </option>
                                                                                    <option value="18" > 18 Hour(s) </option>
                                                                                    <option value="19" > 19 Hour(s) </option>
                                                                                    <option value="20" > 20 Hour(s) </option>
                                                                                    <option value="21" > 21 Hour(s) </option>
                                                                                    <option value="22" > 22 Hour(s) </option>
                                                                                    <option value="23" > 23 Hour(s) </option>
                                                                                    <option value="24" > 24 Hour(s) </option>
                                                                                    <option value="25" > 25 Hour(s) </option>
                                                                                    <option value="26" > 26 Hour(s) </option>
                                                                                    <option value="27" > 27 Hour(s) </option>
                                                                                    <option value="28" > 28 Hour(s) </option>
                                                                                    <option value="29" > 29 Hour(s) </option>
                                                                                    <option value="30" > 30 Hour(s) </option>
                                                                                    <option value="31" > 31 Hour(s) </option>
                                                                                    <option value="32" > 32 Hour(s) </option>
                                                                                    <option value="33" > 33 Hour(s) </option>
                                                                                    <option value="34" > 34 Hour(s) </option>
                                                                                    <option value="35" > 35 Hour(s) </option>
                                                                                    <option value="36" > 36 Hour(s) </option>
                                                                                    <option value="37" > 37 Hour(s) </option>
                                                                                    <option value="38" > 38 Hour(s) </option>
                                                                                    <option value="39" > 39 Hour(s) </option>
                                                                                    <option value="40" > 40 Hour(s) </option>
                                                                                    <option value="41" > 41 Hour(s) </option>
                                                                                    <option value="42" > 42 Hour(s) </option>
                                                                                    <option value="43" > 43 Hour(s) </option>
                                                                                    <option value="44" > 44 Hour(s) </option>
                                                                                    <option value="45" > 45 Hour(s) </option>
                                                                                    <option value="46" > 46 Hour(s) </option>
                                                                                    <option value="47" > 47 Hour(s) </option>
                                                                                    <option value="48" > 48 Hour(s) </option>
                                                                                    <option value="49" > 49 Hour(s) </option>
                                                                                    <option value="50" > 50 Hour(s) </option>
                                                                                    <option value="51" > 51 Hour(s) </option>
                                                                                    <option value="52" > 52 Hour(s) </option>
                                                                                    <option value="53" > 53 Hour(s) </option>
                                                                                    <option value="54" > 54 Hour(s) </option>
                                                                                    <option value="55" > 55 Hour(s) </option>
                                                                                    <option value="56" > 56 Hour(s) </option>
                                                                                    <option value="57" > 57 Hour(s) </option>
                                                                                    <option value="58" > 58 Hour(s) </option>
                                                                            </select>
                </div>
                <div class="form-group col-md-2">
                <label for="quizTimeMinute">(In Minute) <span class="text-danger">*</span></label>
                    <select name="quizTimeMinute" class="form-control" required>
                    <option value="">Select</option>
                    <option value="00" selected> 0 Minute(s) </option>
                    <option value="01" > 1 Minute(s) </option>
                    <option value="02" > 2 Minute(s) </option>
                    <option value="03" > 3 Minute(s) </option>
                    <option value="04" > 4 Minute(s) </option>
                    <option value="05" > 5 Minute(s) </option>
                    <option value="06" > 6 Minute(s) </option>
                    <option value="07" > 7 Minute(s) </option>
                    <option value="08" > 8 Minute(s) </option>
                    <option value="09" > 9 Minute(s) </option>
                    <option value="10" > 10 Minute(s) </option>
                    <option value="11" > 11 Minute(s) </option>
                    <option value="12" > 12 Minute(s) </option>
                    <option value="13" > 13 Minute(s) </option>
                    <option value="14" > 14 Minute(s) </option>
                    <option value="15" > 15 Minute(s) </option>
                    <option value="16" > 16 Minute(s) </option>
                    <option value="17" > 17 Minute(s) </option>
                    <option value="18" > 18 Minute(s) </option>
                    <option value="19" > 19 Minute(s) </option>
                    <option value="20" > 20 Minute(s) </option>
                    <option value="21" > 21 Minute(s) </option>
                    <option value="22" > 22 Minute(s) </option>
                    <option value="23" > 23 Minute(s) </option>
                    <option value="24" > 24 Minute(s) </option>
                    <option value="25" > 25 Minute(s) </option>
                    <option value="26" > 26 Minute(s) </option>
                    <option value="27" > 27 Minute(s) </option>
                    <option value="28" > 28 Minute(s) </option>
                    <option value="29" > 29 Minute(s) </option>
                    <option value="30" > 30 Minute(s) </option>
                    <option value="31" > 31 Minute(s) </option>
                    <option value="32" > 32 Minute(s) </option>
                    <option value="33" > 33 Minute(s) </option>
                    <option value="34" > 34 Minute(s) </option>
                    <option value="35" > 35 Minute(s) </option>
                    <option value="36" > 36 Minute(s) </option>
                    <option value="37" > 37 Minute(s) </option>
                    <option value="38" > 38 Minute(s) </option>
                    <option value="39" > 39 Minute(s) </option>
                    <option value="40" > 40 Minute(s) </option>
                    <option value="41" > 41 Minute(s) </option>
                    <option value="42" > 42 Minute(s) </option>
                    <option value="43" > 43 Minute(s) </option>
                    <option value="44" > 44 Minute(s) </option>
                    <option value="45" > 45 Minute(s) </option>
                    <option value="46" > 46 Minute(s) </option>
                    <option value="47" > 47 Minute(s) </option>
                    <option value="48" > 48 Minute(s) </option>
                    <option value="49" > 49 Minute(s) </option>
                    <option value="50" > 50 Minute(s) </option>
                    <option value="51" > 51 Minute(s) </option>
                    <option value="52" > 52 Minute(s) </option>
                    <option value="53" > 53 Minute(s) </option>
                    <option value="54" > 54 Minute(s) </option>
                    <option value="55" > 55 Minute(s) </option>
                    <option value="56" > 56 Minute(s) </option>
                    <option value="57" > 57 Minute(s) </option>
                    <option value="58" > 58 Minute(s) </option>
                    <option value="59" > 59 Minute(s) </option>
                    <option value="60" > 60 Minute(s) </option>
                                        
                    </select>
                </div>
                
                <div class="control-group">
              <label class="control-label">Instruction:</label>
              <div class="controls">
                 <textarea class="span11" id="editor" name="instruction"  rows="2" required>{{old('remark')}}</textarea>
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
                       <th>Exam Type</th>
                       <th>Questions Type</th>
                       <th>Term</th>
                       <th>Class</th>
                       <th>Subject</th>
                       <th>Session</th>
                       <th>Year</th>
                       <th>Exam Title </th>
                       <th>Time Alloted</th>
                       <th>Active<br> Status</th>
                       <th colspan="2">Action</th>

                  </tr>
                  </thead>
                  <tbody>
                  @php $i=1;  @endphp
                  @foreach($exams as $exam)
                  <tr>
                   <td>{{ $i++ }}</td>
                   <td>{{  $exam->type }}</td>
                   <td>{{ $exam->questionType }}</td>
                   <td>{{ $exam->term }}</td>
                    <td>{{  $exam->class }}</td>
                    <td>{{  $exam->subject }}</td>
                    <td>{{  $exam->session }}</td>
                    <td>{{ $exam->year }}</td>
                    <td>{{ $exam->examname }}</td>
                    <td>{{ $exam->hour ? $exam->hour.'hrs' : '' }}  {{ $exam->mins ? $exam->mins.'mins' : '' }} </td>
                    <td>
                    @if($exam->active_status==0)<a onclick="activateExam('{{ base64_encode($exam->qid) }}')"><button class="btn btn-danger" title="Exam Not Active"><i class="fa fa-remove"></i></button></a>
                    @elseif($exam->active_status==1) <a onclick="deactivateExam('{{ base64_encode($exam->qid) }}')"><button class="btn btn-success" title="Exam Active"><i class="fa fa-check"></i></button></a>  @endif</td>
                   </td>
                    <td><a href="add-questions/{{ base64_encode($exam->qid) }}"><button class="btn btn-info" title="Add Questions to Exam"><i class="fa fa-plus"></i></button></a>
                    <a href="view-questions/{{ base64_encode($exam->qid) }}" target="_blank"><button class="btn btn-success" title="View Questions"><i class="fa fa-eye"></i></button></a>
                    
                    <a onclick="deleteRecord('{{ base64_encode($exam->qid) }}')"><button class="btn btn-danger" title="Delete Record"><i class="fa fa-trash"></i></button></a></td>
                  
                  </tr>
                 @endforeach
                  </tbody>
                </table>

                {{ $exams->links() }}
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
 

</script>

@endsection