<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800"><?php echo $title; ?></h1>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <!-- form start -->
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="name">Person Name</label>
          <input type="text" class="form-control" id="name" name="name" value="<?php echo $detail['person_name']; ?>" readonly>
        </div>
        <div class="form-group">
          <label for="menuoption">Region</label>
          <?php foreach ($option_region as $or) : ?>
            <?php if ($or['region_id'] == $detail['region_id']) : ?>
              <input type="text" name="region" id="region" class="form-control" value="<?php echo $or['region_name']; ?>" readonly>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
        <div class="form-group">
          <label for="salary">Salary</label>
          <input type="text" class="form-control salary" id="salary" name="salary" placeholder="Enter salary" value="<?php echo "Rp. " . number_format($detail['person_income'], 0, ',', '.'); ?>" readonly>
        </div>
        <div class="form-group">
          <label for="address">Address</label>
          <textarea class="form-control" name="address" id="address" readonly><?php echo $detail['person_address']; ?></textarea>
          <small class="form-text text-danger"><?= form_error('address'); ?></small>
        </div>
        <!-- /.box-body -->

        <a href="<?php echo base_url(); ?>person" class="btn btn-secondary">Back</a>
      </form>
    </div>
  </div>

</div>
<!-- /.container-fluid -->