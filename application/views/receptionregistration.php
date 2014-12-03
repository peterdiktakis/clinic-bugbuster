<div class="header"><h3 class="text-muted">Reception<small class='pull-right' style='margin-right:10px;'>Signed in as <?php echo $this->session->userdata('logged_in')['USER_ID']; ?></small></h3>
  <!-- end header -->
</div>

<div class="well">

  <?php echo form_open('patientregistration', array('role' => 'form'));?>
  <?php echo validation_errors();?>
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
    </div>
  </form>
</div>
