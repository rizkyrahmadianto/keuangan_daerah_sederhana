<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">My Profile</h1>

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

  <div class="card shadow mb-3" style="max-width: 540px;">
    <div class="row no-gutters">
      <div class="col-md-4">
        <img src="<?php echo base_url() ?>assets/img/profile/<?php echo $user['image'] ?>" class="card-img">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title"><?php echo $user['name'] ?></h5>
          <p class="card-text"><?php echo $user['email'] ?></p>
          <p class="card-text"><small class="text-muted">Join since <?php echo date('d F Y', $user['created_at']) ?></small></p>
          <a href="<?php echo base_url() ?>user/edit/<?php echo $user['id']; ?>" class="badge badge-secondary float-right">Edit User</a>
          <a href="<?php echo base_url(); ?>user/changepassword" class="badge badge-warning float-right"><b>Edit Password</b></a>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->
