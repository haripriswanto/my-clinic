
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
    
    $selectCustomer = "SELECT count(customer_code_relation) as total_customer 
    FROM tb_selling_transaction 
    WHERE customer_code_relation != '' 
    AND date_insert >= '$yearOption"."$monthOption"."01' AND time_insert >= '00:00:00' AND date_insert <= '$yearOption"."$monthOption"."$currentDay' AND time_insert <= '23:23:59' 
    AND outlet_code_relation = '$system_outlet_code'
    AND bl_state <> 'D' ";
    // var_dump($selectCustomer);
    $querySelectCustomer = mysqli_query($config, $selectCustomer);
    $rowSelectCustomer = mysqli_fetch_array($querySelectCustomer);
    $totalCustomer = mysqli_num_rows($querySelectCustomer);

 ?>
<div align="center"><font size="4"><?php echo number_format($rowSelectCustomer['total_customer'])." Orang"; ?></font></div>
<div>Total Kunjungan</div>

<script type="text/javascript">
    toastr['success']('Berhasil Update Total Customer', 'Dashboard');
</script>