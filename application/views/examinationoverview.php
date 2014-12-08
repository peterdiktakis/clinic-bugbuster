<div class="header"><h3 class="text-muted">Examination<small class='pull-right' style='margin-right:10px;'>Signed in as <?php echo $this->session->userdata('logged_in')['USER_ID']; ?></small></h3>
</div>

<div class="well">
  <?php echo form_open('examinationoverview', array('role' => 'form')); ?>
  <?php echo validation_errors(); ?>
  <div class="progress">
    <div class="progress-bar progress-bar-danger" style="width: <?php echo isset($queueViewPercentages['1']) ? $queueViewPercentages['1'] : '0' ?>%">
      <?php echo $queueLengths['1']; ?>
    </div>
    <div class="progress-bar progress-bar-warning progress-bar-striped" style="width: <?php echo isset($queueViewPercentages['2']) ? $queueViewPercentages['2'] : '0' ?>%">
      <?php echo $queueLengths['2']; ?>
    </div>
    <div class="progress-bar progress-bar-info" style="width: <?php echo isset($queueViewPercentages['3']) ? $queueViewPercentages['3'] : '0' ?>%">
      <?php echo $queueLengths['3']; ?>
    </div>
    <div class="progress-bar progress-bar-success progress-bar-striped" style="width: <?php echo isset($queueViewPercentages['4']) ? $queueViewPercentages['4'] : '0' ?>%">
      <?php echo $queueLengths['4']; ?>
    </div>
    <div class="progress-bar progress-bar-primary" style="width: <?php echo isset($queueViewPercentages['5']) ? $queueViewPercentages['5'] : '0' ?>%">
      <?php echo $queueLengths['5']; ?>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 col-centered text-center">
      <label for="legend">Legend : </label>
      <div class="btn-group" id='legend' role="group" aria-label="Center">
        <button type="button" class="btn btn-danger">1</button>
        <button type="button" class="btn btn-warning">2</button>
        <button type="button" class="btn btn-info">3</button>
        <button type="button" class="btn btn-success">4</button>
        <button type="button" class="btn btn-primary">5</button>
      </div>
    </div>
  </div>
  <div class="row" style="padding-top: 10px">
    <div class='form-group'>
      <button type='submit' class='btn-primary btn-lg btn-block' aria-label='Left Align' <?php echo ($totalLengthOfQueues > 0) ? "" : "disabled='disabled'" ?>>Get Next Patient
        <span class='badge'><?php echo $totalLengthOfQueues ?></span>
      </button>
    </div>
  </div>
</form>
</div>
