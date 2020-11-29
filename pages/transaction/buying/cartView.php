<?php include('../../../config/config.php'); ?>

<div class="table-responsive">
  <table class="table table-active table-hover" id="dataCart">
      <thead>
          <tr>
              <th width="7%">#</th>
              <th width="15%">Kode</th>
              <th>Nama Produk</th>
              <th width="10%">Stok</th>
              <th width="10%">Qty</th>
              <th width="10%">Harga</th>
              <th width="10%">Subtotal</th>
              <th width="2%"></th>
          </tr>
      </thead>
      <tbody>
      <?php
      $selectDataCart = "SELECT * FROM tb_buying_cart 
                        INNER JOIN tb_master_stock 
                        ON tb_buying_cart.product_code_relation = tb_master_stock.product_code_relation
                        WHERE tb_buying_cart.user_name = '$sessionUser' 
                        AND tb_buying_cart.outlet_code_relation = '$system_outlet_code' 
                        AND tb_buying_cart.bl_state = 'A' ORDER BY tb_buying_cart.ts_insert ASC";
      // var_dump($selectDataCart);exit();
      $querySelectDataCart =  mysqli_query($config, $selectDataCart);
      $cekqty = mysqli_num_rows($querySelectDataCart);
      $number = 0;
      $total_item_ = 0;
      $total_harga_result = 0;
      if ($cekqty < 1) {
              ?>
          <tr>
              <td colspan="9">
                  <div class="alert alert-danger text-center">
                      <strong>Belum Ada Transaksi.</strong>
                  </div>
              </td>
          </tr>
          <script type="text/javascript">
              $(document).ready(function() {
                  enabledFormCart();
                  disableFormCheckout();
              });
          </script>
              <?php 
              }  
            else{ 
                  echo"<script>
                    enabledFormCart();
                    enableFormCheckout();
                  </script>";
              while ($rowSelectDataCart = mysqli_fetch_array($querySelectDataCart)){
                $number                 = $number+1;
                $product_code           = $rowSelectDataCart['product_code_relation'];
                $product_name           = $rowSelectDataCart['product_name'];
                $product_description    = $rowSelectDataCart['product_description'];
                $quantity               = $rowSelectDataCart['buying_qty'];
                $buying_price           = $rowSelectDataCart['buying_price'];
                $unit_description       = $rowSelectDataCart['unit_description'];
                $product_stock          = $rowSelectDataCart['product_stock'];
                $batch_code             = $rowSelectDataCart['batch_code'];
                // $exp_date               = $rowSelectDataCart['exp_date'];
                $exp_date               = date('d-m-Y', strtotime($rowSelectDataCart['exp_date']));
                // $selling_price  = $buying_price + $margin + $ppn - $discount;
                $subtotal = ($buying_price * $quantity);
                if ($exp_date == '01-01-1970') {
                  $exp_date = '00-00-0000';
                } else{
                  $exp_date = $exp_date;
                }

             ?>
             
                 <tr id="selectProductCart" style="cursor: pointer;" data-product-code="<?php echo $product_code ?>" data-product-name="<?php echo $product_name; ?>" data-product-qty="<?php echo $quantity; ?>" data-product-price="<?php echo $buying_price; ?>" data-product-exp="<?php echo $exp_date; ?>" data-batch-code="<?php echo $batch_code; ?>" title="Double Klik Untuk ubah Data Produk : <?php echo $product_name ?>" data-toggle="tooltip" data-placement="bottom" >
                    <td><?php echo $number ?></td>
                    <td><?php echo $product_code ?></td>
                    <td><?php echo $product_name;?></td>
                    <td><?php if($product_stock == ''){echo "0";}else{echo $product_stock;} ?></td>
                    <td><?php echo $quantity ?></td>
                    <td class="center"><?php echo number_format($buying_price); ?></td>
                    <td class="center"><?php echo number_format($subtotal) ?></td>
                    <?php 
                      $total_item_ = $total_item_ + $quantity;
                      $total_harga_result = $total_harga_result + $subtotal ;
                    ?>
                    <td class="center">
                      <a data-toggle="modal" data-target='#deleteDataCart' data-id="<?php echo $product_code ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus Item <?php echo $product_name ?>" id="buttonDeleteItem"><i class="fa fa-times"></i></a>
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
  $("#dataCart").dataTable();
  $('#total_item_').html('<font size="6"><b>' + formatNumber(<?= $total_item_ ?>) + '</b></font>');
  $('.total_harga_result').html('<font size="6"><b>Rp. ' + formatNumber(<?= $total_harga_result ?>) + '</b></font>');

</script>