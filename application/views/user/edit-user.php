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
  <div class="card col-md-8 shadow mb-4">
    <div class="card-body">
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="url">User Email</label>
            <input type="hidden" name="id" id="id" class="form-control">
            <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" value="<?php echo $user['email'] ?>" readonly>
            <small class="form-text text-danger"><?= form_error('email'); ?></small>
          </div>
          <div class="form-group">
            <label for="submenu">User Full Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" value="<?php echo $user['name'] ?>">
            <small class="form-text text-danger"><?= form_error('name'); ?></small>
          </div>
          <div class="form-group row">
            <div class="col-sm-2">Picture</div>
            <div class="col-sm-10">
              <div class="row">
                <div class="col-sm-3">
                  <img src="<?php echo base_url() ?>assets/img/profile/<?= $user['image']; ?>" class="img-thumbnail">
                </div>
                <div class="col-sm-9">
                  <div class="form-group">
                    <label for="image">Choose File</label>
                    <input type="file" class="form-control-file" name="image" id="image">
                    <input type="hidden" name="old_image" id="old_image" value="<?php echo $user['image'] ?>">
                    <small class="form-text text-danger"><?= form_error('image'); ?></small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a href="<?php echo base_url() ?>user" class="btn btn-secondary">Back</a>
          <button type="submit" value="Update" name="update" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>

</div>
<!-- /.container-fluid -->