<?php 
  if(!$this->session->userdata('user_logged'))
  {
    redirect('');
  }
  $this->load->view('html_header');
?>

<body class="hold-transition skin-blue fixed sidebar-mini">
  <div id="overlay">
    <img src="<?php echo base_url();?>assets/image/75.gif" alt="Loading" /><br/>
    Loading...
</div>
<div class="wrapper">
	<div class="content-wrapper">
    	<section class="content">