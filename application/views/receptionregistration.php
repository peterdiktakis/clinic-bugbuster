<div class="header"><h3 class="text-muted">Reception<small class='pull-right' style='margin-right:10px;'>Signed in as <?php echo $this->session->userdata('logged_in')['USER_ID']; ?></small></h3>
  <!-- end header -->
</div>

<div class="well">
  <?php echo form_open('patientregistration', array('role' => 'form'));?>
  <?php echo validation_errors();?>
  <div class="form-group">
    <div class="row">
      <label class = "col-sm-2 text-center" for="ramq">RAMQ:</label>
      <div class="col-sm-6">
        <input readonly = 'readonly' type="email" class="form-control" name="ramq" placeholder="RAMQ" value=<?php echo (isset($patient['RAMQ_ID']) ? $patient['RAMQ_ID'] : '') ?>>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="row">
      <label class = "col-sm-2 text-center" for="firstName">Patient Name:</label>
      <div class="col-sm-2">
        <input type="email" class="form-control" name="firstName" placeholder="First Name" value=<?php echo (isset($patient['FIRST_NAME']) ? $patient['FIRST_NAME'] : '') ?>>
      </div>
      <div class="col-sm-2">
        <input type="email" class="form-control" name="lastName" placeholder="Last Name" value=<?php echo (isset($patient['LAST_NAME']) ? $patient['LAST_NAME'] : '') ?>>
      </div>
    </div>
  </div>
</form>
</div>
