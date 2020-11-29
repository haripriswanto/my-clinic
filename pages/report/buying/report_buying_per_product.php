
<link rel="icon" href="<?php echo $base_url ?>assets/images/print.png">
<?php 
  if (isset($_POST['excel'])) {
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Laporan_Penjualan_Per_Produk-".$headerName.".xls");
  }  
  if (!empty($in_date_report) && !empty($out_date_report)) {
     $queryReporView = "SELECT payment.*, detail.*, product.*, payment.date_insert as tanggal
              FROM 
              tb_buying_transaction_detail as detail,
              tb_buying_payment as payment,
              tb_master_product as product              
              WHERE 
              payment.invoice_number_relation = detail.invoice_number_relation
              AND detail.product_code_relation = product.product_code 
              AND payment.bl_state = 'A'
              AND  (payment.ts_insert BETWEEN '$in_date_report $in_time_report' AND '$out_date_report $out_time_report')";

      if (!empty($product_category) AND !empty($product_name)) {
        $queryReporView2 = mysqli_query($config, $queryReporView." AND detail.product_code_relation = '$product_name' ORDER BY detail.invoice_number_relation ASC");
      }elseif (!empty($product_category) AND empty($product_name)) {
        $queryReporView2 = mysqli_query($config, $queryReporView." AND detail.category_code_relation = '$product_category' ORDER BY detail.invoice_number_relation ASC");
      }else{
         $queryReporView2 = mysqli_query($config, $queryReporView." ORDER BY payment.invoice_number_relation ASC");
    } 
  }
?>
<title>Laporan Pembelian Per Produk</title>
<div class="container-fluid " align="center">
  <div class="page-header">
    <h2>Laporan Pembelian Per Produk</h2>
    <h3><?php echo $system_instansi_name ?></h3>
    <font style="text-transform: capitalize;">
      <span class="fa fa-map-marker"></span> <?php echo $system_address ?> <br>
      <span class="fa fa-phone-square"></span> <?php echo $system_phone ?> 
      <span class="fa fa-envelope"></span> <?php echo $system_email ?> 
      <span class="fa fa-globe"></span> <?php echo $system_url ?>
    </font>
  </div>
  <div class="text-left"> 
    Periode : <?php echo $in_date_report ." s/d ". $out_date_report ?><br><br>
  </div> 

  <table class="table table-hover table-bordered report" border="1">
    <thead>
      <tr>
        <th width="8px">#</th>
        <th width="250px">Tgl Transaksi</th>
        <th width="250px">Kode Produk</th>
        <th>Nama Produk</th>
        <th>Kategori</th>
        <th>Jumlah</th>
      </tr>
    </thead>
      <?php 

          $number = 0;
          $quantity = 0;
          $total_all = 0;
          // $test = str_replace("\n", '<BR />', $queryReporView2);
          while ($row = mysqli_fetch_array($queryReporView2)){
            $number                 = $number + 1 ;
            $product_code_relation  = $row['product_code_relation'];
            $product_name           = $row['product_name'];
            $product_qty            = $row['product_qty'];
            $category_description   = $row['category_description'];
            $ts_insert              = $row['ts_insert'];


        ?>
        <tr>
          <td><?php echo $number ?></td>
          <td><?php echo $ts_insert ?></td>
          <td><?php echo $product_code_relation ?></td>
          <td><?php echo $product_name ?></td>
          <td><?php echo $category_description ?></td>
          <td><?php echo number_format($product_qty); ?></td>
        </tr> 
        <?php 
          $quantity = $quantity + $product_qty ; 
        } 
      ?>
        <tr>
          <td colspan="5" class="text-right">Total: </td>
          <td><?php echo number_format($quantity); ?></td>
        </tr>
  </table>
</div>