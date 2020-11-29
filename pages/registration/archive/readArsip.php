<?php
include('../../../config/config.php');
  
  if (!empty($_SESSION['login'])) {
?>
<div class="table-responsive">
  <table class="table table-hover table-striped" id="tableProductArsip">
    <thead>
      <tr>
        <th>#</th>
        <th>Kode</th>
        <th>Deskripsi Produk</th>
        <th>Satuan</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Stock</th>
        <th>Action</th>
      </tr>
    </thead>
      <?php 
        $selectData = "SELECT * FROM 
          tb_master_product
          INNER JOIN 
          tb_master_category
          ON tb_master_category.category_code = tb_master_product.category_code_relation
          INNER JOIN tb_master_unit 
          ON tb_master_unit.unit_code = tb_master_product.unit_code_relation
          WHERE tb_master_product.bl_state = 'D' ORDER BY tb_master_product.product_name ASC";
        $querySelectData =  mysqli_query($config, $selectData);
          $number = 0;
          while ($rowSelectData = mysqli_fetch_array($querySelectData)){
            $number                 = $number + 1 ;
            $id_product             = $rowSelectData['id_product'];
            $product_code           = $rowSelectData['product_code'];
            $product_name           = $rowSelectData['product_name'];
            $product_description    = $rowSelectData['product_description'];
            $buying_price           = $rowSelectData['buying_price'];
            $selling_price          = $rowSelectData['selling_price'];
            $price_min              = $rowSelectData['price_min'];
            $price_max              = $rowSelectData['price_max'];
            $price_margin           = $rowSelectData['price_margin'];
            $category_code_relation = $rowSelectData['category_code_relation'];
            $category_description   = $rowSelectData['category_description'];
            $unit_code_relation     = $rowSelectData['unit_code_relation'];
            $unit_description       = $rowSelectData['unit_description'];
            $stockable              = $rowSelectData['stockable'];
            $outlet_code_relation   = $rowSelectData['outlet_code_relation'];
            $ts_insert              = $rowSelectData['ts_insert'];
            $ts_update              = $rowSelectData['ts_update'];
            $bl_state               = $rowSelectData['bl_state'];

            $persen     = (($price_margin * $buying_price)/100);
            $jmlMargin  = strlen($price_margin);

            if ($jmlMargin <= 2 || $price_margin == 100){
              $selling_prices = $persen + $buying_price;
            }
            else if ($jmlMargin > 2 || $price_margin != 100) {
              $selling_prices = $buying_price + $price_margin;        
            }

            if ($stockable == 1) {
              $stockable = "<span class='label label-success'><i class='fa fa-check'></i></span>";
            }
            else{
              $stockable = "<span class='label label-danger'><i class='fa fa-times'></i></span>";
            }

        ?>
            <tr>
              <td><?php echo $number; ?></td>
              <td><?php echo $product_code;?></td>
              <td title="Detail <?php echo $product_name ?> " data-toggle="modal" id="buttonDetail" data-id="<?php echo $id_product; ?>" data-target="#detail" style="cursor: pointer;"><?php echo $product_description; ?></td>
              <td><?php echo $unit_description; ?></td>
              <td><?php echo $category_description; ?></td>
              <td class="text-right">Rp. <?php echo number_format($selling_prices); ?></td>
              <td><?php echo $stockable; ?></td>
              <td>
                <a data-id="<?php echo $id_product; ?>" data-toggle="modal" data-target="#restoreConfirm" id="buttonRestore" title="Restore Data <?php echo $product_name ?>" class="btn btn-xs btn-info buttonRestore">
                  <span class="fa fa-window-restore"></span>
                </a>
                <a data-id="<?php echo $id_product; ?>" data-code="<?php echo $product_code; ?>" data-name="<?php echo $product_name; ?>" title="Hapus Data <?php echo $product_name ?>" class="btn btn-xs btn-danger buttonDelete">
                  <span class="fa fa-times"></span>
                </a>
              </td>
        </tr>   
        <?php } ?>
  </table>
</div>

<script>

  $('#headerProduct').html('Daftar Pasien Arsip');

  $(document).ready(function() {
    enabledHeaderButton();
    $('#tableProductArsip').DataTable({
            responsive: true
    });
  });

</script>

<?php 
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