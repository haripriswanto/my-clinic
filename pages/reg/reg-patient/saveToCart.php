<?php

include("../../../config/config.php");

if (!empty($_SESSION['login']['user_name'])) {

$c_buying_product_code      = mysqli_escape_string($config, $_POST['c_buying_product_code']);
$product_qty                = mysqli_escape_string($config, $_POST['c_buying_product_qty']);
$c_buying_price             = mysqli_escape_string($config, $_POST['c_buying_price']);
$c_product_expire           = mysqli_escape_string($config, date('Y-m-d', strtotime($_POST['c_product_expire'])));
$c_batch_code               = mysqli_escape_string($config, $_POST['c_batch_code']);

// var_dump($c_batch_code);

if ($c_product_expire == '') {
    $c_product_expire = '2000-01-01';
}else{
    $c_product_expire = $c_product_expire; 
}

$querySelectProduct = mysqli_query($config, "SELECT * FROM 
    tb_master_category
    INNER JOIN 
    tb_master_product
    ON tb_master_category.category_code = tb_master_product.category_code_relation
    INNER JOIN tb_master_unit 
    ON tb_master_unit.unit_code = tb_master_product.unit_code_relation
    WHERE tb_master_product.bl_state = 'A' 
    AND tb_master_product.product_code ='$c_buying_product_code' AND tb_master_product.outlet_code_relation ='$system_outlet_code' ");
    while ($rowSelectData = mysqli_fetch_array($querySelectProduct)){
        $id_product             = $rowSelectData['id_product'];
        $product_code           = $rowSelectData['product_code'];
        $product_name           = $rowSelectData['product_name'];
        $product_description    = $rowSelectData['product_description'];
        $buying_price           = $rowSelectData['buying_price'];
        $price_min              = $rowSelectData['price_min'];
        $price_max              = $rowSelectData['price_max'];
        $price_margin           = $rowSelectData['price_margin'];
        $category_code_relation = $rowSelectData['category_code_relation'];
        $category_description   = $rowSelectData['category_description'];
        $unit_code_relation     = $rowSelectData['unit_code_relation'];
        $unit_description       = $rowSelectData['unit_description'];
        $stockable              = $rowSelectData['stockable'];
    }

// verifikasi product null
if ($c_buying_product_code==''){
    ?>
    <script type="text/javascript">
        $(document).ready(function() {
            toastr['error']('Pilih Produk Dari List Produk.');
            $('#listProduct').modal('show');
        });
    </script>
    <?php 
}
// verifikasi Price null
elseif ($c_buying_price == '0'){   
    ?>
    <script type="text/javascript">
        toastr['error']('Input Harga Lebih Besar.');
        $('#c_buying_price').focus(); 
        enabledFormCart();
    </script>
    <?php 
    // exit();
}
// verifikasi Price null
elseif ($product_qty == '0'){   
    ?>
    <script type="text/javascript">
        toastr['error']('Input Jumlah Lebih Besar.');
        $('#product_qty').focus(); 
    </script>
    <?php 
    // exit();
}
// else
else{

$queryCart =  mysqli_query($config, " 
    SELECT * FROM tb_buying_cart WHERE product_code_relation = '$product_code' AND user_name = '$sessionUser' AND outlet_code_relation = '$system_outlet_code'");
    
    $checkProduct = mysqli_num_rows($queryCart);
    $queryCartUpdate = mysqli_fetch_array($queryCart);
    $productCodeCart = $queryCartUpdate['product_code_relation'];
   
    if ($checkProduct) { 
        $updateCart = "UPDATE tb_buying_cart
            SET batch_code = '$c_batch_code',
            buying_qty = '$product_qty', 
            buying_price = '$c_buying_price',
            exp_date = '$c_product_expire', 
            ts_update = '$currentDate $currentTime'
            WHERE product_code_relation  = '$productCodeCart' 
            AND user_name = '$sessionUser' 
            AND outlet_code_relation = '$system_outlet_code' ";

        $queryUpdateCart = mysqli_query($config, $updateCart);
        if ($queryUpdateCart) {
            echo "<script>LoadCartTransaction();enabledFormCart();clearFormCart();</script>";
        }
        else{
            echo "Failed UPDATE Data";                    
        }
    }
    else{
        //QUERY INSERT CART AND CHECK STOCK
        
        $insertCart = "INSERT INTO tb_buying_cart(id_buying_cart, batch_code, product_code_relation, product_name, product_description, buying_price, buying_qty, unit_code_relation, unit_description, category_code_relation, category_description, user_name, outlet_code_relation, ip_address, exp_date, ts_insert, bl_state)
    VALUES ('".sha1(generate(20))."', '$c_batch_code', '$product_code', '$product_name', '$product_description', '$c_buying_price', '$product_qty', '$unit_code_relation', '$unit_description', '$category_code_relation', '$category_description', '$sessionUser', '$system_outlet_code', '$ip_address', '$c_product_expire', '$currentDate $currentTime', 'A')";

    // var_dump($insertCart);

        $queryInsertCart = mysqli_query($config, $insertCart);
        if ($queryInsertCart) {
            echo "<script>LoadCartTransaction();enabledFormCart();clearFormCart();</script>";
        }
    }
}

// Cek Session
}
elseif (empty($_SESSION['login']['user_name'])) {
    ?>
    <script type="text/javascript">
        toastr['error']("Maaf, Sesi Anda Telah Berakhir! Silahkan Login Kembali.");
        if (buttons = true){
            window.location = '<?php echo $base_url."redirect"; ?>'
        }
    </script>
<?php
}
?>
