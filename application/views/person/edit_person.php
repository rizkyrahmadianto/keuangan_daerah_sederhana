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
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="name">Person Name</label>
          <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $person['person_id'] ?>">
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter person name" value="<?php echo $person['person_name']; ?>">
          <small class="form-text text-danger"><?= form_error('name'); ?></small>
        </div>
        <div class="form-group">
          <label for="menuoption">Region</label>
          <select class="form-control" name="menu_opt" id="menu_opt">
            <option value="">Choose Region</option>

            <?php foreach ($option_region as $or) : ?>
              <?php if ($or['region_id'] == $person['region_id']) : ?>
                <option value="<?php echo $or['region_id'] ?>" selected><?php echo $or['region_name'] ?></option>
              <?php else : ?>
                <option value="<?php echo $or['region_id'] ?>"><?php echo $or['region_name'] ?></option>
              <?php endif; ?>
            <?php endforeach; ?>

          </select>
          <small class="form-text text-danger"><?= form_error('menu_opt'); ?></small>
        </div>
        <div class="form-group">
          <label for="salary">Salary</label>
          <input type="text" class="form-control salary" id="salary" name="salary" placeholder="Enter salary" value="<?php echo "Rp. " . number_format($person['person_income'], 0, ',', '.'); ?>">
          <small class="form-text text-danger"><?= form_error('salary'); ?></small>
        </div>
        <div class="form-group">
          <label for="address">Address</label>
          <textarea class="form-control" name="address" id="address"><?php echo $person['person_address']; ?></textarea>
          <small class="form-text text-danger"><?= form_error('address'); ?></small>
        </div>
        <!-- /.box-body -->

        <a href="<?php echo base_url(); ?>person" class="btn btn-secondary">Back</a>
        <button type="submit" value="save" name="save" class="btn btn-success">Update</button>
      </form>
    </div>
  </div>

</div>
<!-- /.container-fluid -->