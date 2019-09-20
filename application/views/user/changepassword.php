<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800"><?php echo $title; ?></h1>

  <section class="content-header">
    <div class="row">
      <div class="col-lg-6">
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
      </div>
    </div>
  </section>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <!-- form start -->
      <form role="form" action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="oldpass">Current Password</label>
          <input type="password" class="form-control" id="oldpass" name="oldpass" placeholder="Current password">
          <small class="form-text text-danger"><?= form_error('oldpass'); ?></small>
        </div>
        <div class="form-group">
          <label for="newpass">New Password</label>
          <input type="password" class="form-control" id="newpass" name="newpass" placeholder="New password">
          <small class="form-text text-danger"><?= form_error('newpass'); ?></small>
        </div>
        <div class="form-group">
          <label for="repass">Re-type New Password</label>
          <input type="password" class="form-control" id="repass" name="repass" placeholder="Retype new password">
          <small class="form-text text-danger"><?= form_error('repass'); ?></small>
        </div>
        <!-- /.box-body -->
        <a href="<?php echo base_url(); ?>user" class="btn btn-secondary">Back</a>
        <button type="submit" value="save" name="save" class="btn btn-success">Change</button>
      </form>
    </div>
  </div>

</div>
<!-- /.container-fluid -->
