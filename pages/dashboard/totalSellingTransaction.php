
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
    
    $querySellingTransaction = mysqli_query($config, "SELECT count(*) AS total
        FROM tb_selling_transaction 
        WHERE date_insert >= '$yearOption"."$monthOption"."01' AND time_insert >= '00:00:00' AND date_insert <= '$yearOption"."$monthOption"."$currentDay' AND time_insert <= '23:23:59'
            AND bl_state <> 'D'
        ");

    $rowSellingTransaction = mysqli_fetch_array($querySellingTransaction);
    $total = $rowSellingTransaction['total'];

 ?>
<div align="center"><font size="4"><?php echo number_format($total); ?></font></div>
<div>Total Transaksi</div>


<script type="text/javascript">
    toastr['success']('Berhasil Update Total Transaksi Penjualan', 'Dashboard');
</script>