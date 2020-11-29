
<?php 
    include('../../config/config.php');

    $txtExpired = $_GET['txtExpired'];

    if ($txtExpired != '') {
        $filter = 'product_code_relation LIKE "%'.$txtExpired.'%" OR product_name_relation LIKE "%'.$txtExpired.'%" OR expire_date LIKE "%'.$txtExpired.'%" AND ';
    } else if ($txtExpired == ''){
        $filter = '';
    }

    $selectExpireDate      = "SELECT * FROM tb_master_stock WHERE $filter expire_date != '' AND product_stock > 0 AND bl_state ='A' ";
    // var_dump($selectExpireDate);exit;
    $querySelectExpireDate = mysqli_query($config, $selectExpireDate);

    $numberExpire = 1;
    while($rowSelectExpireDate = mysqli_fetch_array($querySelectExpireDate)){
            $numberExpire           = $numberExpire++;
            $id_stock               = $rowSelectExpireDate['id_stock'];
            $product_code_relation  = $rowSelectExpireDate['product_code_relation'];
            $product_name_relation  = $rowSelectExpireDate['product_name_relation'];
            $product_stock          = $rowSelectExpireDate['product_stock'];
            $stockable              = $rowSelectExpireDate['stockable'];
            $expire_date            = $rowSelectExpireDate['expire_date'];
            $ts_insert              = $rowSelectExpireDate['ts_insert'];
            $outlet_code_relation   = $rowSelectExpireDate['outlet_code_relation'];
            $bl_state               = $rowSelectExpireDate['bl_state'];

            $tanggal = new DateTime($expire_date);
            $today  = new DateTime('today');
            $years  = $today->diff($tanggal)->y;
            $months = $today->diff($tanggal)->m;
            $days   = $today->diff($tanggal)->d;
            $hours  = $today->diff($tanggal)->h;
            $i      = $today->diff($tanggal)->i;
            $seconds= $today->diff($tanggal)->s;
            if ($years < 1 && $months <= 6 && $days <= 31) {

    ?>
    <ul class="chat">
        <li class="left clearfix">
                <span class="chat-img pull-left">
                    <?php echo $numberExpire.". "; ?>
                </span>

            <div class="chat-body">
                <div class="header">
                    <strong class="primary-font"><?php echo $product_name_relation ." (".$product_stock.")" ?></strong>
                    <small class="pull-right text-muted">
                        <i class="fa fa-clock-o fa-fw"></i> <?php if($years != ''){ echo $years." Tahun";} if($months != '') {echo $months." Bulan ";} if($days != ''){echo $days." Hari ";} echo "Lagi"; ?>
                    </small>
                </div>
            </div>
        </li>
    </ul>
    <?php 
        }
} 
?>

<script type="text/javascript">
    toastr['success']('Berhasil Update Product Expired', 'Dashboard');
</script>