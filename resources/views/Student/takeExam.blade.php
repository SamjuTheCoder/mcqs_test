@extends('layouts.layout')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Take Exams
 
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
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
          <h3 class="time" style="margin-left:30px;">
           <b id="quizTimeCounter"><span id="getNewTime">{{ isset($getQuizTime) ? $getQuizTime : "00:15:00" }}</span></b>
          </h3>
            <br>
            
            <div class="table-responsive" style="margin-left:20px;margin-right:20px;">
              <div class="row col-md-12">
                <div class="row">
                  <center>
              
                  </center>
                </div>
              <div class="col-md-12">
                <table class="table table-responsive" style="font-size: 26px; border-style:none; background:#000;">
                <form method="get" action="{{ route('saveExam') }}">
                @csrf

                @foreach($question as $q)
                <input type="hidden" class="form-control" id="question" name="question" value="{{ base64_encode($q->id) }}">
                <input type="hidden" class="form-control" id="questionID" name="questionID" value="{{ base64_encode($q->questionID) }}">
                <!-- <input type="text" class="form-control" id="mydata" name="mydata" value=""> -->
                
                <tr>
                     <td class="bg-info">
                      <h3 style="font-size:30px">{{ $q->question }}<h3>
                    </td>

                    <td  rowspan="5" valign="middle" width="150"> 
                      <br>
                      <div class="uservideo"> 
                      <div id="my_camera"></div>
                      <div id="results" style="display:none"></div>

                      <input type="hidden" id="image" name="image" class="image-tag image-responsive">
                      </div>
                   </td>

                </tr>
                  @php  
                    $answers = DB::table('answers')->where('question_id',$q->questionID)->get();
                    $i=0;
                  @endphp
                    @foreach($answers as $ans)
                    @php $i++;   @endphp
                    <tr class="bg-success">
                        <td> Option <?php if($i==1){echo 'A';} elseif($i==2){echo 'B';} elseif($i==3){echo 'C';} elseif($i==4){echo 'D';} elseif($i==5){echo 'E';}?> <input type="radio" class="form-check-input" value="{{ base64_encode($ans->id) }}" name="answer"> {{ $ans->answer }}</td>
                    </tr>
                    @endforeach
                
               
                </table>
                @if($count_question==$count_questionx)
                  <button type="submit" value="next" name="next" class="btn btn-info buttonstyle" onClick="take_snapshot()">Next <i class="fa fa-arrow-right"></i></button>
                @elseif(($count_question<$count_questionx)&&($count_question>2))
                  <button type="submit" value="previous" name="previous" class="btn btn-info buttonstyle" onClick="take_snapshot()"><i class="fa fa-arrow-left"></i> Previous </button>
                  <button type="submit" value="next" name="next" class="btn btn-info buttonstyle" onClick="take_snapshot()">Next <i class="fa fa-arrow-right"></i></button>
                @elseif($count_question<=2)
                  <button type="submit" value="Submit" name="submit" class="btn btn-success buttonstyle" onClick="take_snapshot()">Submit <i class="fa fa-send-o"></i></button>
                @endif
               </form>
                <p>&nbsp;</p>
                @endforeach
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
        #results { padding:20px; border:1px solid; background:#ccc; }
        #my_camera {
          border-radius: 10px;
          
        }
    </style>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<script language="JavaScript">
    Webcam.set({
        width: 250,
        height: 220,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
  
    Webcam.attach( '#my_camera' );
  
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
            
            
            //var file = document.getElementById('image').value;
            
            //document.getElementById('mydata').value = dataURLtoFile(file, 'picture.png');
        } );
    }

    function dataURLtoFile(dataurl, filename) {
        var arr = dataurl.split(','),
            mime = arr[0].match(/:(.*?);/)[1],
            bstr = atob(arr[1]), 
            n = bstr.length, 
            u8arr = new Uint8Array(n);
            
        while(n--){
            u8arr[n] = bstr.charCodeAt(n);
        }
        
        return new File([u8arr], filename, {type:mime});
        }
</script>  
<script>
        //$(document).ready(function(){
            $('#bgTimer').css('background', 'green').css('color', 'white');
            $('#hideCloseWhenTimeUp').show();
            $('#hideCloseWhenTimeUp2').show();
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
                        //take_snapshot();
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
                $('#bgTimer').css('background', 'red').css('color', 'white');
                document.getElementById('quizTimeCounter').innerHTML = "Quiz Ended";
                $('#hideCloseWhenTimeUp').hide();
                $('#hideCloseWhenTimeUp2').hide();
                $('#disableAfterTimeOut *').prop('disabled', true); //disableAfterTimeOut
                $('#disableWhenExamStarts *').prop('disabled', true);
                $('#submitQuiz').click();
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

 <!-- <script type="text/javascript">
 window.onload = function() {
  startTimer();
};

document.getElementById('time').innerHTML = '90:00';
  //03 + ":" + 00 ;
 
 
function startTimer() {
  var presentTime = document.getElementById('time').innerHTML;
  var timeArray = presentTime.split(/[:]+/);
  var m = timeArray[0];
  var s = checkSecond((timeArray[1] - 1));
  if(s==59){m=m-1}
  if(m==0 && s==0){document.getElementById("form").submit();}
  
  setTimeout(startTimer, 1000);
  document.getElementById('time').innerHTML =
    m + ":" + s;
}
 
function checkSecond(sec) {
  if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
  if (sec < 0) {sec = "59"};
  return sec;
  if(sec == 0 && m == 0){ alert('stop it')};
}
</script>

<script>
    function deleteRecord(x)
    {
        var i = confirm('Do you eally want to delete?');

        if(i==true)
        {
            document.location = "/delete-answers/"+x;
        }
    }
</script> -->

<!-- <script>

    $(document).ready(function () {
          $('select').selectize({
              sortField: 'text'
          });
      });

</script>

<script>
  function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}

window.onload = function () {
    var fiveMinutes = 60 * 60,
        display = document.querySelector('#time');
    startTimer(fiveMinutes, display);
};
</script> -->

<!-- <script>
 //defining timer for donor 1 appearing on receiver dashboard

// Set the date we're counting down to
var countDownDate = new Date("").getTime();
// var countDownDate = new Date("").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
    document.getElementById("time").innerHTML =  hours + "h "
    + minutes + "m ";
    
    // If the count down is over, write some text 
    if (distance < 0) {
        location.href = "elapse.php?email=";
        clearInterval(x);
        document.getElementById("time").innerHTML = "EXPIRED";
    }
}, 1000);


</script> -->
@endsection