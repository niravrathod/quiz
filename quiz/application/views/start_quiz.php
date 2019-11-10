<?php $this->load->view('html_header'); ?>
<title>Start | QUIZ</title>
<body class="hold-transition register-page">
<div class="register-box" id="quiz">
  <div class="register-logo">
    <a href="<?php echo base_url();?>"><b>Start</b>&nbsp;<b>QU</b>IZ</a>
  </div>
  <!-- /.register-logo -->
  <div class="register-box-body">
    <p class="register-box-msg">Select Quiz And Start.</p>

    <form id="xin-form" method="post" autocomplete="on">
      <div class="form-group has-feedback">
        <select class="form-control select2" name="quiz_id" autofocus id="quiz_id">
        </select>
        <!-- <span class="glyphicon glyphicon-envelope form-control-feedback"></span> -->
      </div>
      <div class="form-group has-feedback">
      	<button type="submit" class="btn btn-success btn-block btn-flat btn-bg">Start</button>
      </div>
    </form>
    <!-- <a href="#">I forgot my password</a><br> -->

  </div>
  <!-- /.register-box-body -->
</div>
<!-- /.register-box -->

<?php $this->load->view('html_footer'); ?>

<script type="text/javascript">
  $(document).ready(function(){
  	$.ajax({
      url: '<?php echo base_url();?>dashboard/get_quiz_data',
      type: "GET",
      contentType: false,
      cache: false,
      processData:false,
      success: function(response)
      {
      	$('#quiz_id').html('');
      	$.each(JSON.parse(response),function(i,d){
        	$('#quiz_id').append('<option value="'+d.quiz_id+'">'+d.quiz_name+'</option>');
      	});
      	$('#quiz_id').select2();
      },
      error: function() 
      {
        toastr.error("Error");
        $('.icon-spinner3').hide();
        $('.save').prop('disabled', false);
      }           
     });


    $("#xin-form").submit(function(e){
    var fd = new FormData(this);
    // var toast = 1;
    var obj = $(this), action = '<?php echo base_url();?>quiz/start_quiz';
    e.preventDefault();
    $('.save').prop('disabled', true);
    $.ajax({
      url: '<?php echo base_url();?>quiz/start_quiz',
      type: "GET",
      data:  fd,
      contentType: false,
      cache: false,
      processData:false,
      success: function(response)
      {
        if (response.error != '') {
          toastr.error(response.error);
          $('.save').prop('disabled', false);
          $('.icon-spinner3').hide();
        } 
        else
        {
          //all questions and answers with index
          $('#quiz').quiz({
            //resultsScreen: '#results-screen',
            //counter: false,
            //homeButton: '#custom-home',
            counterFormat: 'Question %current of %total',
            questions: [
              {
                'q': 'Is jQuery required for this plugin?',
                'options': [
                  'Yes',
                  'No'
                ],
                'correctIndex': 0,
                'correctResponse': 'Good job, that was obvious.',
                'incorrectResponse': 'Well, if you don\'t include it, your quiz won\'t work'
              }
            ]
          });

          $('.save').prop('disabled', false);
          
        }
      },
      error: function() 
      {
        toastr.error(JSON.error);
        $('.icon-spinner3').hide();
        $('.save').prop('disabled', false);
      }           
     });
  });
  });

</script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>