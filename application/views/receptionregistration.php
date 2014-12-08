<div class="header"><h3 class="text-muted">Reception<small class='pull-right' style='margin-right:10px;'>Signed in as <?php echo $this->session->userdata('logged_in')['USER_ID']; ?></small></h3>
  <!-- end header -->
</div>

<div class="well">
  <?php echo form_open('receptionregistration', array('role' => 'form'));?>
  <?php echo validation_errors();?>
  <div class="form-group">
    <div class="row">
      <label class = "col-sm-2 text-center" for="ramq">RAMQ:</label>
      <div class="col-sm-6">
        <input readonly = 'readonly' type="text" class="form-control" name="ramq" placeholder="RAMQ" value="<?php echo (isset($patient['RAMQ_ID']) ? $patient['RAMQ_ID'] : '') ?>">
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="row">
      <label class = "col-sm-2 text-center" for="firstName">Patient Name:</label>
      <div class="col-sm-2">
        <input type="text" class="form-control" name="firstName" placeholder="First Name" value="<?php echo (isset($patient['FIRST_NAME']) ? $patient['FIRST_NAME'] : '') ?>">
      </div>
      <div class="col-sm-2">
        <input type="text" class="form-control" name="lastName" placeholder="Last Name" value="<?php echo (isset($patient['LAST_NAME']) ? $patient['LAST_NAME'] : '') ?>">
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="row">
      <label class = "col-sm-2 text-center" for="homePhone">Home Phone:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="homePhone" placeholder="Home Phone #" value="<?php echo (isset($patient['PHONE_HOME']) ? $patient['PHONE_HOME'] : '') ?>">
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="row">
      <label class = "col-sm-2 text-center" for="emergencyPhone">Emergency Phone:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="emergencyPhone" placeholder="Emergency Phone #" value="<?php echo (isset($patient['PHONE_EMERGENCY']) ? $patient['PHONE_EMERGENCY'] : '') ?>">
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="row">
      <label class = "col-sm-2 text-center" for="existingConditions">Existing Conditions:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="existingConditions" placeholder="Existing Conditions" value="<?php echo (isset($patient['EXISTING_CONDITIONS']) ? $patient['EXISTING_CONDITIONS'] : '') ?>">
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="row">
      <label class = "col-sm-2 text-center" for="primaryPhysician">Primary Care Physician:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="primaryPhysician" placeholder="Primary Care Physician" value="<?php echo (isset($patient['PHYSICIAN']) ? $patient['PHYSICIAN'] : '') ?>">
      </div>
    </div>
  </div>

  <div class='form-group'>
    <div class='row'>
      <label for='medication1' class='col-sm-2 control-label text-center'>Medication 1</label>
      <div class='col-sm-4'><select class='form-control' name='medication1'>
        <?php
        foreach($medications as $item => $value) {
          if (isset($patient['MEDICATION_1'])) {
            if ($value == $patient['MEDICATION_1']) {
              echo "<option selected='selected'>$value</option>";
            } else {
              echo "<option>$value</option>";
            }
          }
          else {
            echo "<option>$value</option>";
          }
        }
        echo "</select></div></div></div>";

        echo "<div class='form-group'><div class='row'><label for='medication2' class='col-sm-2 control-label text-center'>Medication 2</label>";
        echo "<div class='col-sm-4'><select class='form-control' name='medication2'>";

        foreach($medications as $item => $value) {
          if (isset($patient['MEDICATION_2'])) {
            if ($value == $patient['MEDICATION_2'])
            echo "<option selected='selected'>$value</option>";
            else {
              echo "<option>$value</option>";
            }
          }
          else {
            echo "<option>$value</option>";
          }
        }
        echo "</select></div></div></div>";

        echo "<div class='form-group'><div class='row'><label for='medication3' class='col-sm-2 control-label text-center'>Medication 3</label>";
        echo "<div class='col-sm-4'><select class='form-control' name='medication3'>";

        foreach($medications as $item => $value) {
          if (isset($patient['MEDICATION_3'])) {
            if ($value == $patient['MEDICATION_3'])
              echo "<option selected='selected'>$value</option>";
            else {
              echo "<option>$value</option>";
            }
          }
          else {
            echo "<option>$value</option>";
          }
        }
        ?>
      </select>
    </div>
  </div>
</div>

<div class='form-group'>
  <div class='row'>
    <div class='col-md-4'>
      <button type='submit' class='btn btn-primary col-sm-offset-7' value='Submit'>Add Patient To Triage Queue <span class="glyphicon glyphicon-arrow-right"></span></button></div>
    </div>
  </div>
</form>
</div>
