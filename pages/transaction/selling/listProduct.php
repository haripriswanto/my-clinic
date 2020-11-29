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
              $c_name_L = mysqli_escape_string($config, strtolower($_GET['c_selling_product_name']));
              $c_name_U = mysqli_escape_string($config, strtoupper($_GET['c_selling_product_name']));
              $c_name_C = mysqli_escape_string($config, ucwords($c_name_L));

              $querySelectProduct = mysqli_query($config, "
                      SELECT tb_master_unit.*, tb_master_product.*, tb_master_stock.*, tb_master_stock.stockable as stock
                              FROM tb_master_stock 
                              LEFT JOIN tb_master_product ON tb_master_product.product_code = tb_master_stock.product_code_relation
                              INNER JOIN tb_master_unit ON tb_master_unit.unit_code = tb_master_product.unit_code_relation
                              WHERE (tb_master_product.product_name LIKE '%$c_name_L%' OR tb_master_product.product_name LIKE '%$c_name_C%' OR tb_master_product.product_code LIKE '%$c_name_L%' OR tb_master_product.product_code LIKE '%$c_name_C%')
                              AND tb_master_product.bl_state = 'A'
                              AND tb_master_product.outlet_code_relation = '$system_outlet_code'
                              AND tb_master_stock.stockable =  '1' 
                              ORDER BY tb_master_product.product_name ASC");
          $number = 0;
          while ($data = mysqli_fetch_array($querySelectProduct)) {
                $number++;
                $product_code   = $data['product_code'];
                $product_name   = $data['product_name'];
                $buying_price   = $data['buying_price'];
                $margin         = $data['price_margin'];
                $product_stock  = $data['stockable'];
                $unit_description  = $data['unit_description'];
                $persen            = (($margin * $buying_price)/100);
                $jmlMargin = strlen($margin);

                if ($jmlMargin <= 2 || $margin == 100){
                  $selling_price = $persen + $buying_price;
                }
                else if ($jmlMargin > 2 || $margin != 100) {
                  $selling_price = $buying_price + $margin;        
                }

                if ($data['stock'] == 1) {
                    $stockable = "<span class='label label-success'><span class='fa fa-check'></span></span>";
                 }
                 elseif ($data['stock'] == 0) {
                    $stockable = "<span class='label label-danger'><span class='fa fa-times'></span></span>";
                 }
          ?>
            <tr id="selectProduct" style="cursor: pointer;" productCode="<?php echo $product_code ?>" productName="<?php echo $product_name; ?>" sellingPrice="<?php echo $selling_price; ?>">
                <td><?php echo $number ?></td>
                <td><?php echo $data['product_code']; ?></td>
                <td><?php echo $data['product_name']; ?></td>
                <td><?php echo number_format($data['product_stock']); ?></td>
                <td><?php echo $unit_description; ?></td>
                <td>Rp. <?php echo number_format(round($selling_price)); ?></td>
                <td><?php echo $stockable; ?></td>
            </tr>
          <?php } ?>
      </tbody>
    </table>
    <font color="orange"><i>*Double Klik di salah satu produk</i></font>
  </div>

<script type="text/javascript">
  $(document).on('click', '#selectProduct', function (e) {
      document.getElementById('c_selling_product_code').value = $(this).attr('productCode');
      document.getElementById('c_selling_product_name').value = $(this).attr('productName');    
      document.getElementById('c_selling_price').value = $(this).attr('sellingPrice'); 
      document.getElementById('c_selling_product_qty').value = 1;
      $('#listProduct').modal('hide');
      document.getElementById('c_selling_product_qty').focus();
  });            
  $(function () {
      $("#lookupProduct").dataTable();
  });

  // function sendDataProduct(){
  //   $('#listProduct').modal('hide');
  //   document.getElementById("c_selling_product_code").value = $('#list_product_code').val();
  //   document.getElementById("c_selling_product_name").value = $('#list_product_name').val();    
  //   document.getElementById("c_selling_price").value = $('#list_product_price').val();
  //   document.getElementById('c_selling_product_qty').focus();
  // }
  // $('#selectProduct').click(function(e){
  //   sendDataProduct();
  // });            

</script>