<?php 
  include("../../../config/config.php");

  if ($sessionAccess == 2) {
    $access = " AND user_name = '$sessionUser' ";
  } else{ 
    $access = '';
  }

if (mysqli_escape_string($config, $_GET['tglAwal']) == '' AND mysqli_escape_string($config, $_GET['tglAkhir']) == '' AND mysqli_escape_string($config, $_GET['casier_name']) == '') {
  $date_in_stock   = mysqli_escape_string($config, $currentDate);
  $date_out_stock  = mysqli_escape_string($config, $currentDate);

  $filterDate = "log_date >= '$currentDate 00:00:00' AND log_date <= '$currentDate 23:23:59' ";
  $pesan = "Berhasil Menampilkan Data Hari Ini";
}elseif (mysqli_escape_string($config, $_GET['tglAwal']) != '' AND mysqli_escape_string($config, $_GET['tglAkhir']) != '' AND mysqli_escape_string($config, $_GET['casier_name']) == '' ) {
  $date_in_stock   = mysqli_escape_string($config, $_GET['tglAwal']);
  $date_out_stock  = mysqli_escape_string($config, $_GET['tglAkhir']);

  $filterDate = "log_date >= '$date_in_stock 00:00:00' AND log_date <= '$date_out_stock 23:23:59'";
  $pesan = "Berhasil Menampilkan Data Dari tgl ". $date_in_stock ." S/D ". $date_out_stock;
}elseif (mysqli_escape_string($config, $_GET['tglAwal']) != '' AND mysqli_escape_string($config, $_GET['tglAkhir']) != '' AND mysqli_escape_string($config, $_GET['casier_name']) != '' ) {
  $date_in_stock   = mysqli_escape_string($config, $_GET['tglAwal']);
  $date_out_stock  = mysqli_escape_string($config, $_GET['tglAkhir']);
  $casier_name     = mysqli_escape_string($config, $_GET['casier_name']);

  $filterDate = "log_date >= '$date_in_stock 00:00:00' AND log_date <= '$date_out_stock 23:23:59' AND user_name = '$casier_name' ";
  $pesan = "Berhasil Menampilkan Data Dari tgl ". $date_in_stock ." S/D ". $date_out_stock;
}elseif (mysqli_escape_string($config, $_GET['tglAwal']) == '' AND mysqli_escape_string($config, $_GET['tglAkhir']) == '' AND mysqli_escape_string($config, $_GET['casier_name']) != '' ) {
  $date_in_stock   = mysqli_escape_string($config, $currentDate);
  $date_out_stock  = mysqli_escape_string($config, $currentDate);
  $casier_name     = mysqli_escape_string($config, $_GET['casier_name']);


  $filterDate = "log_date >= '$currentDate 00:00:00' AND log_date <= '$currentDate 23:23:59' AND user_name = '$casier_name'  ";
  $pesan = "Berhasil Menampilkan Data Hari Ini";
}

if (isset($_GET['buttonExcel'])) {
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Laporan-Aktifitas-".$headerName.".xls");
?>
  <script>
    toastr['success']('Berhasil Download/Konversi Data Excel');
  </script>
  <div class="container-fluid" align="center">
    <div class="page-header">
      <h2>Laporan Log Aktifitas</h2>
      <h3><?php echo $system_instansi_name ?></h3>
      <font style="text-transform: lowercase;">
        <span class="fa fa-map-marker"></span> <?php echo $system_address ?> <br>
        <span class="fa fa-phone-square"></span> <?php echo $system_phone ?> 
        <span class="fa fa-envelope"></span> <?php echo $system_email ?> 
        <span class="fa fa-globe"></span> <?php echo $system_url ?>
      </font>
    </div>
    <div class="pull-left"> 
      Periode : <?php echo $date_in_stock ." s/d ". $date_out_stock ?><br><br>
    </div>
  <div class="panel-body">
    <div class="table-responsive">
        <table border="1">
<?php } else{?>
  <div class="panel-body">
    <div class="table-responsive">
        <table class="table table-hover table-striped" id="dataTables">
<?php } ?>
            <thead>
              <tr>
                <th>#</th>
                <th>Tgl Transaksi</th>
                <th>Menu</th>
                <th>Deskripsi</th>
                <th>User</th>
                <th>IP</th>
              </tr>
            </thead>
              <?php 
              $querySelectDataLog = mysqli_query($config, "SELECT * FROM log_activity WHERE $filterDate"."$access ORDER BY log_date DESC");

                  $number = 0;
                  while ($rowDataLog = mysqli_fetch_array($querySelectDataLog)){
                    $number           = $number + 1 ;
                    $log_date         = $rowDataLog['log_date'];
                    $log_menu         = $rowDataLog['log_menu'];
                    $log_description  = $rowDataLog['log_description'];
                    $log_status       = $rowDataLog['log_status'];
                    $ip_address   		= $rowDataLog['ip_address'];
                    $user_name        = $rowDataLog['user_name'];
                    $log_os           = $rowDataLog['log_os'];
                    $log_browser      = $rowDataLog['log_browser'];

                ?>
                <tr>
                  <td><?php echo $number ?></td>
                  <td><?php echo $log_date ?></td>
                  <td><?php echo $log_menu ?></td>
                  <td><?php echo $log_description ?></td>
                  <td><?php echo $user_name; ?></td>
                  <td><?php echo $ip_address; ?></td>
                </tr>
            <?php } ?>
          </table>
        </div>
    </div>
<script>
    toastr['success']('<?php echo $pesan ?>');

//************** DATATABLES **************//
    $(document).ready(function() {
        $('#dataTables').DataTable({
                responsive: true
        });
    });
</script>