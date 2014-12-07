<div class="header"><h3 class="text-muted">Hub<small class='pull-right' style='margin-right:10px;'>Signed in as <?php echo $this->session->userdata('logged_in')['USER_ID']; ?></small></h3>
</div>


<div class ="well">

	<h2>What is your task for today?</h2>

	<div class="btn-group btn-group-justified" role="group" aria-label="List of tasks.">
		<?php echo ($reception) ? anchor('receptionramq', 'Reception', array('class' => 'progress-bar progress-bar-success progress-bar-striped btn btn-success btn-lg btn-block')) : "" ?>

		<?php echo ($triage) ? anchor('triageoverview', 'Triage', array('class' => 'progress-bar progress-bar-info progress-bar-striped btn btn-info btn-lg btn-lg btn-block')) : "" ?>

		<?php echo ($nurse) ? anchor('examinationoverview', 'Examination', array('class' => 'progress-bar progress-bar-warning progress-bar-striped btn btn-warning btn-lg btn-block')) : "" ?>
	</div>
</div>
