<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800"><?php echo $title; ?></h1>

  <!-- DataTales Example -->
  <div class="card col-lg-6 shadow mb-4">
    <div class="card-body">
      <!-- form start -->
      <form action="" method="post" enctype="multipart/form-data">
        <div class="box-body ">
          <div class="form-group">
            <label for="exampleInputEmail1">Region ID</label>
            <input type="text" class="form-control" id="id" name="id" value="<?php echo $detail['region_id']; ?>" readonly>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Region Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $detail['region_name']; ?>" readonly>
          </div>
        </div>
        <!-- /.box-body -->

        <a href="<?php echo base_url(); ?>region" class="btn btn-secondary">Back</a>
      </form>
    </div>
  </div>

</div>
<!-- /.container-fluid -->