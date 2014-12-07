<div class="header"><h3 class="text-muted">Triage<small class='pull-right' style='margin-right:10px;'>Signed in as <?php echo $this->session->userdata('logged_in')['USER_ID']; ?></small></h3>
</div>

<div class="well">
  <?php echo form_open('triagedetail', array('role' => 'form'));?>
  <?php echo validation_errors();?>
  <div class="form-group">
    <div class="row">
      <label class = "col-sm-2 text-center" for="ramq">RAMQ:</label>
      <div class="col-sm-6">
        <input readonly = "readonly" type="text" class="form-control" name="ramq" placeholder="RAMQ" value="<?php echo (isset($patient['RAMQ_ID']) ? $patient['RAMQ_ID'] : '') ?>">
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="row">
      <label class = "col-sm-2 text-center" for="firstName">Patient Name:</label>
      <div class="col-sm-2">
        <input readonly = "readonly" type="text" class="form-control" name="firstName" placeholder="First Name" value="<?php echo (isset($patient['FIRST_NAME']) ? $patient['FIRST_NAME'] : '') ?>">
      </div>
      <div class="col-sm-2">
        <input readonly = "readonly" type="text" class="form-control" name="lastName" placeholder="Last Name" value="<?php echo (isset($patient['LAST_NAME']) ? $patient['LAST_NAME'] : '') ?>">
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="row">
      <label class = "col-sm-2 text-center" for="homePhone">Home Phone:</label>
      <div class="col-sm-6">
        <input readonly = "readonly" type="text" class="form-control" name="homePhone" placeholder="Home Phone #" value="<?php echo (isset($patient['PHONE_HOME']) ? $patient['PHONE_HOME'] : '') ?>">
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="row">
      <label class = "col-sm-2 text-center" for="emergencyPhone">Emergency Phone:</label>
      <div class="col-sm-6">
        <input readonly = "readonly" type="text" class="form-control" name="emergencyPhone" placeholder="Emergency Phone #" value="<?php echo (isset($patient['PHONE_EMERGENCY']) ? $patient['PHONE_EMERGENCY'] : '') ?>">
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="row">
      <label class = "col-sm-2 text-center" for="existingConditions">Existing Conditions:</label>
      <div class="col-sm-6">
        <input readonly = "readonly" type="text" class="form-control" name="existingConditions" placeholder="Existing Conditions" value="<?php echo (isset($patient['EXISTING_CONDITIONS']) ? $patient['EXISTING_CONDITIONS'] : '') ?>">
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="row">
      <label class = "col-sm-2 text-center" for="primaryPhysician">Primary Care Physician:</label>
      <div class="col-sm-6">
        <input readonly = "readonly" type="text" class="form-control" name="primaryPhysician" placeholder="Primary Care Physician" value="<?php echo (isset($patient['PHYSICIAN']) ? $patient['PHYSICIAN'] : '') ?>">
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="row">
      <label class = "col-sm-2 text-center" for="primaryPhysician">Medication 1:</label>
      <div class="col-sm-6">
        <input readonly = "readonly" type="text" class="form-control" name="primaryPhysician" placeholder="Medication 1" value="<?php echo (isset($patient['MEDICATION_1']) ? $patient['MEDICATION_1'] : '') ?>">
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="row">
      <label class = "col-sm-2 text-center" for="primaryPhysician">Medication 2:</label>
      <div class="col-sm-6">
        <input readonly = "readonly" type="text" class="form-control" name="primaryPhysician" placeholder="Medication 2" value="<?php echo (isset($patient['MEDICATION_2']) ? $patient['MEDICATION_2'] : '') ?>">
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="row">
      <label class = "col-sm-2 text-center" for="primaryPhysician">Medication 3:</label>
      <div class="col-sm-6">
        <input readonly = "readonly" type="text" class="form-control" name="primaryPhysician" placeholder="Medication 3" value="<?php echo (isset($patient['MEDICATION_3']) ? $patient['MEDICATION_3'] : '') ?>">
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="row">
      <label class = "col-sm-2 text-center" for="primaryComplaint">Primary Complaint:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="primaryComplaint" placeholder="Primary Complaint">
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="row">
      <label class = "col-sm-2 text-center" for="primaryComplaint">Symptom 1:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="symptom1" placeholder="Symptom 1">
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="row">
      <label class = "col-sm-2 text-center" for="primaryComplaint">Symptom 2:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="symptom2" placeholder="Symptom 2">
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class = "row">
      <label class = "col-sm-2 text-center" for="priority">Priority:</label>
      <div class="col-sm-6">
        <select class='form-control' name='priority'>
          <?php for($i = 1; $i <= 5; $i++)
                  echo "<option>$i</option>";
          ?>
        </select>
      </div>
    </div>
  </div>

  <div class='form-group'>
    <div class='row'>
      <div class='col-md-4'>
        <button type='submit' class='btn btn-primary col-sm-offset-7' value='Submit'>Triage Patient <span class="glyphicon glyphicon-arrow-right"></span></button></div>
      </div>
    </div>
  </div>
</form>
