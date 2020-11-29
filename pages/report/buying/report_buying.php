
<link rel="icon" href="<?php echo $base_url ?>assets/images/print.png">
<?php 
  if (isset($_POST['excel'])) {
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Laporan-Pembemlian-".$headerName.".xls");
  }
  if (!empty($in_date_report) && !empty($out_date_report)) {
    $queryReporView =  "SELECT payment.*, transaction.* 
      FROM tb_buying_payment as payment
      INNER JOIN tb_buying_transaction as transaction
      ON payment.invoice_number_relation = transaction.invoice_number
      WHERE payment.bl_state = 'A' 
      AND  (payment.date_insert >= '$in_date_report' AND payment.time_insert >= '$in_time_report' AND payment.date_insert <= '$out_date_report' AND payment.time_insert <= '$out_time_report')";

    if (!empty($payment_type) AND empty($casier_name)){
      	$queryReporView2 = mysqli_query($config, $queryReporView."AND payment.type_of_payment = '$payment_type' ORDER BY payment.invoice_number_relation ASC ");
    }
    elseif (empty($payment_type) AND !empty($casier_name)) {
      $queryReporView2 = mysqli_query($config, $queryReporView."AND payment.user_code_relation = '$casier_name' ORDER BY payment.invoice_number_relation ASC");      
    }
    elseif (!empty($payment_type) AND !empty($casier_name)) {
      $queryReporView2 = mysqli_query($config, $queryReporView."AND payment.type_of_payment = '$payment_type' AND payment.user_code_relation = '$casier_name' ORDER BY payment.invoice_number_relation ASC");      
    }
    elseif (empty($payment_type) OR empty($casier_name)) {
			 $queryReporView2 = mysqli_query($config, $queryReporView." ORDER BY payment.invoice_number_relation ASC");
		}
    // var_dump($queryReporView);exit();
   }
?>  
<title>Laporan Pembelian</title>
<div class="container-fluid" align="center">
  <div class="page-header">
    <h2>Laporan Pembelian</h2>
    <h3><?php echo $system_instansi_name ?></h3>
    <font style="text-transform: lowercase;">
      <span class="fa fa-map-marker"></span> <?php echo $system_address ?> <br>
      <span class="fa fa-phone-square"></span> <?php echo $system_phone ?> 
      <span class="fa fa-envelope"></span> <?php echo $system_email ?> 
      <span class="fa fa-globe"></span> <?php echo $system_url ?>
    </font>
  </div>
  <div class="pull-left"> 
    Periode : <?php echo $in_date_report ." s/d ". $out_date_report ?><br><br>
  </div>

  <table class="table table-hover table-bordered report" border="1">
    <thead>
      <tr>
        <th width="8px">#</th>
        <th>No. Transaksi.</th>
        <th>Tgl Transaksi</th>
        <th>Cara Bayar</th>
        <th>Qty</th>
        <th>Total</th>
        <th>Kasir</th>
      </tr>
    </thead>
      <?php 

          $number = 0;
          $quantity = 0;
          $total_all = 0;
          // $test = str_replace("\n", '<BR />', $queryReporView2);
          while ($row = mysqli_fetch_array($queryReporView2)){
            $number                 = $number + 1 ;
            $invoice_number_relation  = $row['invoice_number_relation'];
            $date_insert            = $row['date_insert'];
            $time_insert            = $row['time_insert'];
            $qty                    = $row['total_item'];
            $nominal_cash           = $row['nominal_cash'];
            $total_paid             = $row['total_paid'];
            $type_of_payment        = $row['type_of_payment'];
            $note                   = $row['note'];
            $user_code_relation     = $row['user_code_relation'];

            if ($type_of_payment == 1) {
              $payment_type = 'Tunai';
            }
            elseif ($type_of_payment == 2) {
              $payment_type = 'Debit';
            }
            elseif ($type_of_payment == 3) {
              $payment_type = 'Kredit';
            }
            elseif ($type_of_payment == 4) {
              $payment_type = 'Kombinasi';
            }

        ?>
          <tr>
            <td><?php echo $number ?></td>
            <td><?php echo $invoice_number_relation ?></td>
            <td><?php echo $date_insert." ".$time_insert ?></td>
            <td><?php echo $type_of_payment ?></td>
            <td><?php echo $qty ?></td>
             <td>Rp. <?php echo number_format($total_paid) ?></td>
            <td><?php echo $user_code_relation ?></td>
          </tr> 
          <?php 
            $quantity = $quantity + $qty ; 
            $total_all = $total_all + $total_paid;
          } 
        ?>
        <tr>
          <td colspan="4" align="right">Total: </td>
          <td><?php echo $quantity; ?></td>
          <td>Rp. <?php echo number_format($total_all); ?></td>
          <td></td>
        </tr>
  </table>
</div>