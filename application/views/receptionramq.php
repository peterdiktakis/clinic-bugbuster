<div class="header"><h3 class="text-muted">Reception<small class='pull-right' style='margin-right:10px;'>Signed in as <?php echo $this->session->userdata('logged_in')['USER_ID']; ?></small></h3>
	<!-- end header -->
</div>

<div class ="well">
	<?php echo form_open('receptionramq', array('role' => 'form')); ?>
		<?php echo validation_errors(); ?>
		<?php if ($added) {
			//$added is a variable that comes from the header data.
			echo "<div class='alert alert-success' role='alert'>
			<span class='glyphicon glyphicon-user' aria-hidden='true'></span>";
			echo " $added </div>";
		}?>

		<div class='form-group'>
			<label for='ramq'>Please enter the patient's RAMQ number:</label>
			<input type='text' class='form-control' name='ramq' placeholder="Patient's RAMQ Number">
		</div>

		<div class='form-group'>
			<button type='submit' class='btn' value='Submit'>Continue <span class="glyphicon glyphicon-arrow-right"></span></button>
		</div>
	</form>
</div>
