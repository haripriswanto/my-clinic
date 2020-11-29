
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


    $selectSellingPayment = "SELECT
        sum(total_paid) AS omset
        FROM tb_selling_payment 
        WHERE date_insert >= '$yearOption"."$monthOption"."01' AND time_insert >= '00:00:00' AND date_insert <= '$yearOption"."$monthOption"."$currentDay' AND time_insert <= '23:23:59'
        -- AND outlet_code_relation = '$system_outlet_code'
        AND bl_state ='A' ";
    // var_dump($selectSellingPayment);exit;
    $querySellingPayment = mysqli_query($config, $selectSellingPayment);


    while ($rowSellingPayment  = mysqli_fetch_array($querySellingPayment)){
            $omset    = $rowSellingPayment['omset'];
    }
 ?>
<div align="center"><font size="4">Rp. <?php echo number_format($omset) ?></font></div>
<div>Total Omset</div>

<script type="text/javascript">
    toastr['success']('Berhasil Update Total Omset ', 'Dashboard');
</script>