
<?php 
  include('../../../config/config.php');

$report_type      = $_POST['report_type'];

  if ($report_type=="1") {

    $in_date_report   = $_POST['in_date_report'];
    $out_date_report  = $_POST['out_date_report'];
    $in_time_report   = $_POST['in_time_report'];
    $out_time_report  = $_POST['out_time_report'];
    // $payment_type     = $_POST['payment_type'];
    $casier_name      = $_POST['casier_name'];

  	include'report_buying.php';
  }
  elseif ($report_type=="2") {

    $in_date_report   = $_POST['in_date_report'];
    $out_date_report  = $_POST['out_date_report'];
    $in_time_report   = $_POST['in_time_report'];
    $out_time_report  = $_POST['out_time_report'];
    $payment_type     = '1';
    $casier_name      = $_POST['casier_name'];

    include'report_buying_detail.php';
  }
  elseif ($report_type=="3") {

    $in_date_report   = $_POST['in_date_report'];
    $out_date_report  = $_POST['out_date_report'];
    $in_time_report   = $_POST['in_time_report'];
    $out_time_report  = $_POST['out_time_report'];
    $product_category = $_POST['product_category'];
    $product_name     = $_POST['product_name'];

    include'report_buying_per_product.php';
  }

if (isset($_POST['preview'])) {
?>
<link href="<?php echo $base_url ?>assets/bower_components/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo $base_url ?>assets/css/custom.css">
<link rel="stylesheet" href="<?php echo $base_url ?>assets/search-component/bootstrap.min.css">

<?php } ?>
<script type="text/javascript">
  window.print();
</script>