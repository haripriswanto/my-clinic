<?php include('../../../config/config.php'); ?>
<table class="table table-hover table-striped" id="dataStockOpname">
	<thead>
	  <tr>
	    <th>#</th>
	    <th>Kode</th>
	    <th>Nama Produk</th>
	    <th>Exp Date</th>
	    <th>Stok</th>
	  </tr>
	</thead>
  <?php 

// --SELECT tb_master_product.id_product, tb_master_product.product_code, tb_master_product.product_description, tb_master_product.product_name, tb_master_stock.product_stock, tb_master_stock.id_stock, tb_master_stock.outlet_code_relation
    $selectStockOpname = "
    
    SELECT * FROM tb_master_stock 
        WHERE stockable = '1' 
        AND bl_state = 'A'
        AND outlet_code_relation = '$system_outlet_code'
        ORDER BY ts_update, expire_date DESC";
    $querySelectStockOpname =  mysqli_query($config, $selectStockOpname);

      $number = 0;
      while ($rowSelectStockOpname = mysqli_fetch_array($querySelectStockOpname)){
        $number               = $number + 1 ;
        $id_stock             = $rowSelectStockOpname['id_stock'];
        $product_code         = $rowSelectStockOpname['product_code_relation'];
        $product_name         = $rowSelectStockOpname['product_name_relation'];
        $product_stock        = $rowSelectStockOpname['product_stock'];
        $expire_date          = $rowSelectStockOpname['expire_date'];

    ?>
        <tr id="selectProduct" style="cursor: pointer;" 
          id_stock="<?php echo $id_stock; ?>" 
          product_code="<?php echo $product_code; ?>"
          product_name="<?php echo $product_name; ?>"
          product_description="<?php echo $product_description; ?>"
          product_stock="<?php echo $product_stock; ?>"
        >
          <td><?php echo $number ?></td>
          <td><?php echo $product_code ?></td>
          <td><?php echo $product_name ?></td>
          <td><?php if ($expire_date != '') {echo $expire_date;} else {echo "-";} ?></td>
          <td><?php echo $product_stock ?></td>
    </tr>   
    <?php 
    }
  ?>
</table>

<script type="text/javascript">
  enableButton();
  disableForm();
  $(document).ready(function() {$('#dataStockOpname').DataTable({responsive: true});});


  $(document).on('dblclick', '#selectProduct', function (e) {
      document.getElementById("id_stock").value = $(this).attr('id_stock');
      document.getElementById("product_code").value = $(this).attr('product_code');
      document.getElementById("product_name").value = $(this).attr('product_name');
      document.getElementById("product_stock").value = $(this).attr('product_stock');
      enableForm();
      document.getElementById('product_stock').focus();
      $('#buttonSave').html('<span class="fa fa-pencil"></span> Update');
      $('#headerForm').html('Update Data');
  });
</script>