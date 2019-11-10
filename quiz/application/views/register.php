<?php $this->load->view('html_header'); ?>
<title>Register | QUIZ</title>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="<?php echo base_url();?>"><b>QU</b>IZ</a>
  </div>
  <!-- /.register-logo -->
  <div class="register-box-body">
    <p class="register-box-msg">Register to start your session</p>

    <form id="xin-form" method="post" autocomplete="on">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" autofocus id="username" placeholder="Enter Username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <a href="<?php base_url();?>login">Already Have Account?</a>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign Up</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- <a href="#">I forgot my password</a><br> -->

  </div>
  <!-- /.register-box-body -->
</div>
<!-- /.register-box -->

<?php $this->load->view('html_footer'); ?>

<script type="text/javascript">
  function selectRedirect() {
      window.location.replace("<?php echo base_url();?>register/select_branch/");
  }
  $(document).ready(function(){
    $("#xin-form").submit(function(e){
    var fd = new FormData(this);
    // var toast = 1;
    var obj = $(this), action = '<?php echo base_url();?>register/check_register';
    e.preventDefault();
    // alert('<?php echo base_url();?>register/check_register');
    $('.save').prop('disabled', true);
    $.ajax({
      url: '<?php echo base_url();?>register/check_register',
      type: "POST",
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
          /*xin_table.api().ajax.reload(function()
          {*/ 
            // toastr.success(response.result, "Congratulation!", {'timeOut': 8000,'autoclose': false});
            // delay(function(){
            // }, 5000 );
          /*}, true);*/
          $('#xin-form')[0].reset(); // To reset form fields
          $('.save').prop('disabled', false);
          localStorage.setItem("welcome_toast",1);
          localStorage.setItem("welcome_result",response.result);
          // localStorage.setItem("welcome_username",true);
          window.location.href = "<?php echo base_url();?>dashboard";
          /*toastr.success(response.result);*/
          // $('#myModal').modal('hide');
          
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