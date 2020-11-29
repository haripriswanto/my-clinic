<?php include('../../../config/config.php'); ?>

<div class="table-responsive">
  <table class="table table-active table-hover" id="listPatients">
      <thead>
          <tr>
              <th>#</th>
              <th>MR</th>
              <th>Nama Pasien</th>
              <th>Umur</th>
              <th>Department</th>
              <th>Tgl Masuk</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody>
      <?php
      $selectlistPatients = "SELECT * FROM tb_master_patient ORDER BY tb_master_patient.ts_insert ASC";
      // var_dump($selectlistPatients);exit();
      $querySelectlistPatients =  mysqli_query($config, $selectlistPatients);
      $cekqty = mysqli_num_rows($querySelectlistPatients);
      $number = 0;
      $total_item_ = 0;
      $total_harga_result = 0;
      if ($cekqty < 1) {
              ?>
          <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
          </tr>
              <?php 
              }  
            else{ 
              while ($rowSelectlistPatients = mysqli_fetch_array($querySelectlistPatients)){
                $number                 = $number+1;
                $product_code           = $rowSelectlistPatients['product_code_relation'];
                $product_name           = $rowSelectlistPatients['product_name'];
                $product_description    = $rowSelectlistPatients['product_description'];
                $quantity               = $rowSelectlistPatients['buying_qty'];
                $buying_price           = $rowSelectlistPatients['buying_price'];
                $unit_description       = $rowSelectlistPatients['unit_description'];
                $product_stock          = $rowSelectlistPatients['product_stock'];
                $batch_code             = $rowSelectlistPatients['batch_code'];
                $exp_date               = date('d-m-Y', strtotime($rowSelectlistPatients['exp_date']));

             ?>
             
                 <tr id="selectProductCart" style="cursor: pointer;" data-product-code="<?php echo $product_code ?>" data-product-name="<?php echo $product_name; ?>" data-product-qty="<?php echo $quantity; ?>" data-product-price="<?php echo $buying_price; ?>" data-product-exp="<?php echo $exp_date; ?>" data-batch-code="<?php echo $batch_code; ?>" title="Double Klik Untuk ubah Data Produk : <?php echo $product_name ?>" data-toggle="tooltip" data-placement="bottom" >
                    <td><?php echo $number ?></td>
                    <td><?php echo $product_code ?></td>
                    <td><?php echo $product_name;?></td>
                    <td><?php if($product_stock == ''){echo "0";}else{echo $product_stock;} ?></td>
                    <td><?php echo $quantity ?></td>
                    <td class="center"><?php echo number_format($buying_price); ?></td>
                    <td class="center">
                      <a data-toggle="modal" data-target='#deletelistPatients' data-id="<?php echo $product_code ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus Item <?php echo $product_name ?>" id="buttonDeleteItem"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
            <?php 
                 }                                     
            } 
            ?>
        </tbody>
        <input type="hidden" name="total_harga_" id="total_harga_" value="<?php echo $total_harga_result ?>">
        <input type="hidden" name="total_item_" id="total_item_" value="<?php echo $total_item_ ?>" >
  </table>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $("#listPatients").dataTable();
  });
</script>