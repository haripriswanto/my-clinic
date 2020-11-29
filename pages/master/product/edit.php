
<?php 
  include('../../../config/config.php'); 

if (!empty($_SESSION['login'])) {

  $idEdit = $_GET['idEdit'];
  $querySelectData =  mysqli_query($config, "SELECT * 
    FROM tb_master_product
    WHERE tb_master_product.id_product = '$idEdit' AND tb_master_product.bl_state = 'A' AND tb_master_product.outlet_code_relation = '$system_outlet_code'");
    while($rowSelectData = mysqli_fetch_array($querySelectData)){
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
      $unit_code_relation     = $rowSelectData['unit_code_relation'];
      $stockable              = $rowSelectData['stockable'];
      $outlet_code_relation   = $rowSelectData['outlet_code_relation'];
      $ts_insert              = $rowSelectData['ts_insert'];
      $ts_update              = $rowSelectData['ts_update'];
      $bl_state               = $rowSelectData['bl_state'];
    }
?>

<div class="panel-heading">
    <b>Ubah Data "<?php echo $product_name ?>"</b>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="buttonCloseUpdate">&times;</button>
</div>
<div class="panel-body">
  <div class="col-md-4">
    <div class="form-group">
      <label for="">Kode Produk <span id="message"></span></label>
      <input type="hidden" class="form-control" id="e_id_product" name="e_id_product" placeholder="Kode Produk" title="Kode Produk" value="<?php echo $id_product ?>">
      <input type="text" class="form-control" id="e_product_code" name="e_product_code" placeholder="Kode Produk" title="Kode Produk" value="<?php echo $product_code ?>" onkeyup="checkCodeEdit();">
    </div>
  </div>
  <div class="col-md-8">
    <div class="form-group">
      <label for="">Nama Produk</label>
      <input type="text" class="form-control" id="e_product_name" name="e_product_name" placeholder="Nama Produk" title="Nama Produk" value="<?php echo $product_name ?>">
    </div>
  </div>
  <div class="col-md-12">
    <div class="form-group">
      <label for="">Deskripsi Produk</label>
      <input type="text" class="form-control" id="e_product_description" name="e_product_description" placeholder="Deskripsi Produk" title="Deskripsi Produk" value="<?php echo $product_description ?>">
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="">Harga Beli</label>
      <input type="text" onkeyup="numberOnly(this); sumSellingPrice();" class="form-control" id="e_product_price_buy" name="e_product_price_buy" placeholder="Harga Beli" title="Harga Beli" value="<?php echo $buying_price ?>">
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="">Margin <a href="#" id="info-margin"><i class="fa fa-exclamation-circle info-margin"  title="(Margin <= 100) Menggunakan %, (Margin > 100) Menggunakan Rp."></i></a></label>
      <input type="text" onkeyup="numberOnly(this); sumSellingPrice();" class="form-control" id="e_product_price_margin" name="e_product_price_margin" placeholder="Margin" title="Margin" value="<?php echo $price_margin ?>">
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="">Harga Jual</label>
      <!-- <input type="text" class="form-control" id="e_selling_price" name="e_selling_price" placeholder="Harga Jual" title="Harga Jual" value="<?php echo $selling_price ?>"> -->
      <input type="text" class="form-control" onkeyup="numberOnly(this); minSellingPrice();" id="e_product_price_sell" name="e_product_price_sell" placeholder="Harga Jual" title="Harga Jual" value="<?php echo $selling_price ?>">
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label for="">Harga Min</label>
      <input type="text" onkeyup="numberOnly(this);" class="form-control" id="e_product_price_min" name="e_product_price_min" placeholder="Harga Minimal" title="Harga Minimal" value="<?php echo $price_min ?>">
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label for="">Harga Max</label>
      <input type="text" onkeyup="numberOnly(this);" class="form-control" id="e_product_price_max" name="e_product_price_max" placeholder="Harga Maksimal" title="Harga Maksimal" value="<?php echo $price_max ?>">
    </div>
  </div>
  
  <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
    <div class="form-group">
      <label for="">Kategori</label>
      <select name="e_product_category" id="e_product_category" class="form-control" title="Kategori">
        <option value="">Pilih Kategori</option>
        <?php 
          $querySelectCategory = mysqli_query($config, "SELECT * FROM tb_master_category WHERE bl_state = 'A' AND outlet_code_relation = '$system_outlet_code' ORDER BY category_description ASC");
            while ($rowSelectCategory = mysqli_fetch_array($querySelectCategory)) {
              $category_code          = $rowSelectCategory['category_code'];
              $category_description   = $rowSelectCategory['category_description'];
        ?>
          <option value='<?php echo $category_code ?>' <?php if($category_code == $category_code_relation){echo "SELECTED";} ?>><?php echo $category_description; ?></option>";
        <?php } ?>
      </select>
    </div>
  </div>
  <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
    <div class="form-group">
      <label for="">Satuan</label>
      <select name="e_product_unit" id="e_product_unit" class="form-control" title="Satuan">
        <option value="">Pilih Satuan</option>
        <?php 
          $querySelectUnit = mysqli_query($config, "SELECT * FROM tb_master_unit WHERE bl_state = 'A' AND outlet_code_relation = '$system_outlet_code' ORDER BY unit_description ASC");
            while ($rowSelectUnit = mysqli_fetch_array($querySelectUnit)) {
              $unit_code          = $rowSelectUnit['unit_code'];
              $unit_description   = $rowSelectUnit['unit_description'];
        ?>
          <option value='<?php echo $unit_code ?>' <?php if($unit_code == $unit_code_relation){echo "SELECTED";} ?>><?php echo $unit_description; ?></option>";
        <?php } ?>
      </select>
    </div>
  </div>
  <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
    <div class="form-group">
      <label for=""></label>
      <div class="checkbox">
        <label>
          <input type="checkbox" name="e_product_stockable" id="e_product_stockable" value="<?php echo $stockable ?>" <?php echo $stockable == 1 ? "CHECKED='CHECKED'" : ''; ?> >
          Stockable
        </label>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <legend></legend>
    <div class="col-md-8">
      <div id="resultUpdate"></div>
    </div>
    <div class="col-md-4 text-right">
      <button type="submit" class="btn btn-primary" id="buttonUpdate">Simpan</button>
      <button type="button" class="btn btn-default" id="buttonCancelUpdate" data-dismiss="modal">Batal</button>
    </div>
  </div>
</div>

<script type="text/javascript">

   $(document).ready(function() {
    $("#info-margin").tooltip({
      show: {
        effect: "slideDown",
        delay: 5
      },
      hide: {
        effect: "clip",
        delay: 250
      }, position: {
          my: "left top",
          at: "left bottom"
        },
    });
  });

  function checkCodeEdit() {
    var e_product_code  = $('#e_product_code').val().trim();
    var e_id_product    = $('#e_id_product').val();
    var countCode       = e_product_code.length;
    
    if(e_product_code != ''){
      if (countCode < 5) {
        disabledInsertForm();
        toastr['error']('Minimal kode 5 karakter');
        $('#e_product_code').focus();
      } else {
        $('#message').html('<img src="<?php echo $base_url."assets/images/load.gif" ?>" width="15" height="15"/>');
        $.ajax({
          url: '<?php echo $base_url.'pages/master/product/codeCheck.php'; ?>',
          type: 'post',
          data: {e_product_code: e_product_code, e_id_product: e_id_product},
          success: function(response){
            $('#message').html(response);
          }    
        });
      }
    }else{
        $("#message").html("");
    }
  }

  $('#e_product_code').focus();
  // document.getElementById('e_product_price_sell').disabled = true;

  $(document).ready(function() {
    sumSellingPrice();
  });

  
  function minSellingPrice(){
    var buying                = $('#e_product_price_buy').val();
    var e_product_price_sell  = $('#e_product_price_sell').val();
    var margin                = document.getElementById('e_product_price_margin');
    var min_price             = document.getElementById('e_product_price_min');
    var max_price             = document.getElementById('e_product_price_max');

      result = parseInt(e_product_price_sell) - parseInt(buying);

    if (e_product_price_sell != '') {
      min_price.value = e_product_price_sell;
      max_price.value = e_product_price_sell;
      if (!isNaN(result)) {
        margin.value = result;
      }
    } else if (e_product_price_sell === '') {
      min_price.value = '';
      max_price.value = '';
      margin.value = '';
    }
  }

  function sumSellingPrice(){
    var buying                = document.getElementById('e_product_price_buy').value;
    var margin                = document.getElementById('e_product_price_margin').value;
    var margins               = margin.length;
    var persen                = ((margin * buying)/100);
    // var e_product_price_sell  = document.getElementById('e_product_price_sell');
    var selling_price         = document.getElementById('e_product_price_sell');

    if (margins <= 2 || margin == 100){
      result = parseInt(persen) + parseInt(buying);
    }
    else if (margins > 2 || margin != 100) {
      result = parseInt(buying) + parseInt(margin);        
    }
    if (!isNaN(result)) {
       e_product_price_sell.value = result;
       selling_price.value = result;
    }
  }

  // Save e_product
  function updateData(){
    var e_id_product            = $('#e_id_product').val();
    var e_product_code          = $('#e_product_code').val();
    var e_product_name          = $('#e_product_name').val();
    var e_product_description   = $('#e_product_description').val();
    var e_product_price_min     = $('#e_product_price_min').val();
    var e_product_price_max     = $('#e_product_price_max').val();
    var e_product_price_margin  = $('#e_product_price_margin').val();
    var e_product_price_buy     = $('#e_product_price_buy').val();
    var e_product_price_sell    = $('#e_product_price_sell').val();
    var e_product_category      = $('#e_product_category').val();
    var e_product_unit          = $('#e_product_unit').val();
    // var e_product_stockable     = $('#e_product_stockable').val();

    var stockable = [];
      $('#e_product_stockable').each(function(){
        if($(this).is(":checked")){
         stockable.push($(this).val());
        }
      });
     stockable = stockable.toString();

    // Validation Form
    if ($('#e_product_code').val() == '') {
      toastr['error']("Kode Produk Harus Diisi!");
      $('#e_product_code').focus();
    }else if ($('#e_product_name').val() == '') {
      toastr['error']("Nama Produk Harus Diisi!");
      $('#e_product_name').focus();
    }else if ($('#e_product_description').val() == '') {
      toastr['error']("Deskripsi Produk Harus Diisi!");
      $('#e_product_description').focus();
    }else if ($('#e_product_price_buy').val() == '') {
      toastr['error']("Harg Beli Tidak Boleh Kosong!");
      $('#e_product_price_buy').focus();
    }else if ($('#e_product_price_margin').val() == '') {
      toastr['error']("Margin Tidak Boleh Kosong!");
      $('#e_product_price_margin').focus();
    }else if ($('#e_product_price_selling').val() == '') {
      toastr['error']("Harga Jual Tidak Boleh Kosong!");
      $('#e_product_price_selling').focus();
    }else if ($('#e_product_price_min').val() == '') {
      toastr['error']("Minimal Harga Tidak Boleh Kosong!");
      $('#e_product_price_min').focus();
    }else if ($('#e_product_price_max').val() == '') {
      toastr['error']("Maksimal Harga Tidak Boleh Kosong!");
      $('#e_product_price_max').focus();
    }else if ($('#e_product_category').val() == '') {
      toastr['error']("Pilih Kategori Produk Dulu!");
      $('#e_product_category').focus();
    }else if ($('#e_product_unit').val() == '') {
      toastr['error']("Satuan Belum Dipilih!");
      $('#e_product_unit').focus();
      
    }else{
      // AJAX Insert
      disabledUpdateForm();
      $("#resultUpdate").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i></center>");
      $.ajax({
          type:"get",
          url:"<?php echo $base_url."pages/master/product/update.php" ?>",
          data:"e_id_product="+e_id_product+"&e_product_code="+e_product_code+"&e_product_name="+e_product_name+"&e_product_description="+e_product_description+"&e_product_price_min="+e_product_price_min+"&e_product_price_max="+e_product_price_max+"&e_product_price_margin="+e_product_price_margin+"&e_product_price_buy="+e_product_price_buy+"&e_product_price_sell="+e_product_price_sell+"&e_product_category="+e_product_category+"&e_product_unit="+e_product_unit+"&stockable="+stockable,
          success:function(data){
            $("#resultUpdate").html(data);
          }
      });      
    }
  }

  $('#e_product_code').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#e_product_code').val() == '') {
        toastr['error']("Kode product Harus Di Isi!");
        $('#e_product_code').focus();
      }else {$('#e_product_name').focus();}
    }
  });
  $('#e_product_name').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#e_product_name').val() == '') {
        toastr['error']("Nama product Harus Di Isi!");
        $('#e_product_name').focus();
      }else {$('#e_product_description').focus();}
    }
  });
  $('#e_product_description').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#e_product_description').val() == '') {
        toastr['error']("Deskripsi product Harus Di Isi!");
        $('#e_product_description').focus();
      }else {$('#e_product_price_buy').focus();}
    }
  });
  $('#e_product_price_buy').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#e_product_price_buy').val() == '') {
        toastr['error']("Harga Beli Harus Di Isi!");
        $('#e_product_price_buy').focus();
      }else {$('#e_product_price_margin').focus();}
    }
  });
  $('#e_product_price_margin').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#e_product_price_margin').val() == '') {
        toastr['error']("Margin Tidak Boleh Kosong!");
        $('#e_product_price_margin').focus();
      }else {$('#e_product_price_selling').focus();}
    }
  });
  $('#e_product_price_selling').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#e_product_price_selling').val() == '') {
        toastr['error']("Margin Tidak Boleh Kosong!");
        $('#e_product_price_selling').focus();
      }else {$('#e_product_price_min').focus();}
    }
  });
  $('#e_product_price_min').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#e_product_price_min').val() == '') {
        toastr['error']("minimal Harga Tidak Boleh Kosong!");
        $('#e_product_price_min').focus();
      }else {$('#e_product_price_max').focus();}
    }
  });
  $('#e_product_price_max').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#e_product_price_max').val() == '') {
        toastr['error']("Maksimal Harga Tidak Boleh Kosong!");
        $('#e_product_price_max').focus();
      }else {$('#e_product_category').focus();}
    }
  });
  $('#e_product_category').change(function(e) {
    if ($('#e_product_category').val() == '') {
      toastr['error']("Kategori Produk Harus Dipilih!");
      $('#e_product_category').focus();
    }else {$('#e_product_unit').focus();}
  });
  $('#e_product_unit').change(function(e) {
    if ($('#e_product_unit').val() == '') {
      toastr['error']("Satuan Produk Harus Dipilih!");
      $('#e_product_unit').focus();
    }else {$('#e_product_stockable').focus();}
  });
  $('#e_product_stockable').keyup(function(e) {
    if(e.keyCode == 13) {
      {$('#buttonUpdate').focus();}
    }
  });
  $('#buttonUpdate').click(function(e) {
    updateData();
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