
<?php 
  include('../../../config/config.php');
?>
<div class="panel-heading">
    <b>Tambah Data</b>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="buttonClose">&times;</button>
</div>
<div class="panel-body">
  <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
    <div class="form-group" id="code">
      <label for="">Kode Produk</label>
      <div class="input-group">
      <input type="text" class="form-control" id="i_product_code" name="i_product_code" placeholder="Kode Produk" title="Kode Produk">
        <span class="input-group-addon" id="basic-addon2" title="Jika Ceklis Aktif maka kode otomatis">
            <input type="checkbox" name="auto_code" id="auto_code" checked="checked" value="1" onclick="autoCode(this.checked)">
            Auto
        </span>
      </div>
    </div>
  </div>
  <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
    <div class="form-group">
      <label for="">Nama Produk</label>
      <input type="text" class="form-control" id="i_product_name" name="i_product_name" placeholder="Nama Produk" title="Nama Produk">
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="form-group">
      <label for="">Deskripsi Produk</label>
      <input type="text" class="form-control" id="i_product_description" name="i_product_description" placeholder="Deskripsi Produk" title="Deskripsi Produk">
    </div>
  </div>
  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
    <div class="form-group">
      <label for="">Harga Beli</label>
      <input type="text" onkeyup="numberOnly(this); sumSellingPrice();" class="form-control" id="i_product_price_buy" name="i_product_price_buy" placeholder="Harga Beli" title="Harga Beli">
    </div>
  </div>
  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
    <div class="form-group">
      <label for="">Harga Min</label>
      <input type="text" onkeyup="numberOnly(this);" class="form-control" id="i_product_price_min" name="i_product_price_min" placeholder="Harga Minimal" title="Harga Minimal">
    </div>
  </div>
  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
    <div class="form-group">
      <label for="">Harga Max</label>
      <input type="text" onkeyup="numberOnly(this);" class="form-control" id="i_product_price_max" name="i_product_price_max" placeholder="Harga Maksimal" title="Harga Maksimal">
    </div>
  </div>
  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <div class="form-group">
      <label for="">Margin</label>
      <input type="text" onkeyup="numberOnly(this); sumSellingPrice();" class="form-control" id="i_product_price_margin" name="i_product_price_margin" placeholder="Margin" title="Margin">
    </div>
  </div>
  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <div class="form-group">
      <label for="">Harga Jual</label>
      <input type="text" onkeyup="numberOnly(this);" class="form-control" id="selling_price" name="selling_price" placeholder="Harga Jual" title="Harga Jual">
      <input type="hidden" class="form-control" id="i_product_price_sell" name="i_product_price_sell" placeholder="Harga Jual" title="Harga Jual">
    </div>
  </div>
  <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
    <div class="form-group">
      <label for="">Kategori</label>
      <select name="i_product_category" id="i_product_category" class="form-control" title="Kategori">
        <option value="">Pilih Kategori</option>
        <?php 
          $querySelectCategory = mysqli_query($config, "SELECT * FROM tb_master_category WHERE bl_state = 'A' AND outlet_code_relation = '$system_outlet_code' ORDER BY category_description ASC");
            while ($rowSelectCategory = mysqli_fetch_array($querySelectCategory)) {
              $category_code          = $rowSelectCategory['category_code'];
              $category_description   = $rowSelectCategory['category_description'];
        ?>
          <option value='<?php echo $category_code ?>'><?php echo $category_description; ?></option>";
        <?php } ?>
      </select>
    </div>
  </div>
  <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
    <div class="form-group">
      <label for="">Satuan</label>
      <select name="i_product_unit" id="i_product_unit" class="form-control" title="Satuan">
        <option value="">Pilih Satuan</option>
        <?php 
          $querySelectUnit = mysqli_query($config, "SELECT * FROM tb_master_unit WHERE bl_state = 'A' AND outlet_code_relation = '$system_outlet_code' ORDER BY unit_description ASC");
            while ($rowSelectUnit = mysqli_fetch_array($querySelectUnit)) {
              $unit_code          = $rowSelectUnit['unit_code'];
              $unit_description   = $rowSelectUnit['unit_description'];
        ?>
          <option value='<?php echo $unit_code ?>'><?php echo $unit_description; ?></option>";
        <?php } ?>
      </select>
    </div>
  </div>
  <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
    <div class="form-group">
      <label for=""></label>
      <div class="checkbox">
        <label>
          <input type="checkbox" name="i_product_stockable" id="i_product_stockable" checked="true">
          Stockable
        </label>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <legend></legend>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
      <div id="resultInsert"></div>
    </div>
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 text-right">
      <button type="submit" class="btn btn-primary" id="buttonInsertAgain">Simpan Dan Isi Lagi</button>
      <button type="submit" class="btn btn-primary" id="buttonInsert">Simpan</button>
      <button type="button" class="btn btn-default" id="buttonCancel" data-dismiss="modal">Batal</button>
    </div>
  </div>
