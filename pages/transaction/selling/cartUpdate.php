<?php
include("../config/config.php");

if (!empty($_SESSION['login'])) {

$product_code   = $_POST['product_code'];
$quantity       = $_POST['quantity'];

$query_cart =  mysqli_query($config, " 
        SELECT * FROM tb_cart_transaction
                WHERE product_code_relation = '$product_code' 
                AND id_user_relation='$_SESSION[user_name]'
                AND id_transaction='13' ") ;
        
        $check_product = mysqli_num_rows($query_cart);
        $query_cart_update = mysqli_fetch_array($query_cart);
        $product_code_cart = $query_cart_update['product_code_relation'];
       
            
        // QUERY CHECK STOCK 
            
            $query_check_qty = mysqli_query($config, "
                SELECT * FROM tb_stock
                    WHERE product_code_relation = '$product_code_cart' ");
                
                $row_stock = mysqli_fetch_array($query_check_qty);
                $product_code_relation = $row_stock ['product_code_relation'];
        
        if ($check_product) {
                	
        	$total_item = 0;
            //$discount_total = 0;
            $total_harga = 0;
            //var_dump($_POST['subtotal']);exit();

            $total_item     = $total_item + $_POST['quantity']; 
            // $total_harga    = $_POST['quantity'] * $_POST['total_harga'];
            //$discount_total += $_POST['discount'];
            if ($quantity=='0') {
                ?>
                <script type="text/javascript">
                    alert('Jumlah Harus Lebih Dari 0');
                    window.location="<?php echo $base_url ?>transaksi_pembelian";
                </script>
                <?php                 
            }
            else{
                $cart_update = "UPDATE tb_cart_transaction 
                    SET quantity='$quantity'
                    WHERE product_code_relation  ='$product_code_cart' 
                            AND id_user_relation ='$_SESSION[user_name]'
                            AND id_transaction='13'";
                
                $result = mysqli_query($config, $cart_update);
                if ($result) {
                     ?>    
                        <script>
                            window.location="<?php echo $base_url ?>transaksi_pembelian";
                        </script>
                    <?php
                }
            }
        }




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
