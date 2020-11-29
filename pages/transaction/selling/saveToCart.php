<?php

include("../../../config/config.php");

if (!empty($_SESSION['login']['user_name'])) {

$c_selling_product_code     = mysqli_escape_string($config, $_GET['c_selling_product_code']);
$product_qty                = mysqli_escape_string($config, $_GET['c_selling_product_qty']);
$c_selling_HTU_code         = mysqli_escape_string($config, $_GET['c_selling_HTU_code']);
$how_to_use                 = mysqli_escape_string($config, $_GET['c_selling_HTU']);
$selling_price              = mysqli_escape_string($config, $_GET['c_selling_price']);

    $querySelectProduct = mysqli_query($config, "SELECT * FROM 
        tb_master_category
        INNER JOIN 
        tb_master_product
        ON tb_master_category.category_code = tb_master_product.category_code_relation
        INNER JOIN tb_master_unit 
        ON tb_master_unit.unit_code = tb_master_product.unit_code_relation
        WHERE tb_master_product.bl_state = 'A' 
        AND tb_master_product.product_code ='$c_selling_product_code' AND tb_master_product.outlet_code_relation ='$system_outlet_code' ");
        while ($rowSelectData = mysqli_fetch_array($querySelectProduct)){
            $id_product             = $rowSelectData['id_product'];
            $product_code           = $rowSelectData['product_code'];
            $product_name           = $rowSelectData['product_name'];
            $product_description    = $rowSelectData['product_description'];
            $price_min              = $rowSelectData['price_min'];
            $price_max              = $rowSelectData['price_max'];
            $selling_prices         = $rowSelectData['selling_price'];
            $price_margin           = $rowSelectData['price_margin'];
            $category_code_relation = $rowSelectData['category_code_relation'];
            $category_description   = $rowSelectData['category_description'];
            $unit_code_relation     = $rowSelectData['unit_code_relation'];
            $unit_description       = $rowSelectData['unit_description'];
            $stockable              = $rowSelectData['stockable'];
        }

// verifikasi product null
if ($c_selling_product_code==''){
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
elseif ($selling_price == '0'){   
    ?>
    <script type="text/javascript">
        toastr['error']('Harga Tidak Boleh 0.');
        enabledFormCart();
        $('#product_qty').focus(); 
    </script>
    <?php 
    // exit();
}
// verifikasi Price null
elseif ($product_qty == '0'){   
    ?>
    <script type="text/javascript">
        toastr['error']('Jumlah tidak boleh 0.');
        enabledFormCart();
        $('#product_qty').focus(); 
    </script>
    <?php 
    // exit();
}
// else
else{
$selectDataCart = " 
    SELECT * FROM tb_selling_cart 
    WHERE product_code_relation = '$c_selling_product_code' 
    AND user_name = '$sessionUser'
    AND outlet_code_relation = '$system_outlet_code'";

    $queryCart =  mysqli_query($config, $selectDataCart);
    $checkProduct = mysqli_num_rows($queryCart);
    $queryCartUpdate = mysqli_fetch_array($queryCart);
    $productCodeCart = $queryCartUpdate['product_code_relation'];

    $selectCheckStok = "SELECT tb_master_stock.*, tb_master_product.* 
                    FROM tb_master_stock 
                    INNER JOIN tb_master_product
                    ON tb_master_stock.product_code_relation = tb_master_product.product_code
                    WHERE tb_master_stock.product_code_relation = '$c_selling_product_code' AND tb_master_stock.stockable = '1' AND tb_master_stock.bl_state = 'A' AND tb_master_product.bl_state = 'A' AND tb_master_product.outlet_code_relation = '$system_outlet_code' ";
    $querySelectCheckStok = mysqli_query($config, $selectCheckStok);
    $rowSelectCheckStok = mysqli_fetch_array($querySelectCheckStok);
    $stock          = $rowSelectCheckStok['product_stock'];
    $price_min      = $rowSelectCheckStok['price_min'];
    $price_max      = $rowSelectCheckStok['price_max'];

    if ($product_qty > $stock) {
        echo "<script>toastr['error']('Stok Tidak Cukup');enabledFormCart();$('#c_selling_product_qty').focus();</script>";
    }
    // elseif ($selling_price > $price_max) {
    //     echo "<script>toastr['error']('Harga Tidak Boleh Lebih Besar Dari Harga Maksimal!');enabledFormCart();$('#c_selling_price').focus();</script>";
    // }elseif ($selling_price < $price_min) {
    //     echo "<script>toastr['error']('Harga Tidak Boleh Lebih Kecil Dari Harga Minimal!');enabledFormCart();$('#c_selling_price').focus();</script>";
    // }else
    elseif ($checkProduct) { 
        $updateCart = "UPDATE tb_selling_cart
            SET selling_qty = '$product_qty', 
            selling_price = '$selling_price',
            how_to_use_code = '$c_selling_HTU_code',
            how_to_use = '$how_to_use',
            ts_update = '$currentDate $currentTime'
            WHERE product_code_relation  = '$productCodeCart' 
            AND user_name = '$sessionUser' 
            AND outlet_code_relation = '$system_outlet_code' ";

        $queryUpdateCart = mysqli_query($config, $updateCart);
        if ($queryUpdateCart) {
            echo "<script>LoadCartTransaction();enabledFormCart();clearFormCart();</script>";
        }
        else{
            echo "Failed UPDATE tb_selling_cart";                    
        }
    }else{
        //QUERY INSERT CART AND CHECK STOCK
        $insertCart = "INSERT INTO tb_selling_cart(id_selling_cart, product_code_relation, product_name, product_description, selling_price, selling_qty, unit_code_relation, unit_description, category_code_relation, category_description, how_to_use_code, how_to_use, user_name, outlet_code_relation, ip_address, ts_insert, bl_state)
        
        VALUES ('$generateID', '$product_code', '$product_name', '$product_description', '$selling_price', '$product_qty', '$unit_code_relation', '$unit_description', '$category_code_relation', '$category_description', '$c_selling_HTU_code', '$how_to_use', '$sessionUser', '$system_outlet_code', '$ip_address', '$currentDate $currentTime', 'A')";

        $queryInsertCart = mysqli_query($config, $insertCart);
        if ($queryInsertCart) {
            echo "<script>LoadCartTransaction();enabledFormCart();clearFormCart();</script>";
        }
    }
}

// Cek Session
}
elseif (empty($_SESSION['login'])) {
    ?>
    <script type="text/javascript">
        alert("sesi anda habis, silahkan login kembali");
        window.location="<?php echo $base_url."" ?>";
    </script>
<?php
}
?>