</div>

<script type="text/javascript">
function autoCode(status){
  status = status;   
  document.getElementById('i_product_code').disabled = status;
  $('#i_product_code').focus();
}
  document.getElementById('i_product_code').disabled = true;
  $('#i_product_name').focus();
  // $('#i_product_code').focus();
  document.getElementById('selling_price').disabled = true;

    function sumSellingPrice(){
      var buying                = document.getElementById('i_product_price_buy').value;
      var margin                = document.getElementById('i_product_price_margin').value;
      var margins               = margin.length;
      var persen                = ((margin * buying)/100);
      var i_product_price_sell  = document.getElementById('i_product_price_sell');
      var selling_price         = document.getElementById('selling_price');

      if (margins <= 2 || margin == 100){
        result = parseInt(persen) + parseInt(buying);
      }
      else if (margins > 2 || margin != 100) {
        result = parseInt(buying) + parseInt(margin);        
      }
      if (!isNaN(result)) {
         i_product_price_sell.value = result;
         selling_price.value = result;
      }
    }

  // Save product
  function saveData(){
    var i_product_code          = $('#i_product_code').val();
    var i_product_name          = $('#i_product_name').val();
    var i_product_description   = $('#i_product_description').val();
    var i_product_price_min     = $('#i_product_price_min').val();
    var i_product_price_max     = $('#i_product_price_max').val();
    var i_product_price_margin  = $('#i_product_price_margin').val();
    var i_product_price_buy     = $('#i_product_price_buy').val();
    var i_product_price_sell    = $('#i_product_price_sell').val();
    var i_product_category      = $('#i_product_category').val();
    var i_product_unit          = $('#i_product_unit').val();


    var auto_code = [];
      $('#auto_code').each(function(){
        if($(this).is(":checked")){
         auto_code.push($(this).val());
        }
      });
     auto_code = auto_code.toString();

    var stockable = [];
      $('#i_product_stockable').each(function(){
        if($(this).is(":checked")){
         stockable.push($(this).val());
        }
      });
     stockable = stockable.toString();

    // Validation Form
    if ($('#auto_code').val() == '') {
      if ($('#i_product_code').val() == '') {
        $.notify("Kode Produk Tidak Boleh Kosong!", "error");
        $('#i_product_code').focus();
      }
    }else if ($('#i_product_name').val() == '') {
      $.notify("Nama Produk Harus Diisi!", "error");
      $('#i_product_name').focus();
    }else if ($('#i_product_description').val() == '') {
      $.notify("Deskripsi Produk Harus Diisi!", "error");
      $('#i_product_description').focus();
    }else if ($('#i_product_price_buy').val() == '') {
      $.notify("Harga Beli Tidak Boleh Kosong!", "error");
      $('#i_product_price_buy').focus();
    }else if ($('#i_product_price_min').val() == '') {
      $.notify("Minimal Harga Tidak Boleh Kosong!", "error");
      $('#i_product_price_min').focus();
    }else if ($('#i_product_price_max').val() == '') {
      $.notify("Maksimal Harga Tidak Boleh Kosong!", "error");
      $('#i_product_price_max').focus();
    }else if ($('#i_product_price_margin').val() == '') {
      $.notify("Margin Tidak Boleh Kosong!", "error");
      $('#i_product_price_margin').focus();
    }else if ($('#i_product_category').val() == '') {
      $.notify("Pilih Kategori Produk Dulu!", "error");
      $('#i_product_category').focus();
    }else if ($('#i_product_unit').val() == '') {
      $.notify("Satuan Belum Dipilih!", "error");
      $('#i_product_unit').focus();
    }else{
      // AJAX Insert
      disabledInsertForm();
      $("#resultInsert").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i></center>");
      $.ajax({
          type:"get",
          url:"<?php echo $base_url."pages/transaction/product/save.php" ?>",
          data:"auto_code="+auto_code+"&i_product_code="+i_product_code+"&i_product_name="+i_product_name+"&i_product_description="+i_product_description+"&i_product_price_buy="+i_product_price_buy+"&i_product_price_min="+i_product_price_min+"&i_product_price_max="+i_product_price_max+"&i_product_price_margin="+i_product_price_margin+"&i_product_price_sell="+i_product_price_sell+"&i_product_category="+i_product_category+"&i_product_unit="+i_product_unit+"&stockable="+stockable,
          success:function(data){
            $("#resultInsert").html(data);
          }
      });      
    }
  }

  // Save product
  function saveDataAgain(){
    var i_product_code          = $('#i_product_code').val();
    var i_product_name          = $('#i_product_name').val();
    var i_product_description   = $('#i_product_description').val();
    var i_product_price_min     = $('#i_product_price_min').val();
    var i_product_price_max     = $('#i_product_price_max').val();
    var i_product_price_margin  = $('#i_product_price_margin').val();
    var i_product_price_buy     = $('#i_product_price_buy').val();
    var i_product_price_sell    = $('#i_product_price_sell').val();
    var i_product_category      = $('#i_product_category').val();
    var i_product_unit          = $('#i_product_unit').val();


    var auto_code = [];
      $('#auto_code').each(function(){
        if($(this).is(":checked")){
         auto_code.push($(this).val());
        }
      });
     auto_code = auto_code.toString();

    var stockable = [];
      $('#i_product_stockable').each(function(){
        if($(this).is(":checked")){
         stockable.push($(this).val());
        }
      });
     stockable = stockable.toString();

    // Validation Form
    if ($('#auto_code').val() == '') {
      if ($('#i_product_code').val() == '') {
        $.notify("Kode Produk Tidak Boleh Kosong!", "error");
        $('#i_product_code').focus();
      }
    }else if ($('#i_product_name').val() == '') {
      $.notify("Nama Produk Harus Diisi!", "error");
      $('#i_product_name').focus();
    }else if ($('#i_product_description').val() == '') {
      $.notify("Deskripsi Produk Harus Diisi!", "error");
      $('#i_product_description').focus();
    }else if ($('#i_product_price_buy').val() == '') {
      $.notify("Harga Beli Tidak Boleh Kosong!", "error");
      $('#i_product_price_buy').focus();
    }else if ($('#i_product_price_min').val() == '') {
      $.notify("Minimal Harga Tidak Boleh Kosong!", "error");
      $('#i_product_price_min').focus();
    }else if ($('#i_product_price_max').val() == '') {
      $.notify("Maksimal Harga Tidak Boleh Kosong!", "error");
      $('#i_product_price_max').focus();
    }else if ($('#i_product_price_margin').val() == '') {
      $.notify("Margin Tidak Boleh Kosong!", "error");
      $('#i_product_price_margin').focus();
    }else if ($('#i_product_category').val() == '') {
      $.notify("Pilih Kategori Produk Dulu!", "error");
      $('#i_product_category').focus();
    }else if ($('#i_product_unit').val() == '') {
      $.notify("Satuan Belum Dipilih!", "error");
      $('#i_product_unit').focus();
    }else{
      // AJAX Insert
      disabledInsertForm();
      $("#resultInsert").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i></center>");
      $.ajax({
          type:"get",
          url:"<?php echo $base_url."pages/transaction/product/saveAgain.php" ?>",
          data:"auto_code="+auto_code+"&i_product_code="+i_product_code+"&i_product_name="+i_product_name+"&i_product_description="+i_product_description+"&i_product_price_buy="+i_product_price_buy+"&i_product_price_min="+i_product_price_min+"&i_product_price_max="+i_product_price_max+"&i_product_price_margin="+i_product_price_margin+"&i_product_price_sell="+i_product_price_sell+"&i_product_category="+i_product_category+"&i_product_unit="+i_product_unit+"&stockable="+stockable,
          success:function(data){
            $("#resultInsert").html(data);
          }
      });      
    }
  }
  $('#i_product_code').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_product_code').val() == '') {
        $.notify("Kode product Harus Di Isi!", "error");
        $('#i_product_code').focus();
      }else {$('#i_product_name').focus();}
    }
  });
  $('#i_product_name').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_product_name').val() == '') {
        $.notify("Nama product Harus Di Isi!", "error");
        $('#i_product_name').focus();
      }else {$('#i_product_description').focus();}
    }
  });$('#i_product_description').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_product_description').val() == '') {
        $.notify("Deskripsi product Harus Di Isi!", "error");
        $('#i_product_description').focus();
      }else {$('#i_product_price_buy').focus();}
    }
  });
  $('#i_product_price_buy').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_product_price_buy').val() == '') {
        $.notify("Harga Beli Tidak Boleh Kosong!", "error");
        $('#i_product_price_buy').focus();
      }else {$('#i_product_price_min').focus();}
    }
  });
  $('#i_product_price_min').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_product_price_min').val() == '') {
        $.notify("minimal Harga Tidak Boleh Kosong!", "error");
        $('#i_product_price_min').focus();
      }else {$('#i_product_price_max').focus();}
    }
  });
  $('#i_product_price_max').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_product_price_max').val() == '') {
        $.notify("Maksimal Harga Tidak Boleh Kosong!", "error");
        $('#i_product_price_max').focus();
      }else {$('#i_product_price_margin').focus();}
    }
  });
  $('#i_product_price_margin').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_product_price_margin').val() == '') {
        $.notify("Margin Tidak Boleh Kosong!", "error");
        $('#i_product_price_margin').focus();
      }else {$('#i_product_category').focus();}
    }
  });
  $('#i_product_category').change(function(e) {
    if ($('#i_product_category').val() == '') {
      $.notify("Kategori Produk Harus Dipilih!", "error");
      $('#i_product_category').focus();
    }else {$('#i_product_unit').focus();}
  });
  $('#i_product_unit').change(function(e) {
    if ($('#i_product_unit').val() == '') {
      $.notify("Satuan Produk Harus Dipilih!", "error");
      $('#i_product_unit').focus();
    }else {$('#i_product_stockable').focus();}
  });
  $('#i_product_stockable').keyup(function(e) {
    if(e.keyCode == 13) {
      {$('#buttonInsertAgain').focus();}
    }
  });
  $('#buttonInsert').click(function(e) {
    saveData();
  });
  $('#buttonInsertAgain').click(function(e) {
    saveDataAgain();
  });

  
  // INSERT HANDLER AJAX
  function clearInsertForm(){
    $('#i_product_code').val('');
    $('#i_product_name').val('');
    $('#i_product_description').val('');
    $('#i_product_price').val('');
    $('#selling_price').val('');
    $('#i_product_price_buy').val('');
    $('#i_product_price_min').val('');
    $('#i_product_price_max').val('');
    $('#i_product_price_margin').val('');
    $('#i_product_category').val('');
    $('#i_product_unit').val('');
    $('#i_product_stockable').val('');
    $('#i_product_name').focus();
  }

  function closeForm(){
    $('#insertProduct').modal('hide');
  }

  function enabledInsertForm(){
    document.getElementById('buttonInsertAgain').disabled = false;
    document.getElementById('buttonInsert').disabled = false;
    document.getElementById('buttonClose').disabled = false;
    document.getElementById('buttonCancel').disabled = false;
  }
  function disabledInsertForm(){
    document.getElementById('buttonInsert').disabled = true;
    document.getElementById('buttonClose').disabled = true;
    document.getElementById('buttonCancel').disabled = true;
  }

</script>