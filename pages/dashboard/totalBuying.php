
<?php 
	include('../../config/config.php');

    $currentYear    = date('Y-', strtotime($currentDate));
    $currentMonth   = date('m-', strtotime($currentDate));
    $currentDay     = date('d', strtotime($currentDate));

    $queryBuyingTransaction = mysqli_query($config, "SELECT sum(total_item) AS total FROM tb_buying_transaction 
        WHERE date_insert >= '$currentYear"."$currentMonth"."01' AND time_insert >= '00:00:00' AND date_insert <= '$currentYear"."$currentMonth"."$currentDay' AND time_insert <= '23:23:59'
        AND bl_state ='A'
        ");
    $rowBuyingTransaction = mysqli_num_rows($queryBuyingTransaction);

 ?>
<div align="center"><font size="4"><?php echo number_format($rowBuyingTransaction); ?></font></div>
<div>Total Produk Masuk</div>


<script type="text/javascript">
    toastr['success']('Berhasil Update Total Pembelian', 'Dashboard');
</script>