<?php 
include('../../../../config/config.php'); 

if (!empty($_SESSION['login'])) {

  $invoice_number       = $_GET['invoice_number'];
  $type                 = $_GET['type'];
  $supplier             = $_GET['supplier'];
  $user_name            = $_GET['user'];
  $payment              = $_GET['payment'];
  $date_insert          = $_GET['date'];
  $time_insert          = $_GET['time'];
  $ts_insert            = $_GET['ts_insert'];
  $ts_update            = $_GET['ts_update'];
  ?>
<link rel="icon" href="<?php echo $base_url."assets/images/print.png" ?>">
<title>Cetak <?php echo $type; ?></title>
<body>
  <div class="container">
  <table class="table borderless body">
    <thead>
      <tr>
        <th colspan="3" class="text-left">
          <h2><?php echo $system_instansi_name ?></h2>
          <!-- <div class="clearfix"></div> -->
          <font style="text-transform: lowercase; font-weight:normal; font-size:12;">
            <?php if($system_address != ''&& $system_address != '-') {echo "<span class='fa fa-map-marker'></span> ".$system_address;} else {echo "";} ?><br>
            <?php if($system_phone != ''&& $system_phone != '-') {echo "<span class='fa fa-phone-square'></span> ".$system_phone;} ?>
            <?php if($system_email != ''&& $system_email != '-') {echo "<span class='fa fa-envelope'></span> ".$system_email;} ?>
            <?php if($system_url != ''&& $system_url != '-') {echo "<span class='fa fa-globe'></span> ".$system_url;} ?>
          </font>
        </th>
        <th></th>
        <th colspan="3" class="text-right">
          <h4>Rincian Transaksi Pembelian</h4>
          <font style="text-transform: capitalize; font-weight:bold; font-size:12;">
            No. Invoice. # <?php echo $invoice_number ?>
          </font>
        </th>
      </tr>
      <tr>
        <td colspan="3" class="text-left">
        <b>Nama Penyedia:</b><p>
          <?php echo $supplier ?>
        </td>
        <td></td>
        <td colspan="3" class="text-right">
          <b>Admin:</b><p>
            <?php echo $user_name ?>
        </td>
      </tr>
      <tr>
        <td colspan="3" class="text-left">
          <b>Cara Bayar:</b><p>
            Tunai
        </td>
        <td></td>
        <td colspan="3" class="text-right">
          <b>Tgl Transaksi:</b><p>  
            <?php if($ts_update == ''){echo $date_insert." ".$time_insert;}else{echo $ts_update." [Batal]";} ?>
        </td>
      </tr>
      <tr><th colspan="7"></th></tr>
    </thead>
    <!-- <div class="clearfix"></div> -->
    <thead>
      <tr>
        <th width="3%">#</th>
        <th width="18%">Kode Produk</th>
        <th width="35%">Nama Produk</th>
        <th width="15%">Expire Date</th>
        <th width="5%">Qty</th>
        <th width="10%">Harga</th>
        <th width="15%" colspan="4" class="text-right">Subtotal</th>
      </tr>
    </thead>
    <tbody class="body">    
    <?php 
      $selectDetailTransaction = " SELECT tb_buying_transaction.invoice_number, tb_buying_transaction.supplier_description,tb_buying_transaction.total_item AS total_item_, tb_buying_transaction.note AS catatan, tb_buying_transaction_detail.product_code_relation, tb_buying_transaction_detail.product_name, tb_buying_transaction_detail.product_description, tb_buying_transaction_detail.product_qty, tb_buying_transaction_detail.buying_price, tb_buying_payment.type_of_payment, tb_buying_payment.total_paid, tb_buying_payment.money_paid, tb_buying_payment.nominal_cash, tb_buying_payment.user_code_relation AS casier, tb_buying_transaction_detail.expire_date as expire
      FROM tb_buying_transaction
      INNER JOIN tb_buying_transaction_detail ON tb_buying_transaction.invoice_number =  tb_buying_transaction_detail.invoice_number_relation AND tb_buying_transaction_detail.invoice_number_relation = '$invoice_number'
      INNER JOIN tb_buying_payment ON tb_buying_transaction.invoice_number = tb_buying_payment.invoice_number_relation
      WHERE tb_buying_transaction.outlet_code_relation = '$system_outlet_code' 
      ";
      $total_item_= 0;
      $number = 0;
      $nominal_cash = 0;
      $type_of_payment = 0;
    $querySelectDetailTransaction =  mysqli_query($config, $selectDetailTransaction);
      while ($rowSelectDetailTransaction = mysqli_fetch_array($querySelectDetailTransaction)){
        $number                  = $number + 1;
        $invoice_number          = $rowSelectDetailTransaction['invoice_number'];
        $supplier_description    = $rowSelectDetailTransaction['supplier_description'];
        $total_item_             = $rowSelectDetailTransaction['total_item_'];
        $catatan                 = $rowSelectDetailTransaction['catatan'];
        $product_code_relation   = $rowSelectDetailTransaction['product_code_relation'];
        $product_name            = $rowSelectDetailTransaction['product_name'];
        $product_description     = $rowSelectDetailTransaction['product_description'];
        $product_qty             = $rowSelectDetailTransaction['product_qty'];
        $buying_price            = $rowSelectDetailTransaction['buying_price'];
        $type_of_payment         = $rowSelectDetailTransaction['type_of_payment'];
        $total_paid              = $rowSelectDetailTransaction['total_paid'];
        $money_paid              = $rowSelectDetailTransaction['money_paid'];
        $nominal_cash            = $rowSelectDetailTransaction['nominal_cash'];
        $user_code_relation      = $rowSelectDetailTransaction['casier'];
        $expire_date             = $rowSelectDetailTransaction['expire'];
        $subtotal                = $buying_price * $product_qty;

        if($expire_date <= $currentDate OR $expire_date == '0000-00-00'){
        $expire_date = '-';
        } else {
        $expire_date = $expire_date;
        }

    ?>
      <tr>
        <td><?php echo $number ?> .</td>
        <td><?php echo $product_code_relation ?></td>
        <td><?php echo $product_name ?></td>
        <td><?php echo $expire_date ?></td>
        <td><?php echo number_format($product_qty) ?></td>
        <td>Rp. <?php echo number_format($buying_price) ?></td>
        <td class="text-right">Rp. <?php echo number_format($subtotal) ?></td>
      </tr>
    <?php } ?>
    
      <tr class="">
        <td colspan="4">Catatan: <?php echo $catatan; ?></td>
        <td class=" text-right" colspan="2"><strong>Total Item : </strong></td>
        <td class=" text-right"><?php echo number_format($total_item_) ?></td>
      </tr>
      <tr class="" style="border-top:none;">
        <td rowspan="2" colspan="4" class="text-right" vertical-align="middle"><b class="terbilang">-- <?php echo terbilang($nominal_cash)." Rupiah"; ?> --</b></td>
        <td class="text-right" colspan="2"><strong>Total : </strong></td>
        <td class="text-right">Rp. <?php echo number_format($nominal_cash) ?></td>
      </tr>
      <tr class="">
        <td class="text-right" colspan="2"><strong>Cara Bayar : </strong></td>
        <td class="text-right"><?php echo $type_of_payment; ?></td>
      </tr>
    </tbody>
    <!-- <thead> -->
      <tr>
        <th></th>
      </tr>
      <tr class="body" style="margin-top:15px;">
        <td colspan="3" style="border-top:none;" class="text-center"></td>
        <td colspan="1" style="border-top:none;"></td>
        <td colspan="3" style="border-top:none;" class="text-center"><?php echo $hari.", ".$tgl." ".$bln." ".$thn." ".$currentTime; ?> <p> Petugas, </td>
      </tr>
      <tr><td colspan='7' style="border-top:none;" height="40px"></td></tr>
      <tr class="body">
        <th colspan="3" class="text-center" style="border-top:none;"></th>
        <td colspan="1" style="border-top:none;"></td>
        <th colspan="3" class="text-center" style="border-top:none;"><?php echo $sessionFullName ?></th>
      </tr>
    <!-- </thead> -->
  </table>
  </div>  
</body>
<style>
  .body{
    font-size:11px;
  }
  .head{
    font-size:11px;
    padding-top:2em;
  }
  .terbilang{
    text-transform: uppercase;
    font-style: italic;
    font-size:12px;
  }
</style>
<link href="<?php echo $base_url."assets/bower_components/bootstrap/dist/css/bootstrap.min.css" ?>" rel="stylesheet">
<link href="<?php echo $base_url."assets/bower_components/font-awesome-4.7.0/css/font-awesome.min.css" ?>" rel="stylesheet" type="text/css">

<?php
 
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
