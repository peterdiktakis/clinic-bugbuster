<div class="header"><h3 class="text-muted">Triage<small class='pull-right' style='margin-right:10px;'>Signed in as <?php echo $this->session->userdata('logged_in')['USER_ID']; ?></small></h3>
</div>

<div class ="well">

  <?php echo form_open('triageoverview', array('role' => 'form')); ?>
  <?php echo validation_errors(); ?>
    <?php if ($error) {
      echo "<div class='alert alert-danger' role='alert'>
      <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>";
      echo " There was no one to dequeue. </div>";
    }?>

    <div class='alert alert-<?php echo ($lengthOfQueue > 0) ? "warning' role='alert'> <span class = 'glyphicon glyphicon-asterisk'></span> There are patients waiting to be triaged. <strong>Get to work!</strong>" : "info' role='alert'><span class='glyphicon glyphicon-ok'></span> There are no patients currently waiting to be triaged. Please communicate with a receptionist and refresh the page. " . anchor('triageoverview', "Refresh <span class='glyphicon glyphicon-refresh'></span>", array('class' => 'btn btn-default')) ?></div>

    <div class='form-group'>
    <button type='submit' class='btn-primary btn-lg btn-block' aria-label='Left Align' <?php echo ($lengthOfQueue > 0) ? "" : "disabled='disabled'" ?>>Get Next Patient
    <span class='badge'><?php echo $lengthOfQueue ?></span>
    </button>
    </div>
  </form>
  </div>
</div>
