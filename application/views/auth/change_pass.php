<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
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
                    <h1 class="h4 text-gray-900 mb-2">Change <?php echo $this->session->userdata('reset_email'); ?> Password?</h1>
                    <p class="mb-4">We get it, stuff happens. Just enter your new password and don't for get to re-type it !</p>
                  </div>
                  <form class="user" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="pass" id="pass" placeholder="New password">
                      <small class="form-text text-danger"><?php echo form_error('pass'); ?></small>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="repeat_pass" id="repeat_pass" placeholder="Retype password">
                      <small class="form-text text-danger"><?php echo form_error('repeat_pass'); ?></small>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Change
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>