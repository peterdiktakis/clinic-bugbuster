<!DOCTYPE html>
<html lang="en">

<head>
    <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">

  <title><?php echo $title ?></title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>

</head>

<div class="container">

<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?php echo ($this->session->userdata('logged_in')) ? anchor('hub', 'BugBuster Clinic', array('class' => 'navbar-brand')) : anchor('login', 'BugBusterClinic', array('class' => 'navbar-brand')) ?>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <body>
          <?php echo ($this->session->userdata('logged_in')['RECEPTION']) ? "<li>" . anchor('receptionramq', 'Reception') . "</li>" : '' ?>
          <?php echo ($this->session->userdata('logged_in')['TRIAGE']) ? "<li>" . anchor('triageoverview', 'Triage') . "</li>" : '' ?>
          <?php echo ($this->session->userdata('logged_in')['NURSE']) ? "<li>" . anchor('examination', 'Examination') . "</li>" : '' ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php echo ($this->session->userdata('logged_in')) ? "<li>" . anchor('login/logout', 'Logout') . "</li>" : '' ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
