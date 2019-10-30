<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Report Admin</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <style>
    .line-title {
      border: 0;
      border-style: inset;
      border-top: 1px solid #000;
    }
  </style>
</head>

<body>
  <img src="assets/img/marketing.png" style="position:absolute; width:60px; height:auto;">
  <table style="width: 100%;">
    <tr>
      <td align="center">
        <span style="line-height: 1.6; font-weight: bold;">
          KEUANGAN DAERAH
          <br>INDONESIA
        </span>
      </td>
    </tr>
  </table>
  <hr class="line-title">

  <p align="center">
    LAPORAN DATA KEUANGAN
  </p>

  <div class="table-responsive">
    <table class="table table-bordered">
      <tr>
        <th>No</th>
        <th>Nama Daerah</th>
        <th>Jumlah Penduduk</th>
        <th>Total Pendapatan</th>
        <th>Rata-Rata Pendapatan</th>
        <th>Status</th>
      </tr>
      <?php
      $no = 1;
      foreach ($data as $row) :
        ?>
        <tr>
          <td><?php echo $no++; ?></td>
          <td><?php echo $row['region_name']; ?></td>
          <td><?php echo $row['jumlah']; ?></td>
          <td><?php echo "Rp. " . number_format($row['total'], 0, ',', '.'); ?></td>
          <td><?php echo "Rp. " . number_format($row['rata_rata'], 0, ',', '.'); ?></td>
          <td>
            <?php
              if ($row['rata_rata'] > 2200000) {
                echo '<span>Great</span>';
              } else if (($row['rata_rata'] > 1700000) && ($row['rata_rata'] < 2200000)) {
                echo '<span>Warning</span>';
              } else {
                echo '<span>Danger</span>';
              }
              ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</body>

</html>
