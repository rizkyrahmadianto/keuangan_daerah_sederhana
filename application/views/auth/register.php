<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
        <div class="col-lg-7">
          <div class="p-5">

            <?php if ($this->session->flashdata('success')) { ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo $this->session->flashdata('success'); ?>
              </div>
            <?php } else if ($this->session->flashdata('error')) { ?>
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                <?php echo $this->session->flashdata('error'); ?>
              </div>
            <?php } ?>

            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
            </div>
            <form class="user" action="" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <input type="text" class="form-control form-control-user" name="name" id="name" placeholder="Full name" value="<?php echo set_value('name'); ?>">
                <small class="form-text text-danger"><?php echo form_error('name'); ?></small>
              </div>
              <div class="form-group">
                <input type="email" class="form-control form-control-user" name="email" id="email" placeholder="Email" value="<?php echo set_value('email'); ?>">
                <small class="form-text text-danger"><?php echo form_error('email'); ?></small>
              </div>
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="password" class="form-control form-control-user" name="password1" id="password1" placeholder="Password">
                  <small class="form-text text-danger"><?php echo form_error('password1'); ?></small>
                </div>
                <div class="col-sm-6">
                  <input type="password" class="form-control form-control-user" name="password2" id="password2" placeholder="Retype password">
                  <small class="form-text text-danger"><?php echo form_error('password2'); ?></small>
                </div>
              </div>
              <div class="col-md">
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Register Account</button>
              </div>
            </form>
            <hr>
            <div class="text-center">
              <a href="<?php echo base_url(); ?>auth/forgotpassword" class="small">Forgot Password?</a>
            </div>
            <div class="text-center">
              <a href="<?php echo base_url(); ?>auth" class="text-center small">Already have an account? Login!</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>