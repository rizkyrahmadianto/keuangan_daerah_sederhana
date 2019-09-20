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
      <div class="table-responsive">
        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="submenu">Sub Menu Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter submenu name" value="<?php echo set_value('name'); ?>">
            <small class="form-text text-danger"><?= form_error('name'); ?></small>
          </div>
          <div class="form-group">
            <label for="menuoption">Menu Name</label>
            <select class="form-control" name="menu_opt" id="menu_opt">
              <option value="">Choose Menu</option>

              <?php foreach ($menu as $m) : ?>
                <option value="<?php echo $m['id'] ?>"><?php echo $m['menu'] ?></option>
              <?php endforeach; ?>

            </select>
            <small class="form-text text-danger"><?= form_error('menu_opt'); ?></small>
          </div>
          <div class="form-group">
            <label for="submenurl">Sub Menu Url</label>
            <input type="text" class="form-control" id="url" name="url" placeholder="Enter submenu url" value="<?php echo set_value('url'); ?>">
            <small class="form-text text-danger"><?= form_error('url'); ?></small>
          </div>
          <div class="form-group">
            <label for="submenuicon">Sub Menu Icon</label>
            <input type="text" class="form-control" id="icon" name="icon" placeholder="fas fa-..." value="<?php echo set_value('icon'); ?>">
            <small class="form-text text-danger"><?= form_error('icon'); ?></small>
          </div>
          <div class="form-group form-check">
            <label>
              <input type="checkbox" class="form-check-input" name="active" id="active" value="1" checked>
              Active ?
            </label>
          </div>
          <div class="form-group">
            <label for="level">Level</label>
            <input type="text" class="form-control" id="level" name="level" placeholder="Enter submenu level" value="<?php echo set_value('level'); ?>">
            <small class="form-text text-danger"><?= form_error('level'); ?></small>
          </div>
          <!-- /.box-body -->
          <a href="<?php echo base_url(); ?>menu/submenu" class="btn btn-secondary">Back</a>
          <button type="submit" value="save" name="save" class="btn btn-success pull-right">Save</button>
        </form>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->