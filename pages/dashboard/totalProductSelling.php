
<?php 
	include('../../config/config.php');

    
    if ($_GET['yearOption'] != '') {
        $yearOption     = $_GET['yearOption']."-";
        $monthOption    = $_GET['monthOption']."-";
        $currentDay     = '31';
    } else if ($_GET['yearOption'] === '') {
        $yearOption     = date('Y-', strtotime($currentDate));
        $monthOption    = date('m-', strtotime($currentDate));
        $currentDay     = date('d', strtotime($currentDate));
    }
    
    $selectSellingTransaction = "SELECT SUM(product_qty) as total_product FROM tb_selling_transaction_detail 
    WHERE ts_insert >= '$yearOption"."$monthOption"."01"." 00:00:00' AND ts_insert <= '$yearOption"."$monthOption"."$currentDay"." 23:23:59'
    AND bl_state ='A'
    ";
    // var_dump($selectSellingTransaction);exit;
    $querySellingTransaction = mysqli_query($config, $selectSellingTransaction);
    $rowSellingTransaction = mysqli_num_rows($querySellingTransaction);
    $roSellingTransaction = mysqli_fetch_array($querySellingTransaction);
 ?>

<div align="center"><font size="4"><?php echo number_format($roSellingTransaction['total_product']); ?></font></div>
<div>Jumlah Produk Terjual</div>


<script type="text/javascript">
    toastr['success']('Berhasil Update Total Penjualan', 'Dashboard');
</script>