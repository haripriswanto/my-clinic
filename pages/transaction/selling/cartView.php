<?php 
  include('../../../config/config.php');

  if (!empty($_SESSION['login'])) { 
?>

<!-- <div class="table-responsive"> -->
  <table class="table table-active table-hover" id="dataCart">
      <thead>
          <tr>
              <th width="3%">#</th>
              <th width="15%">Kode</th>
              <th>Nama Produk</th>
              <th width="10%">Qty</th>
              <th width="10%">Harga</th>
              <th width="10%">Subtotal</th>
              <th width="2%"></th>
          </tr>
      </thead>
      <tbody>
      <?php
      $selectDataCart = "SELECT * FROM tb_selling_cart 
                    INNER JOIN tb_master_stock 
                    ON tb_selling_cart.product_code_relation = tb_master_stock.product_code_relation
                    WHERE tb_selling_cart.user_name = '$sessionUser' 
                    AND tb_selling_cart.outlet_code_relation = '$system_outlet_code' 
                    AND tb_selling_cart.bl_state = 'A' ORDER BY tb_selling_cart.ts_insert ASC";
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
            disableFormCheckout();
          </script>
              <?php 
              }  
            else{ 
              echo "<script>enableFormCheckout();</script>";
              while ($rowSelectDataCart = mysqli_fetch_array($querySelectDataCart)){
                $number                 = $number+1;
                $product_code           = $rowSelectDataCart['product_code_relation'];
                $product_name           = $rowSelectDataCart['product_name'];
                $product_description    = $rowSelectDataCart['product_description'];
                $quantity               = $rowSelectDataCart['selling_qty'];
                $selling_price          = $rowSelectDataCart['selling_price'];
                $unit_description       = $rowSelectDataCart['unit_description'];
                $product_stock          = $rowSelectDataCart['product_stock'];
                $htu_code               = $rowSelectDataCart['how_to_use_code'];
                $htu_name               = $rowSelectDataCart['how_to_use'];

                // Subtotal
                $subtotal               = ($selling_price * $quantity);    
             ?>
             
                 <tr id="selectProductCart" 
                   style="cursor: pointer;" 
                   product_code="<?php echo $product_code ?>" 
                   product_name="<?php echo $product_name; ?>" 
                   quantity="<?php echo $quantity; ?>" 
                   selling_price="<?php echo $selling_price; ?>" 
                   htu_code="<?php echo $htu_code; ?>" 
                   htu_name="<?php echo $htu_name; ?>" 
                   title="Double Klik Untuk Data Produk : <?php echo $product_name ?>" 
                   data-toggle="tooltip" data-placement="bottom" 
                 >
                    <td><?php echo $number ?></td>
                    <td><?php echo $product_code ?></td>
                    <td><?php echo $product_name; if($htu_name!=''){ echo " [".$htu_name."]";}?></td>
                    <td><?php echo $quantity ?></td>
                    <td class="center"><?php echo number_format($selling_price); ?></td>
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
        <tr class="bg bg-info">
          <td colspan="7"><i style="font-size: 11px; color: #DB5E02">*Double Klik Di Salah Satu Item Untuk Edit</i></td>
        </tr>
  </tr>
  </table>

<script type="text/javascript">

    enabledFormCart();
    resultTotalSelling();
    $("#dataCart").dataTable();
    $('#buttonAddCart').html('<span class="fa fa-plus-circle" ></span> Tambah');

    // datepicker
    $( function() {
        $( ".datepicker" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            yearRange:"-10:+10"
          });
        }
    );

    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    });
    // CHECKOUT
    function actionCheckoutSelling(){
        var total_item_         = $('#total_item_').val();
        var total_harga_        = $('#total_harga_').val();
        var payment_type        = $('#payment_type').val();
        var transaction_date    = $('#transaction_date').val();
        var transaction_time    = $('#transaction_time').val();
        var money_paid          = $('#money_paid').val();
        // Supplier
        var supplier_code       = $('#supplier_code').val();
        var supplier_name       = $('#supplier_name').val();
        // Tambahan
        var transaction_date    = $('#transaction_date').val();
        var transaction_time    = $('#transaction_time').val();
        var cart_note           = $('#cart_note').val();

          // Progress Load
          disableButton();
          $("#resultCheckoutBuying").html("<img src='<?php echo $base_url ?>assets/images/load.gif' width='50' height='50'/><font size='2'>Sedang Proses...</font>");
          // Result
          $.ajax({
              type:"get",
              url:"<?php echo $base_url."pages/transaction/selling/transactionCheckout.php" ?>",
              data:'total_item_='+total_item_+'&total_harga_='+total_harga_+'&payment_type='+payment_type+'&transaction_date='+transaction_date+'&transaction_time='+transaction_time+'&cart_note='+cart_note+'&money_paid='+money_paid+'&supplier_code='+supplier_code+'&supplier_name='+supplier_name+'&transaction_date='+transaction_date+'&transaction_time='+transaction_time+'&cart_note='+cart_note+'&updatePrice='+updatePrice,
              success:function(data){
                $("#resultCheckoutBuying").html(data);
              }
          });
    }

    function disableButton(){
      document.getElementById('submitSellingCheckout').disabled = true;
      document.getElementById('cancelSellingCheckout').disabled = true;
    }
    function enableButton(){
      document.getElementById('submitSellingCheckout').disabled = false;
      document.getElementById('cancelSellingCheckout').disabled = false;
    }

    // $('#submitSellingCheckout').click(function(e){
    //   actionCheckoutSelling();
    // });

  $(document).on('dblclick', '#selectProductCart', function (e) {
      document.getElementById("c_selling_product_code").value = $(this).attr('product_code');
      document.getElementById("c_selling_product_name").value = $(this).attr('product_name');   
      document.getElementById("c_selling_product_qty").value = $(this).attr('quantity');    
      document.getElementById("c_selling_price").value = $(this).attr('selling_price');             
      document.getElementById("c_selling_HTU_code").value = $(this).attr('htu_code');             
      document.getElementById("c_selling_HTU").value = $(this).attr('htu_name');             
      document.getElementById('c_selling_product_qty').focus();
      $('#buttonAddCart').html('<span class="fa fa-pencil"></span> Update');
      $('#buttonCancel').html('<span class="fa fa-undo"></span> Batal');
      enabledFormCart();
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