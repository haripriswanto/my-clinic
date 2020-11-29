<?php 
  include("../../../config/config.php");

if (mysqli_escape_string($config, $_GET['tglAwal']) == '' AND mysqli_escape_string($config, $_GET['tglAkhir']) == '' AND mysqli_escape_string($config, $_GET['transactionType']) == '') {
  $date_in_stock   = mysqli_escape_string($config, $currentDate);
  $date_out_stock  = mysqli_escape_string($config, $currentDate);
  // $transactionType  = mysqli_escape_string($config, $_GET['transactionType']);
  $filter = "date_insert >= '$date_in_stock' AND time_insert >= '00:00:00' AND date_insert <= '$date_out_stock' AND time_insert <= '23:23:59'";
}elseif (mysqli_escape_string($config, $_GET['tglAwal']) == '' AND mysqli_escape_string($config, $_GET['tglAkhir']) == '' AND mysqli_escape_string($config, $_GET['transactionType']) != '') {
  $date_in_stock   = mysqli_escape_string($config, $currentDate);
  $date_out_stock  = mysqli_escape_string($config, $currentDate);
  $transactionType  = mysqli_escape_string($config, $_GET['transactionType']);
  $filter = "date_insert >= '$date_in_stock' AND time_insert >= '00:00:00' AND date_insert <= '$date_out_stock' AND time_insert <= '23:23:59' AND transaction_code = '$transactionType' ";
}elseif (mysqli_escape_string($config, $_GET['tglAwal']) != '' AND mysqli_escape_string($config, $_GET['tglAkhir']) != '' AND mysqli_escape_string($config, $_GET['transactionType']) == '') {
  $date_in_stock   = mysqli_escape_string($config, $_GET['tglAwal']);
  $date_out_stock  = mysqli_escape_string($config, $_GET['tglAkhir']);
  $filter = "date_insert >= '$date_in_stock' AND time_insert >= '00:00:00' AND date_insert <= '$date_out_stock' AND time_insert <= '23:23:59'";
}elseif (mysqli_escape_string($config, $_GET['tglAwal']) != '' AND mysqli_escape_string($config, $_GET['tglAkhir']) != '' AND mysqli_escape_string($config, $_GET['transactionType']) != '') {
  $date_in_stock   = mysqli_escape_string($config, $_GET['tglAwal']);
  $date_out_stock  = mysqli_escape_string($config, $_GET['tglAkhir']);
  $transactionType  = mysqli_escape_string($config, $_GET['transactionType']);
  $filter = "date_insert >= '$date_in_stock' AND time_insert >= '00:00:00' AND date_insert <= '$date_out_stock' AND time_insert <= '23:23:59' AND transaction_code = '$transactionType' ";
}

// var_dump($date_in_stock, $date_out_stock, $transactionType);exit;

if (isset($_GET['buttonExcel'])) {
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Laporan-Stok-".$headerName.".xls");

?>
  <div class="container-fluid" align="center">
    <div class="page-header">
      <h2>Laporan Stok</h2>
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
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>Sisa Stok</th>
                <th>Keterangan</th>
                <th>User</th>
              </tr>
            </thead>
              <?php 
              
                // echo "<legend><h4>Periode: <b>". $date_in_stock ."</b> "." - "." <b>". $date_out_stock ."</b></h4></legend>";
                $query = mysqli_query($config, "SELECT * FROM tb_stock_history 
                                        WHERE $filter 
                                        AND outlet_code_relation = '$system_outlet_code'
                                        ORDER BY ts_insert ASC");

                  $number = 0;
                  $totalStockEntry = 0;
                  $totalStock_out = 0;
                  $totalRemaining_stock = 0;
                  while ($row = mysqli_fetch_array($query)){
                    $number                   = $number + 1 ;
                    $product_code_relation    = $row['product_code_relation'];
                    $product_name_relation    = $row['product_name'];
                    $stock_entry              = $row['stock_entry'];
                    $stock_out         		    = $row['stock_out'];
                    $remaining_stock   		    = $row['remaining_stock'];
                    $transaction_code         = $row['transaction_code'];
                    $ts_insert                = $row['ts_insert'];
                    $note                     = $row['note'];
                    $user_info                = $row['user_name'];

                    $totalStockEntry          = $totalStockEntry + $stock_entry;
                    $totalStock_out           = $totalStock_out + $stock_out;
                    $totalRemaining_stock     = $totalRemaining_stock + $remaining_stock;

                ?>
                <tr>
                  <td><?php echo $number ?></td>
                  <td><?php echo $ts_insert ?></td>
                  <td><?php echo mysqli_escape_string($config, $product_code_relation) ?></td>
                  <td><?php echo $product_name_relation ?></td>
                  <td><?php echo $stock_entry ; ?></td>
                  <td><?php echo $stock_out ?></td>
                  <td><?php echo $remaining_stock ?></td>
                  <td><?php echo $note ?></td>
                  <td><?php echo $user_info ?></td>
                </tr>
            <?php
              }
if (isset($_GET['buttonExcel'])) {
  ?>
                <tr>
                  <th colspan="4" align='right'>Total: </th>
                  <th><?php echo number_format($totalStockEntry); ?></th>
                  <th><?php echo number_format($totalStock_out) ?></th>
                  <th><?php echo number_format($totalRemaining_stock) ?></th>
                  <th colspan="2"></th>
                </tr>
<?php 
}
?>
          </table>
        </div>
    </div>
<script>
//************** DATATABLES **************//
    $(document).ready(function() {
        $('#dataTables').DataTable({
                responsive: true
        });
    });
</script>