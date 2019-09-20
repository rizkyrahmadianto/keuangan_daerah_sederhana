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
            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $submenu['id']; ?>">
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter submenu name" value="<?php echo $submenu['title']; ?>">
            <small class="form-text text-danger"><?= form_error('name'); ?></small>
          </div>
          <div class="form-group">
            <label for="menuoption">Menu Name</label>
            <select class="form-control" name="menu_opt" id="menu_opt">
              <option value="">Choose Menu</option>

              <?php foreach ($menu as $m) : ?>
                <?php if ($m['id'] == $submenu['menu_id']) : ?>
                  <option value="<?php echo $m['id'] ?>" selected><?php echo $m['menu'] ?></option>
                <?php else : ?>
                  <option value="<?php echo $m['id'] ?>"><?php echo $m['menu'] ?></option>
                <?php endif; ?>
              <?php endforeach; ?>

            </select>
            <small class="form-text text-danger"><?= form_error('menu_opt'); ?></small>
          </div>
          <div class="form-group">
            <label for="submenurl">Sub Menu Url</label>
            <input type="text" class="form-control" id="url" name="url" placeholder="Enter submenu url" value="<?php echo $submenu['url']; ?>">
            <small class="form-text text-danger"><?= form_error('url'); ?></small>
          </div>
          <div class="form-group">
            <label for="submenuicon">Sub Menu Icon</label>
            <input type="text" class="form-control" id="icon" name="icon" placeholder="fas fa-..." value="<?php echo $submenu['icon']; ?>">
            <small class="form-text text-danger"><?= form_error('icon'); ?></small>
          </div>
          <div class="form-group form-check">
            <label>
              <?php if ($submenu['is_active'] == 1) : ?>
                <input type="checkbox" class="form-check-input" name="active" id="active" value="<?php echo $submenu['is_active'] ?>" checked>
                Active ?
              <?php else : ?>
                <input type="checkbox" class="form-check-input" name="active" id="active" value="<?php echo $submenu['is_active'] ?>">
                Active ?
              <?php endif; ?>
            </label>
          </div>
          <div class="form-group">
            <label for="level">Level</label>
            <input type="text" class="form-control" id="level" name="level" placeholder="Enter level submenu" value="<?php echo $submenu['level']; ?>">
            <small class="form-text text-danger"><?= form_error('level'); ?></small>
          </div>
          <!-- /.box-body -->
          <a href="<?php echo base_url(); ?>menu/submenu" class="btn btn-secondary">Back</a>
          <button type="submit" value="save" name="save" class="btn btn-success pull-right">Update</button>
        </form>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->