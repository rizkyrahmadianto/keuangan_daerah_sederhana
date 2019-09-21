<div class="container">

  <!-- Outer Row -->
  <div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
            <div class="col-lg-6">
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
                  <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                </div>
                <form class="user" action="" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <input type="email" class="form-control form-control-user" name="email" id="email" placeholder="Email" value="<?php echo set_value('email') ?>">
                    <small class="form-text text-danger"><?php echo form_error('email') ?></small>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password">
                    <small class="form-text text-danger"><?php echo form_error('password') ?></small>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox small">
                      <input type="checkbox" class="custom-control-input" name="customCheck" id="customCheck">
                      <label class="custom-control-label" for="customCheck">Remember Me</label>
                    </div>
                  </div>
                  <div class="col-md">
                    <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                  </div>
                </form>
                <hr>
                <div class="text-center">
                  <a href="<?php echo base_url(); ?>auth/forgotpassword" class="small">Forgot Password?</a>
                </div>
                <div class="text-center">
                  <a href="<?php echo base_url() ?>auth/register" class="small">Create an Account!</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

</div>
