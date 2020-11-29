<?php 
  include('../../../config/config.php'); 

  function angka_pembulatan($angka,$digit,$minimal){
      $digitvalue   = substr($angka, -($digit));    
      $bulat        = 0;
      $nolnol       = "";

      for($i=1; $i<=$digit; $i++){
       $nolnol = "0";
       // echo $digitvalue;
      }
      if($digitvalue < $minimal && $digit != $nolnol){      
        $x1     = $minimal - $digitvalue;
        $bulat  = $angka + $x1;
      }else{
        $bulat = $angka;
      }
      return $bulat;  
    }
?>
<div class="panel panel-primary">
  <div class="panel-heading">
      <b>Daftar Produk!</b>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  </div>
  <div class="panel-body">
    <table id="lookupProduct" class="table table-bordered table-hover table-striped">
      <thead>
          <tr>
              <th>#</th>
              <th>Kode</th>
              <th>Nama</th>
              <th>Stok</th>
              <th>Satuan</th>
              <th>Harga</th>
              <th>Stockable</th>
          </tr>
      </thead>
      <tbody>
          <?php
              $c_name_L = mysqli_escape_string($config, strtolower($_GET['c_buying_product_name']));
              $c_name_U = mysqli_escape_string($config, strtoupper($_GET['c_buying_product_name']));
              $c_name_C = mysqli_escape_string($config, ucwords($c_name_L));

              // var_dump("Lower: ".$c_name_L, "Upper: ".$c_name_U, "Cptl: ".$c_name_C);

          $selectProduct = "SELECT tb_master_unit.*, tb_master_product.*, tb_master_stock.*, 
                      tb_master_stock.stockable as stock
                        FROM tb_master_product 
                        RIGHT JOIN tb_master_stock
                        ON tb_master_product.product_code = tb_master_stock.product_code_relation
                        INNER JOIN tb_master_unit 
                        ON tb_master_product.unit_code_relation = tb_master_unit.unit_code
                        WHERE (tb_master_product.product_name LIKE '%$c_name_L%' OR tb_master_product.product_name LIKE '%$c_name_C%' OR tb_master_product.product_code LIKE '%$c_name_L%' OR tb_master_product.product_code LIKE '%$c_name_C%')
                        AND tb_master_product.bl_state = 'A'
                        AND tb_master_product.outlet_code_relation = '$system_outlet_code'
                        AND tb_master_stock.stockable =  '1' 
                        -- OR tb_master_stock.stockable = '0'
                        ORDER BY tb_master_product.product_name ASC";

          // var_dump($selectProduct);exit;

          $querySelectProduct = mysqli_query($config, $selectProduct);
          $number = 0;
          while ($data = mysqli_fetch_array($querySelectProduct)) {
                $number++;
                $product_code   = $data['product_code'];
                $product_name   = $data['product_name'];
                $buying_price   = $data['buying_price'];
                $margin         = $data['price_margin'];
                $product_stock  = $data['stockable'];
                $unit_description  = $data['unit_description'];

                if ($data['stock'] == 1) {
                    $stockable = "<span class='label label-success'><span class='fa fa-check'></span></span>";
                 }
                 elseif ($data['stock'] == 0) {
                    $stockable = "<span class='label label-danger'><span class='fa fa-times'></span></span>";
                 }
          ?>
            <tr id="selectProduct" style="cursor: pointer;" data-product-code="<?php echo $product_code ?>" data-product-name="<?php echo $product_name; ?>" data-product-price="<?php echo $buying_price; ?>">
                <td><?php echo $number ?></td>
                <td><?php echo $data['product_code']; ?></td>
                <td><?php echo $data['product_name']; ?></td>
                <td><?php echo number_format($data['product_stock']); ?></td>
                <td><?php echo $unit_description; ?></td>
                <td>Rp. <?php echo number_format($buying_price); ?></td>
                <td><?php echo $stockable; ?></td>
            </tr>
          <?php } ?>
      </tbody>
    </table>
    <font color="orange"><i>*Klik pada salah satu produk</i></font>
  </div>

<script type="text/javascript">
  $(document).on('click', '#selectProduct', function (e) {
      document.getElementById("c_buying_product_code").value = $(this).attr('data-product-code');
      document.getElementById("c_buying_product_name").value = $(this).attr('data-product-name');    
      document.getElementById("c_buying_price").value = $(this).attr('data-product-price');             
      $('#listProduct').modal('hide');
      document.getElementById('c_buying_product_qty').focus();
  });            
  $(function () {
      $("#lookupProduct").dataTable();
  });       

</script>