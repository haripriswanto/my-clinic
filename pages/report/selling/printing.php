
<?php 
  include('../../../config/config.php');
  
  if (isset($_POST['excel'])) {
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Laporan-Penjualan-".$headerName.".xls");
  }
?>

<link href="<?php echo $base_url ?>assets/bower_components/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo $base_url ?>assets/css/custom.css">
<script src="<?php echo $base_url."assets/bower_components/jquery/dist/jquery.min.js" ?>"></script>
<link rel="icon" href="<?php echo $base_url ?>assets/images/print.png">
<title></title>
<div class="container-fluid " align="center">
  <div class="row">
    <div class="col">
      <div class="page-header">
        <h2><span class="headerReport"></span></h2>
        <h3><?php echo $system_instansi_name ?></h3>
        <font style="text-transform: lowercase;">
          <?php 
            if($system_address != '' && $system_address != '-' ){ echo "<span class='fa fa-map-marker'></span> ".$system_address."<br>";} 
            if($system_phone != '' && $system_phone != '-' ){ echo "<span class='fa fa-phone-square'></span> ". $system_phone." ";} 
            if($system_email != '' && $system_email != '-' ){ echo "<span class='fa fa-envelope'></span> ".$system_email." ";} 
            if($system_url != '' && $system_url != '-' ){ echo "<span class='fa fa-globe'></span> ". $system_url." ";}
          ?>
        </font>
      </div>      
    </div>
  </div>
  <div class="clearfix"><br></div>
  <div class="row">
    <div class="col">
      <div class="pull-left"> 
        Periode : <span class="headerPeriode"></span>
      </div>
    </div>
  </div> 
  <div class="clearfix"><br></div>
<?php 
$report_type      = $_POST['report_type'];

  if ($report_type == '1') {

    $in_date_report   = $_POST['in_date_report'];
    $out_date_report  = $_POST['out_date_report'];
    $in_time_report   = $_POST['in_time_report'];
    $out_time_report  = $_POST['out_time_report'];
    $payment_type     = $_POST['payment_type'];
    $casier_name      = $_POST['casier_name'];

    // var_dump($in_date_report, $out_date_report);exit();

  	include'report_selling.php';
  }
  elseif ($report_type=="2") {

    $in_date_report   = $_POST['in_date_report'];
    $out_date_report  = $_POST['out_date_report'];
    $in_time_report   = $_POST['in_time_report'];
    $out_time_report  = $_POST['out_time_report'];
    $payment_type     = $_POST['payment_type'];
    $casier_name      = $_POST['casier_name'];

    include'report_selling_detail.php';
  }
  elseif ($report_type=="3") {

    $in_date_report   = $_POST['in_date_report'];
    $out_date_report  = $_POST['out_date_report'];
    $in_time_report   = $_POST['in_time_report'];
    $out_time_report  = $_POST['out_time_report'];
    $product_category = $_POST['product_category'];
    $product_name     = $_POST['product_name'];
    $casier_name      = $_POST['casier_name'];

    include'report_selling_per_product.php';
  }

if (isset($_POST['preview'])) {
?>

<?php } ?>
<script type="text/javascript">
  // window.print();
</script>