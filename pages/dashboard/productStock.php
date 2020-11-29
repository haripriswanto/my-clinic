
<?php 
    include('../../config/config.php');

    $txtStock = $_GET['txtStock'];

    if ($txtStock != '') {
        $filter = 'product_code_relation LIKE "%'.$txtStock.'%" OR product_name_relation LIKE "%'.$txtStock.'%" AND ';
    } else if ($txtStock == ''){
        $filter = '';
    }

    $selectExpireDate = "SELECT * FROM tb_master_stock WHERE $filter product_stock <= 30 AND bl_state ='A' ";
    $querySelectExpireDate = mysqli_query($config, $selectExpireDate);
    $checkRowSelectExpireDate = mysqli_num_rows($querySelectExpireDate);

if ($checkRowSelectExpireDate) {

    $label = $checkRowSelectExpireDate;

    $numberStock = 0;
    while($rowSelectExpireDate = mysqli_fetch_array($querySelectExpireDate)){
        $numberStock           = $numberStock+1;
        $id_stock               = $rowSelectExpireDate['id_stock'];
        $product_code_relation  = $rowSelectExpireDate['product_code_relation'];
        $product_name_relation  = $rowSelectExpireDate['product_name_relation'];
        $product_stock          = $rowSelectExpireDate['product_stock'];
        $stockable              = $rowSelectExpireDate['stockable'];
        $expire_date            = $rowSelectExpireDate['expire_date'];
        $ts_insert              = $rowSelectExpireDate['ts_insert'];
        $ts_update              = $rowSelectExpireDate['ts_update'];
        $outlet_code_relation   = $rowSelectExpireDate['outlet_code_relation'];
        $bl_state               = $rowSelectExpireDate['bl_state'];

        $tanggal = new DateTime($ts_update);
        $today  = new DateTime('today');
        $y      = $today->diff($tanggal)->y;
        $m      = $today->diff($tanggal)->m;
        $d      = $today->diff($tanggal)->d;
        $h      = $today->diff($tanggal)->h;
        $i      = $today->diff($tanggal)->i;
        $s      = $today->diff($tanggal)->s;
        // if ($product_stock < 30) {

?>
<ul class="chat">
    <li class="left clearfix">
        <span class="chat-img pull-left">
            <?php echo $numberStock.". "; ?>
        </span>
        <div class="chat-body">
            <div class="header">
                <strong class="primary-font"><?php echo $product_name_relation." (".$product_stock.")"; ?></strong>
                <small class="pull-right text-muted">
                    <i class="fa fa-clock-o fa-fw"></i> <?php echo $ts_update; ?>
                </small>
            </div>
        </div>
    </li>
</ul>
<script>
    $('#countHeaders').html(<?php echo $label; ?>);
</script>
<?php  
    } 
} else {
?>
<script>
    $('#countHeaders').html('');
</script>
<ul class="chat">
    <li class="clearfix">
        <div class="chat-body">
            <div class="header text-center">
                <strong class="primary-font">Tidak ada produk!</strong>
            </div>
        </div>
    </li>
</ul>
<?php 
} 
?>

<script type="text/javascript">
    toastr['success']('Berhasil Update Stok Produk', 'Dashboard');
</script>