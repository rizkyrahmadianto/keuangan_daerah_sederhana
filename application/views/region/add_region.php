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
  <div class="card col-lg-6 shadow mb-4">
    <div class="card-body">
      <!-- form start -->
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="exampleInputEmail1">Region Name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter region name" value="<?php echo set_value('name'); ?>">
          <small class="form-text text-danger"><?= form_error('name'); ?></small>
        </div>
        <!-- /.box-body -->

        <a href="<?php echo base_url(); ?>region" class="btn btn-secondary">Back</a>
        <button type="submit" value="save" name="save" class="btn btn-success">Save</button>
      </form>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

