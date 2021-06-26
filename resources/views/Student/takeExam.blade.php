@extends('layouts.layout')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Take Exams
 
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
        @php  $count = DB::table('student_exam_times')->where('examID',Session::get('examID'))->where('studentID',Auth::user()->id)->first();  @endphp
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
          <div class="pull-left">
            <h3 class="time" style="margin-left:30px;">
            <b id="quizTimeCounter" style="font-size:16px" class="badge"><span id="getNewTime" >{{ isset($getQuizTime) ? $getQuizTime : "00:15:00" }}</span></b>
            </h3>
          </div>

          <div class="pull-right">
            <h3 class="time" style="margin-right:30px;">
            <center><span class="badge" style="font-size:16px">{{ $count->questions_count }} Questions</span>  </center>
            </h3>
          </div>
            <br>
            
            <div class="table-responsive" style="margin-left:20px;margin-right:20px;">
              <div class="row col-md-12">
                
              <div class="col-md-12">
                <table class="table table-responsive" style="font-size: 26px; border-style:none; background:#000;">
                <form  method="get" action="{{ route('saveExam') }}">
                @csrf

                
                <input type="hidden" class="form-control" id="question" name="question" value="{{ base64_encode($question->id) }}">
                <input type="hidden" class="form-control" id="questionID" name="questionID" value="{{ base64_encode($question->questionID) }}">
                <!-- <input type="text" class="form-control" id="mydata" name="mydata" value=""> -->
               
                <tr>
                     <td class="bg-info">
                      <h3 style="font-size:20px"><strong>{{ $question->question }}</strong><h3>
                    </td>

                    <td  rowspan="5" valign="middle" width="150" class="bg-info"> 
                      <br>
                      <div class="uservideo badge badge-success"> 
                      <div id="my_camera"></div>
                      <div id="results" style="display:none"></div>

                      <input type="hidden" id="image" name="image" class="image-tag image-responsive">
                      </div>
                   </td>

                </tr>
                @if($question_type==1)
                        <tr class="bg-success">
                            <td> <textarea class="form-control" rows="3" id="exampleInputEmail1" name="answer" placeholder="Enter Answer" required ></textarea></td>
                        </tr>
                @elseif($question_type==2)
                        <tr class="bg-success">
                            <td> <textarea class="form-control" rows="3" id="exampleInputEmail1" name="answer" placeholder="Enter Answer" required ></textarea></td>
                        </tr>
                @elseif($question_type==3)
                          @php  
                            $answers = DB::table('answers')->where('question_id',$question->questionID)->get();
                            $i=0;
                          @endphp
                            @foreach($answers as $ans)
                            @php $i++;   @endphp
                            <tr class="bg-success">
                                <td> <strong>Option <?php if($i==1){echo 'A';} elseif($i==2){echo 'B';} elseif($i==3){echo 'C';} elseif($i==4){echo 'D';} elseif($i==5){echo 'E';}?> <input type="radio" class="form-check-input" value="{{ base64_encode($ans->id) }}" name="answer" required></strong> {{ strip_tags($ans->answer) }}</td>
                            </tr>
                            @endforeach
                @endif
                
                </table>
                @if(($count->questions_count==$count_questionx)&&($count->questions_count>1))
                  <button type="submit" value="next" id="nextx" name="next" class="btn btn-info text-black buttonstyle btn-block badge badge-warning" onClick="take_snapshot()">Next <i class="fa fa-arrow-right"></i></button>
                  <button type="submit" style="display:none" value="Submit" id="submitQuizx" name="submit" class="btn btn-success text-black buttonstyle btn-block badge badge-danger" onClick="take_snapshot()">Submit <i class="fa fa-send-o"></i></button>
                @elseif(($count->questions_count<$count_questionx)&&($count->questions_count>=2))
                <button type="submit" value="next" id="next" name="next" class="btn btn-info buttonstyle text-black btn-block badge badge-warning" onClick="take_snapshot()">Next <i class="fa fa-arrow-right"></i></button>
                <button type="submit" style="display:none" value="Submit" id="submitQuizy" name="submit" class="btn btn-success text-black buttonstyle btn-block badge badge-danger" onClick="take_snapshot()">Submit <i class="fa fa-send-o"></i></button>
                <button type="submit" value="previous" id="previous" name="previous" class="btn btn-primary text-black buttonstyle btn-block badge badge-success" onClick="take_snapshot()"><i class="fa fa-arrow-left"></i> Previous </button>
                @elseif($count->questions_count==1)
                  <button type="submit" value="Submit" id="submitQuiz" name="submit" class="btn btn-success text-black buttonstyle btn-block badge badge-danger" onClick="take_snapshot()">Submit <i class="fa fa-send-o"></i></button>
                @endif
                <div id="message" style="color:red;background-color:white;display:none"><center>Time up!!! Please submit now to avoid system failure!<center></div>
               
               </form>
                <p>&nbsp;</p>
                
                </div>
                
              </div>  
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
@section('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <style type="text/css">
        
    </style>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script> -->

<script language="JavaScript">
    Webcam.set({
        width: 160,
        height: 120,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
  
    Webcam.attach( '#my_camera' );
  
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
           
        } );
    }

    
