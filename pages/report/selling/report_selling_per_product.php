
<?php 
  // if (isset($_POST['excel'])) {
  //   header("Content-type: application/vnd-ms-excel");
  //   header("Content-Disposition: attachment; filename=Laporan-penjualan-per-produk-".$headerName.".xls");
  // }  


  if (!empty($in_date_report) && !empty($out_date_report)) {
    $queryReportView2 = '';
    $queryReportView = "SELECT payment.*, detail.*, product.*, payment.date_insert as tanggal, payment.time_insert as waktu, payment.user_code_relation as user_name
        FROM 
          tb_selling_transaction_detail as detail,
          tb_selling_payment as payment,
          tb_master_product as product              
        WHERE 
        payment.invoice_number_relation = detail.invoice_number_relation
        AND detail.product_code_relation = product.product_code 
        AND payment.bl_state <> 'D'
        AND detail.bl_state <> 'D'
        AND product.bl_state <> 'D'
        AND product.outlet_code_relation = '$system_outlet_code'
        AND (payment.ts_insert BETWEEN '$in_date_report $in_time_report' AND '$out_date_report $out_time_report')";

        // var_dump($queryReportView);exit;

        if (!empty($product_category)) {
            $queryReportView1 = $queryReportView." AND detail.category_code_relation = '$product_category' ORDER BY detail.invoice_number_relation ASC";
        } elseif (!empty($product_name)) {
            $queryReportView1 = $queryReportView." AND detail.product_code_relation = '$product_name' ORDER BY detail.invoice_number_relation ASC";
        } elseif (!empty($casier_name)) {
            $queryReportView1 = $queryReportView." AND payment.user_code_relation = '$casier_name' ORDER BY detail.invoice_number_relation ASC";
        } elseif (!empty($product_category) AND !empty($casier_name)) {
            $queryReportView1 = $queryReportView." AND detail.category_code_relation = '$product_category' AND payment.user_code_relation = '$casier_name' ORDER BY detail.invoice_number_relation ASC";
        } 
        else {
            $queryReportView1 = $queryReportView." ORDER BY detail.invoice_number_relation ASC";          
        }
        // var_dump($queryReportView1);exit;
        $queryReportView2 = mysqli_query($config, $queryReportView1);
  }
?>

  <table class="table table-hover table-bordered report" border="1">
    <thead>
      <tr>
        <th width="8px">#</th>
        <th width="250px">Tgl Transaksi</th>
        <!-- <th width="250px">No. Transaksi</th> -->
        <th width="250px">Kode Produk</th>
        <th>Nama Produk</th>
        <th>Kategori</th>
        <th>Jumlah</th>
        <th>User</th>
      </tr>
    </thead>
      <?php 

          $number = 0;
          $total_qty = 0;
          $total_all = 0;
          // $test = str_replace("\n", '<BR />', $queryReportView2);
          while ($row = mysqli_fetch_array($queryReportView2)){
            $number                 = $number + 1 ;
            $product_code_relation  = $row['product_code_relation'];
            $invoice_number_relation= $row['invoice_number_relation'];
            $product_name           = $row['product_name'];
            $product_qty            = $row['product_qty'];
            $category_description   = $row['category_description'];
            $user_code_relation     = $row['user_name'];
            $tgl_insert             = $row['tanggal'];
            $wkt_insert             = $row['waktu'];


        ?>
        <tr>
          <td><?php echo $number ?></td>
          <td><?php echo $tgl_insert." ".$wkt_insert; ?></td>
          <!-- <td><?php echo $invoice_number_relation ?></td> -->
          <td><?php echo $product_code_relation ?></td>
          <td><?php echo $product_name ?></td>
          <td><?php echo $category_description ?></td>
          <td><?php echo number_format($product_qty); ?></td>
          <td><?php echo $user_code_relation; ?></td>
        </tr> 
        <?php 
          $total_qty = $total_qty + $product_qty ; 
        } 
      ?>
        <tr>
          <td colspan="5" class="text-right">Total: </td>
          <td colspan="2"><?php echo number_format($total_qty); ?></td>
        </tr>
  </table>
</div>

<script type="text/javascript">
  $('title').html('Laporan Penjualan Per Produk');
  $('.headerReport').html('Laporan Penjualan Per Produk');
  $('.headerPeriode').html('<?php echo date('d-m-Y',strtotime($in_date_report)) ." s/d ". date('d-m-Y', strtotime($out_date_report));?>');
  $('.headerAdmin').html('<?php if(!empty($casier_name)) echo" Admin: ".$casier_name ?>');
</script>