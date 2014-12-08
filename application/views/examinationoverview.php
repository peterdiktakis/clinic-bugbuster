<div class="header"><h3 class="text-muted">Examination<small class='pull-right' style='margin-right:10px;'>Signed in as <?php echo $this->session->userdata('logged_in')['USER_ID']; ?></small></h3>
</div>

<div class="well">
  <?php echo form_open('examinationoverview', array('role' => 'form')); ?>
  <?php echo validation_errors(); ?>
  <?php if ($error) {
    echo "<div class='alert alert-danger' role='alert'>
    <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>";
    echo " There was no one to dequeue. </div>";
  }
  if ($added) {
    //$added is a variable that comes from the header data.
    echo "<div class='alert alert-success' role='alert'>
    <span class='glyphicon glyphicon-user' aria-hidden='true'></span>";
    echo " $added </div>";
  }
  ?>

  <?php if($totalLengthOfQueues == 0) echo "<div class='alert alert-info' role='alert'><span class='glyphicon glyphicon-ok'></span> There are no patients currently waiting to be seen. Please communicate with a triage worker and refresh the page. " . anchor('examinationoverview', "Refresh <span class='glyphicon glyphicon-refresh'></span>", array('class' => 'btn btn-default')) . "</div>" ?>
  <div id="examinationQueues">
    <div class="progress">
      <div class="progress-bar progress-bar-danger" style="width: <?php echo isset($queueViewPercentages['1']) ? $queueViewPercentages['1'] : '0' ?>%">
        <?php echo $queueLengths['1']; ?>
      </div>
      <div class="progress-bar progress-bar-warning" style="width: <?php echo isset($queueViewPercentages['2']) ? $queueViewPercentages['2'] : '0' ?>%">
        <?php echo $queueLengths['2']; ?>
      </div>
      <div class="progress-bar progress-bar-info" style="width: <?php echo isset($queueViewPercentages['3']) ? $queueViewPercentages['3'] : '0' ?>%">
        <?php echo $queueLengths['3']; ?>
      </div>
      <div class="progress-bar progress-bar-success" style="width: <?php echo isset($queueViewPercentages['4']) ? $queueViewPercentages['4'] : '0' ?>%">
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
  </div>
  <?php if($totalLengthOfQueues == 0) echo "<script>$('#examinationQueues').hide();</script>" ?>

  <div class='form-group' style="padding-top: 10px">
    <button type='submit' class='btn-primary btn-lg btn-block' aria-label='Left Align' <?php echo ($totalLengthOfQueues > 0) ? "" : "disabled='disabled'" ?>>Get Next Patient
      <span class='badge'><?php echo $totalLengthOfQueues ?></span>
    </button>
  </div>
</form>
</div>
