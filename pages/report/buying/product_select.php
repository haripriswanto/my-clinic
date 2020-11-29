
<?php
include("../../../config/config.php");
$product_category = $_GET['product_category'];
if ($product_category == '') {
  ?>
<option value="">-- Pilih Kategori Dahulu --</option>
<?php 
}
else{
  echo "<option value=''>-- Semua Produk --</option>";
  $queryProduct = mysqli_query($config, "SELECT * FROM tb_master_product 
          WHERE bl_state='A'
          AND category_code_relation = '$product_category'
          ORDER BY product_name ASC");

    while ($rowProduct = mysqli_fetch_array($queryProduct)) {
   ?>
   <option value="<?php echo $rowProduct['product_code'] ?>"><?php echo $rowProduct['product_name']; ?></option>
<?php } } ?>