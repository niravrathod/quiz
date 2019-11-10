<?php $this->load->view('html_header'); ?>
<title>Start | QUIZ</title>
<style type="text/css">
body {
  background: #0c1514;
  color: #fff;
}
h1 {
  color: #63c5bc;
}
.faded {
  color: #777;
}
#quiz-counter {
  color: #88449a;
}
.quiz-container {
    padding: 0.25em;
    max-width: 650px;
    margin: 1em auto;
}

.quiz-container a {
    text-decoration: none;
    color: #333;
}

#quiz-header,
#quiz-start-screen,
#quiz-results-screen,
#quiz-counter {
    text-align: center;
}

.question {
    font-size: 1.25em;
}

.answers {
    list-style: none;
    padding: 0;
}

.answers a {
    display: block;
    padding: 0.5em 1em;
    margin-bottom: 0.5em;
    background: #fff;
}

.answers a.correct {
    background: #090;
}
.answers a.incorrect {
    background: #c00;
}

.answers a.correct,
.answers a.incorrect {
    color: #fff;
}

#quiz-controls {
    background: #63c5bc;
    color: #111;
    padding: 0.25em 0.5em 0.5em;
    text-align: center;
}

#quiz-response {}
#quiz-results {
    font-size: 1.25em;
}

#quiz-buttons a,
.quiz-container .quiz-button {
    display: inline-block;
    padding: 0.5em 1em;
    background: #88449a;
    color: #fff;
}
#quiz-buttons a {
    background: #fff;
    color: #333;
}

/* Quiz State Overrides */

.quiz-results-state #quiz-controls {
    background: none;
    padding: 0;
}
.quiz-results-state #quiz-buttons a {
    background: #88449a;
    color: #fff;
}
#white {
	color: white;
}
#green {
	color: green;
}
</style>
<body>
<div class="register-box" id="quiz">
  <div class="register-logo">
    <a href="<?php echo base_url();?>"><span id="white">Start</span>&nbsp;<span id="white">QU</span><span id="green">IZ</span></a>
  </div>
  <!-- /.register-logo -->
  <div class="register-box-body" id="quiz-start-screen">
    <p class="register-box-msg" id="quiz-header">Select Quiz And Start.</p>
      <div class="form-group has-feedback">
        <se74126
        2.zlect class="form-control select2" name="quiz_id" autofocus id="quiz_id">
        </select>
      </div>
      <div class="form-group has-feedback">
      	<button type="button" id="quiz-start-btn" class="quiz-button btn btn-block btn-flat btn-bg">Start</button>
      </div>

  </div>
  <!-- /.register-box-body -->
</div>
<!-- /.register-box -->

<?php 
$data['jquery_quiz'] = base_url().'assets/dist/js/jquery.quiz-min.js';
$this->load->view('html_footer',$data); 
?>

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
  	$('.quiz-start-btn').on('click',function(){
  		$.ajax({
		  url: '<?php echo base_url();?>dashboard/start_quiz',
		  type: "GET",
		  data:  $('#quiz_id').val(),
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
		    	//get quiz quistions and options of it. then map index with it's option id.
		    	$('#quiz').quiz({
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