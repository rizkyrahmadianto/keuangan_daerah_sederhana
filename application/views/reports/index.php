<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800"><?php echo $title; ?></h1>

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="d-sm-flex mt-4">
      <a href="<?php echo base_url() ?>report/printReport" class="btn btn-secondary"><i class="fas fa-print"></i> Print</a>
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


  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Daerah</th>
              <th>Jumlah Penduduk</th>
              <th>Total Pendapatan</th>
              <th>Rata-Rata Pendapatan</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($data) :
              foreach ($data as $d) :
                ?>
                <tr>
                  <td><?php echo ++$start; ?></td>
                  <td><?php echo $d['region_name']; ?></td>
                  <td><?php echo $d['jumlah']; ?></td>
                  <td><?php echo "Rp. " . number_format($d['total'], 0, ',', '.'); ?></td>
                  <td><?php echo "Rp. " . number_format($d['rata_rata'], 0, ',', '.'); ?></td>
                  <td>
                    <?php
                        if ($d['rata_rata'] > 2200000) {
                          echo '<span class="badge badge-success">Great</span>';
                        } else if (($d['rata_rata'] > 1700000) && ($d['rata_rata'] < 2200000)) {
                          echo '<span class="badge badge-warning">Warning</span>';
                        } else {
                          echo '<span class="badge badge-danger">Danger</span>';
                        }
                        ?>
                  </td>
                </tr>
              <?php
                endforeach;
              else :
                ?>
              <tr>
                <td colspan="6" align="center">No data record / found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
      <div class="row">
        <div class="col-md-12">
          <?php echo $pagination; ?>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->
