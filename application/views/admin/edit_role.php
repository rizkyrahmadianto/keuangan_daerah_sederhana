<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800"><?php echo $title; ?></h1>

  <section class="content-header">
    <div class="row">
      <div class="col-lg-12">
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
  <div class="card shadow mb-4 col-md-6">
    <div class="card-body">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="">Role Name</label>
          <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $detail['id']; ?>">
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter role name" value="<?php echo $detail['role']; ?>">
          <small class="form-text text-danger"><?= form_error('name'); ?></small>
        </div>
        <a href="<?php echo base_url(); ?>admin/role" class="btn btn-secondary">Back</a>
        <button type="submit" class="btn btn-success pull-right">Update</button>
      </form>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

