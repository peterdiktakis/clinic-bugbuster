<div class="header"><h3 class="text-muted">Triage<small class='pull-right' style='margin-right:10px;'>Signed in as <?php echo $this->session->userdata('logged_in')['USER_ID']; ?></small></h3>
</div>

<div class ="well">

  <?php echo form_open('triageoverview'); ?>
  <div class='form' role='form'>
    <?php echo validation_errors(); ?>
    <?php if ($error) {
      //$added is a variable that comes from the header data.
      echo "<div class='alert alert-danger' role='alert'>
      <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>";
      echo " Something horrible happened. :( </div>";
    }?>

    <div class='alert alert-<? echo ($lengthOfQueue > 0) ? "warning' role='alert'> <span class = 'glyphicon glyphicon-asterisk'></span> There are patients awaiting to be triaged. <strong>Get to work!</strong>" : "info' role='alert'><span class='glyphicon glyphicon-ok'></span> There are no patients currently waiting to be triaged. Please communicate with a receptionist and refresh the page." ?></div>

    <div class="progress">

      <div class="progress-bar <?php echo ($lengthOfQueue != 0) ? 'progress-bar-striped active' : ''?>" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><?php echo "$lengthOfQueue" ?>
        <span class="sr-only"><?php echo "$lengthOfQueue patients in triage queue" ?></span>
      </div>
    </div>

    <?php echo ($lengthOfQueue != 0) ? "
    <div class='form-group'>
      <button type='submit' class='btn btn-default' aria-label='Left Align'><span class='text-muted'>Get Next Patient</span>
        <span class='glyphicon glyphicon-arrow-right' aria-hidden='true'></span>
      </button>
    </div>" : "" ?>

    <!-- end well -->
  </div>