</script>  
<script>
        //$(document).ready(function(){
            $('#bgTimer').css('background', 'green').css('color', 'white');
            var getQuizTime = $('#getNewTime').html(); //"00:15:00";
            if (getQuizTime == "00:00:00") {
                clearInterval(countdownTimer);
                //submit quiz
                endQuiz(countdownTimer);
            }
            var setTimerCounter = getQuizTime;
            var a = setTimerCounter.split(':'); // split it at the colons
            // minutes are worth 60 seconds. Hours are worth 60 minutes.
            var seconds = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]);
            if(seconds > 0)
            {
                function secondPassed()
                {
                    var minutes = Math.round((seconds - 30)/60);
                        remainingSeconds = seconds % 60;
                        var hour   =Math.floor((minutes)/60);
                        minutes = minutes%60;
                    if (hour < 1 && minutes < 10) {
                        $('#bgTimer').css('background', 'yellow').css('color', 'green');
                    }
                    if ((minutes == 00)) {
                        remainingSeconds = "0" + remainingSeconds;
                        $('#bgTimer').css('background', 'red').css('color', 'white');
                    }

                    hour = ("0" + hour).slice(-2);
                    minutes = ("0" + minutes).slice(-2);
                    remainingSeconds= ("0" + remainingSeconds).slice(-2);

                    document.getElementById('quizTimeCounter').innerHTML = hour +":" +minutes + ":" + remainingSeconds;
                    if (seconds == 0) { //submit quiz
                        clearInterval(countdownTimer);
                        var getCurrent =  (hour +":"+ minutes +":"+ remainingSeconds);
                        updateTime(getCurrent);
                        endQuiz(countdownTimer);
                        
                    } else {
                        seconds--;
                        var getCurrent =  (hour +":"+ minutes +":"+ remainingSeconds);
                        updateTime(getCurrent);
                        //take_snapshot();
                    }

                }
                var countdownTimer = setInterval('secondPassed()', 1000);

            }
            function endQuiz(countdownTimer)
            {

                document.getElementById('quizTimeCounter').innerHTML = "Exam Ended";
                document.getElementById("message").style.display='block';
                document.getElementById("nextx").style.display='none';
                document.getElementById("submitQuizx").style.display='block';
                document.getElementById("submitQuizy").style.display='block';
                document.getElementById("previous").style.display='none';
                document.getElementById("next").style.display='none';
                
                clearInterval(countdownTimer);
            }


        function updateTime(getCurrent)
        {
            $.ajax({
                url: '{{url("/")}}' +  '/update_quiz_time',
                type: 'post',
                data: {'getTime': getCurrent, '_token': $('input[name=_token]').val()},
                success: function(data) {
                },
                error: function(error) {
                    //alert("Network fluctuating... Time paused! \n\n Click OK to continue.");
                    $( "#timePaused" ).slideDown( 300 ).delay( 800 ).slideUp( 400 );
                }
            });
        }
    //});
    </script>

@endsection