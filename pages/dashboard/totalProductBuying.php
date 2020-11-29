
<?php 
	include('../../config/config.php');

    $currentYear    = date('Y-', strtotime($currentDate));
    $currentMonth   = date('m-', strtotime($currentDate));
    $currentDay     = date('d', strtotime($currentDate));
    
    $queryBuyingTransaction = mysqli_query($config, "SELECT count(total_item) AS total FROM tb_buying_transaction 
        WHERE date_insert >= '$currentYear"."$currentMonth"."01' AND time_insert >= '00:00:00' AND date_insert <= '$currentYear"."$currentMonth"."$currentDay' AND time_insert <= '23:23:59'
        	AND bl_state ='A'
        ");
    $rowBuyingTransaction = mysqli_fetch_array($queryBuyingTransaction);
    $total = $rowBuyingTransaction['total'];


 ?>
<div align="center"><font size="4"><?php echo number_format($total); ?></font></div>
<div>Total Produk Beli</div>


<script type="text/javascript">
    toastr['success']('Berhasil Update Total Produk Beli', 'Dashboard');
</script>