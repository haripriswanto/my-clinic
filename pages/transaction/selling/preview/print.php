
<?php 
  include('../../../../config/config.php');

  if (!empty($_SESSION['login'])) {
    
    $invoice_number = $_GET['invoice_number'];
    $selectDetailHeader = " SELECT * FROM tb_selling_transaction 
      WHERE outlet_code_relation = '$system_outlet_code' AND  invoice_number = '$invoice_number' ";

    $querySelectDetailHeader =  mysqli_query($config, $selectDetailHeader);
    while ($rowSelectHeader = mysqli_fetch_array($querySelectDetailHeader)){

    $invoice_number_hdr       = $rowSelectHeader['invoice_number'];
    $customer_code_hdr        = $rowSelectHeader['customer_code_relation'];
    $customer_description_hdr = $rowSelectHeader['customer_description'];
    $dokter_code_hdr          = $rowSelectHeader['dokter_code_relation'];
    $dokter_description_hdr   = $rowSelectHeader['dokter_description'];
    $total_item_hdr           = $rowSelectHeader['total_item'];
    $queue_number_hdr         = $rowSelectHeader['queue_number'];
    $date_insert_hdr          = $rowSelectHeader['date_insert'];
    $time_insert_hdr          = $rowSelectHeader['time_insert'];
    $ts_insert_hdr            = $rowSelectHeader['ts_insert'];
    $ts_update_hdr            = $rowSelectHeader['ts_update'];
    $user_name_hdr            = $rowSelectHeader['user_code_relation'];
   }
?>
<link rel="icon" href="<?php echo $base_url ?>assets/images/print.png">
<title>Struk Penjualan | <?php echo $invoice_number_hdr ?></title>

<table class="struck-58" border="0" align="center">
  <tr>
    <td colspan="5" align="center">
      <h2 class="page-header"><?php echo $system_instansi_name; ?></h2>
      <font style="text-transform: capitalize; font-size:10px;">
        <?php if($system_address != ''&& $system_address != '-') {echo "<span class='fa fa-map-marker'></span> ".$system_address;} else {echo "";} ?><br>
        <?php if($system_phone != ''&& $system_phone != '-') {echo "<span class='fa fa-phone-square'></span> ".$system_phone;} ?>
        <?php if($system_email != ''&& $system_email != '-') {echo "<span class='fa fa-envelope'></span> ".$system_email;} ?>
        <?php if($system_url != ''&& $system_url != '-') {echo "<span class='fa fa-globe'></span> ".$system_url;} ?>
      </font>
    </td>
  </tr>
    <tr><td colspan="5"><hr id="struckBorder"></td></tr>
    <tr>
      <td colspan="5" align="center">
        <b>#<?php echo $queue_number_hdr ?></b>
      </td>
  </tr>
  <tr><td colspan="5"><hr id="struckBorder"></td></tr>
  <tr><td colspan="5">No : <?php echo $invoice_number_hdr ?></td></tr>
  <tr><td colspan="5">Tgl : <?php echo $date_insert_hdr." ".$time_insert_hdr ?></td></tr>
  <tr><td colspan="5">Kasir : <?php echo $user_name_hdr." | Cst : ".$customer_description_hdr; ?></td></tr>
  <tr><td colspan="5"><hr id="struckBorder"></td></tr>
   <?php 
  
  $query =  mysqli_query($config, "
    SELECT tb_selling_transaction.*, tb_selling_transaction_detail.*, tb_selling_payment.*, tb_selling_transaction.total_item AS total_item_, tb_selling_transaction.note AS catatan
    FROM tb_selling_transaction
    INNER JOIN tb_selling_transaction_detail ON tb_selling_transaction.invoice_number =  tb_selling_transaction_detail.invoice_number_relation AND tb_selling_transaction_detail.invoice_number_relation = '$invoice_number'
    INNER JOIN tb_selling_payment ON tb_selling_transaction.invoice_number = tb_selling_payment.invoice_number_relation 
    WHERE tb_selling_transaction.outlet_code_relation = '$system_outlet_code' "
    );
      $total_item_= 0;
      while ($row_loop = mysqli_fetch_array($query)){
       $product_description = $row_loop['product_description'];
       $product_qty         = $row_loop['product_qty'];
       $selling_price       = $row_loop['selling_price'];
       $money_paid          = $row_loop['money_paid'];
       $refund              = $row_loop['refund'];
       $total_item_         = $row_loop['total_item'];
       $total_paid          = $row_loop['total_paid'];
       $type_of_payment     = $row_loop['type_of_payment'];
       $total_cash          = $row_loop['total_cash'];
       $total_debit         = $row_loop['total_debit'];
       $total_credit        = $row_loop['total_credit'];

       $subtotal            = $selling_price * $product_qty;

       if ($type_of_payment=='Tunai') {
          $totalBayar = $total_cash;
       }
       elseif ($type_of_payment=='Debit') {
          $totalBayar = $total_debit;
       }
       elseif ($type_of_payment=='Kredit') {
          $totalBayar = $total_credit;
       }


  ?>
  <tr>
    <td colspan="5"><?php echo $product_description;?></td>    
  </tr>
  <tr class="qty">
    <td colspan="2"><?php echo number_format($selling_price) ." x ". $product_qty;?></td>
    <td colspan="3" align="right">Rp. <?php echo number_format($subtotal);?></td>
  </tr>
  <?php
    }
  ?>
  <tr>
    <td colspan="5"><hr id="struckBorder"></td>
  </tr>
  <tr>
    <td align="right" colspan="3">Item : </td>
    <td align="right" colspan="2"><?php echo $total_item_  ;?></td>
  </tr>
  <tr>
    <td align="right" colspan="3">Total : </td>
    <td align="right" colspan="2">Rp. <?php echo number_format($total_paid)  ;?></td>
  </tr>
  <tr>
    <td align="right" colspan="3">Bayar : </td>
    <td align="right" colspan="2">Rp. <?php echo number_format($totalBayar) ;?></td>
  </tr>
  <tr>
    <td align="right" colspan="3">Kembali : </td>
    <td align="right" colspan="2">Rp. <?php echo number_format($refund);?></td>
  </tr>
  <tr>
    <td align="right" colspan="3">Cara Bayar : </td>
    <td align="right" colspan="2"><?php echo $type_of_payment  ;?></td>
  </tr>
  <tr>
    <td colspan="5"><hr id="struckBorder"></td>
  </tr>
  <tr>
    <td colspan="5" align="center"> 
        <i><?php echo $system_footer_struct ?><br>
          <!-- <b><?php echo $system_url ?></b><i> -->
    </td>
  </tr>
</table>
<style>
  .qty{
    font-size: 8px;
  }
  .struck-80 {
      font-size: 13px;
      width: 80mm;
  }

  .struck-58 {
      font-size: 11px;
      width: 58mm;
  }
  
  table{
    font-family: cursive;
    padding: 0px;
  }
  #struckBorder{
    border-style: dashed;
    : 5%;
  }
</style>
<?php 
  // $printer = printer_open("POS-80"); //open printer
  // printer_write($printer, "Berhasil Print Struk");    
  // printer_close($printer);
  
}
elseif (empty($_SESSION['login'])) {
    ?>
    <script type="text/javascript">
        alert("sesi anda habis, silahkan login kembali");
        window.location="<?php echo $base_url."" ?>";
    </script>
<?php
}
?>


<!-- <link href="<?php echo $base_url."assets/bower_components/bootstrap/dist/css/bootstrap.min.css" ?>" rel="stylesheet"> -->
<link href="<?php echo $base_url."assets/bower_components/font-awesome-4.7.0/css/font-awesome.min.css" ?>" rel="stylesheet" type="text/css">