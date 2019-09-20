<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800"><?php echo $title; ?></h1>

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="d-sm-flex mt-4">
      <a href="<?php echo base_url() ?>region/addRegion" class="btn btn-success"><i class="fa fa-plus"></i> Region</a>
    </div>
    <div class="d-sm-flex mt-4">
      <!-- search form -->
      <form action="" method="post">
        <div class="input-group">
          <input type="text" name="search" id="search" class="form-control" placeholder="Search..." autocomplete="off" autofocus>
          <div class="input-group-append">
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
          </div>
        </div>
      </form>
      <!-- /.search form -->
    </div>
  </div>

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
  <div class="card shadow mb-4">
    <div class="card-body" id="result">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Region Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($region) :
              foreach ($region as $r) :
                ?>
                <tr>
                  <td><?php echo ++$start; ?></td>
                  <td><?php echo $r['region_name']; ?></td>
                  <td>
                    <!-- <a href="<?php echo base_url() ?>region/deleteRegion/<?php echo $r['region_id'] ?>" class="btn btn-sm btn-danger button-delete">Delete</a> -->
                    <a href="<?php echo base_url() ?>region/editRegion/<?php echo $r['region_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="<?php echo base_url() ?>region/detailRegion/<?php echo $r['region_id'] ?>" class="btn btn-sm btn-success">Detail</a>
                  </td>
                </tr>
              <?php endforeach;
              else : ?>
              <tr>
                <td colspan="3" align="center">No data record / found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <?php
        echo $pagination;
        ?>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->