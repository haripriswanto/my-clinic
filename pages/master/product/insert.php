
<?php 
  include('../../../config/config.php');
  if (!empty($_SESSION['login'])) {
?>
<div class="panel-heading">
    <b>Tambah Data</b>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="buttonClose">&times;</button>
</div>
<div class="panel-body">
  <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
    <div class="form-group" id="code">
      <label for="">Kode Produk <span id="message"></span></label>
      <div class="input-group">
      <input type="text" class="form-control tooltips" id="i_product_code" name="i_product_code" placeholder="Kode Produk" title="Kode Produk" onkeyup="checkCodeInsert();">
        <span class="input-group-addon tooltips checked" id="basic-addon2" title="Jika Ceklis Aktif maka kode otomatis">
            <input type="checkbox" name="auto_code" id="auto_code" checked="checked" value="1" onclick="autoCode(this.checked)">
            Auto
        </span>
        <!-- <div id="responseCode" ></div> -->
      </div>
    </div>
  </div>
  <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
    <div class="form-group">
      <label for="">Nama Produk</label>
      <input type="text" class="form-control tooltips" id="i_product_name" name="i_product_name" placeholder="Nama Produk" title="Nama Produk">
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="form-group">
      <label for="">Deskripsi Produk</label>
      <input type="text" class="form-control tooltips" id="i_product_description" name="i_product_description" placeholder="Deskripsi Produk" title="Deskripsi Produk">
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="">Harga Beli</label>
      <input type="text" onkeyup="numberOnly(this); sumSellingPrice();" class="form-control tooltips" id="i_product_price_buy" name="i_product_price_buy" placeholder="Harga Beli" title="Harga Beli">
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="">Margin <a href="#" class="tooltips"  title="(Margin <= 100) Menggunakan %, (Margin > 100) Menggunakan Rp."><i class="fa fa-exclamation-circle"></i></a></label>
      <input type="text" onkeyup="numberOnly(this); sumSellingPrice();" class="form-control tooltips" id="i_product_price_margin" name="i_product_price_margin" placeholder="Margin" title="Margin">
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="">Harga Jual</label>
      <!-- <input type="text" class="form-control tooltips" id="selling_price" name="selling_price" placeholder="Harga Jual" title="Harga Jual"> -->
      <input type="text" onkeyup="numberOnly(this); minSellingPrice();" class="form-control tooltips" id="i_product_price_sell" name="i_product_price_sell" placeholder="Harga Jual" title="Harga Jual">
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="">Harga Min</label>
      <input type="text" onkeyup="numberOnly(this);" class="form-control tooltips" id="i_product_price_min" name="i_product_price_min" placeholder="Harga Minimal" title="Harga Minimal">
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="">Harga Max</label>
      <input type="text" onkeyup="numberOnly(this);" class="form-control tooltips" id="i_product_price_max" name="i_product_price_max" placeholder="Harga Maksimal" title="Harga Maksimal">
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="">Stok Awal</label>
      <input type="text" onkeyup="numberOnly(this);" class="form-control tooltips" id="i_product_first_stock" name="i_product_first_stock" placeholder="Stok Awal" title="Stok awal akan menjadi stok awal produk">
    </div>
  </div>
  <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
    <div class="form-group">
      <label for="">Kategori</label>
      <select name="i_product_category" id="i_product_category" class="form-control tooltips" title="Pilih kategori">
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
      <select name="i_product_unit" id="i_product_unit" class="form-control tooltips" title="Pilih satuan">
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
      <div class="checkbox tooltips" title="Ceklis untuk cek stok pada saat penjualan">
        <label>
          <input type="checkbox" name="i_product_stockable" id="i_product_stockable" checked="true">
          Stockable
        </label>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <legend></legend>
    <div class="col-md-4">
      <div id="resultInsert"></div>
    </div>
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 text-right">
      <button type="submit" class="btn btn-primary buttonInsert tooltips" title="Klik untuk simpan dan clear form" id="buttonInsertAgain">Simpan Dan Isi Lagi</button>
      <button type="submit" class="btn btn-primary buttonInsert tooltips" title="Klik untuk simpan dan close form" id="buttonInsert">Simpan</button>
      <button type="button" class="btn btn-default tooltips" title="Klik untuk batal form" id="buttonCancel" data-dismiss="modal">Batal</button>
    </div>
  </div>
</div>

<script type="text/javascript">

  function autoCode(status){
    status = status;   
    document.getElementById('i_product_code').disabled = status;
    $('#i_product_code').focus();
    $('#i_product_code').val('');
    $("#message").html("");
    enabledInsertForm();
  }

  document.getElementById('i_product_code').disabled = true;
  // document.getElementById('selling_price').disabled = true;
  $('#i_product_name').focus();

  function checkCodeInsert() {
    var i_product_code      = $('#i_product_code').val().trim();
    var count_product_code  = $('#i_product_code').val();
    var countCode           = count_product_code.length;
    
    if(i_product_code != ''){
      if (countCode < 5) {
        disabledInsertForm();
        toastr['error']('Minimal kode 5 karakter');
        $('#i_product_code').focus();
      } else {
        $('#message').html('<img src="<?php echo $base_url."assets/images/load.gif" ?>" width="15" height="15"/>');
        $.ajax({
          url: '<?php echo $base_url.'pages/master/product/codeCheck.php'; ?>',
          type: 'post',
          data: {i_product_code: i_product_code},
          success: function(response){
            $('#message').html(response);
          }    
        });
      }
    }else{
        $("#message").html("");
    }
  }

  function minSellingPrice(){
    var buying                = $('#i_product_price_buy').val();
    var i_product_price_sell  = $('#i_product_price_sell').val();
    var margin                = document.getElementById('i_product_price_margin');
    var min_price             = document.getElementById('i_product_price_min');
    var max_price             = document.getElementById('i_product_price_max');

    result = parseInt(i_product_price_sell) - parseInt(buying);

    if (i_product_price_sell != '') {
      min_price.value = i_product_price_sell;
      max_price.value = i_product_price_sell;
      if (!isNaN(result)) {
        margin.value = result;
      }
    } else if (i_product_price_sell === '') {
      min_price.value = '';
      max_price.value = '';
      margin.value = '';
    }
  }

  function sumSellingPrice(){
    var buying                = $('#i_product_price_buy').val();
    var margin                = $('#i_product_price_margin').val();
    var min_price             = document.getElementById('i_product_price_min');
    var max_price             = document.getElementById('i_product_price_max');
    var i_product_price_sell  = document.getElementById('i_product_price_sell');
    var margins               = margin.length;
    var persen                = ((margin * buying)/100);

    if (margins <= 2 || margin == 100){
      result = parseInt(persen) + parseInt(buying);
    }
    else if (margins > 2 || margin != 100) {
      result = parseInt(buying) + parseInt(margin);        
    }

    if (buying != '' || margin != '') {
      min_price.value = buying;
      max_price.value = buying;
      if (!isNaN(result)) {
        i_product_price_sell.value = result;
      }
    } else if (buying === '' || margin === '') {
      min_price.value = '';
      max_price.value = '';
      i_product_price_sell.value = '';
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
    var i_product_first_stock   = $('#i_product_first_stock').val();
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
        toastr["error"]("Kode Produk Tidak Boleh Kosong!");
        $('#i_product_code').focus();
      }
    }else if ($('#i_product_name').val() == '') {
      toastr["error"]("Nama Produk Harus Diisi!");
      $('#i_product_name').focus();
    }else if ($('#i_product_description').val() == '') {
      toastr["error"]("Deskripsi Produk Harus Diisi!");
      $('#i_product_description').focus();
    }else if ($('#i_product_price_buy').val() == '') {
      toastr["error"]("Harga Beli Tidak Boleh Kosong!");
      $('#i_product_price_buy').focus();
    }else if ($('#i_product_price_min').val() == '') {
      toastr["error"]("Minimal Harga Tidak Boleh Kosong!");
      $('#i_product_price_min').focus();
    }else if ($('#i_product_price_max').val() == '') {
      toastr["error"]("Maksimal Harga Tidak Boleh Kosong!");
      $('#i_product_price_max').focus();
    }else if ($('#i_product_price_margin').val() == '') {
      toastr["error"]("Margin Tidak Boleh Kosong!");
      $('#i_product_price_margin').focus();
    }else if ($('#i_product_price_sell').val() == '') {
      toastr["error"]("Harga Jual Tidak Boleh Kosong!");
      $('#i_product_price_sell').focus();
    }else if ($('#i_product_first_stock').val() == '') {
      toastr["error"]("Stok Awal Tidak Boleh Kosong!");
      $('#i_product_first_stock').focus();
    }else if ($('#i_product_category').val() == '') {
      toastr["error"]("Pilih Kategori Produk Dulu!");
      $('#i_product_category').focus();
    }else if ($('#i_product_unit').val() == '') {
      toastr["error"]("Satuan Belum Dipilih!");
      $('#i_product_unit').focus();
    }else{
      // AJAX Insert
      disabledInsertForm();
      $("#resultInsert").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i></center>");
        $.ajax({
            type:"post",
            url:"<?php echo $base_url."pages/master/product/save.php" ?>",
            data:"auto_code="+auto_code+"&i_product_code="+i_product_code+"&i_product_name="+i_product_name+"&i_product_description="+i_product_description+"&i_product_price_buy="+i_product_price_buy+"&i_product_price_min="+i_product_price_min+"&i_product_price_max="+i_product_price_max+"&i_product_price_margin="+i_product_price_margin+"&i_product_price_sell="+i_product_price_sell+"&i_product_first_stock="+i_product_first_stock+"&i_product_category="+i_product_category+"&i_product_unit="+i_product_unit+"&stockable="+stockable,
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
    var i_product_first_stock   = $('#i_product_first_stock').val();
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
        toastr["error"]("Kode Produk Tidak Boleh Kosong!");
        $('#i_product_code').focus();
      }
    }else if ($('#i_product_name').val() == '') {
      toastr["error"]("Nama Produk Harus Diisi!");
      $('#i_product_name').focus();
    }else if ($('#i_product_description').val() == '') {
      toastr["error"]("Deskripsi Produk Harus Diisi!");
      $('#i_product_description').focus();
    }else if ($('#i_product_price_buy').val() == '') {
      toastr["error"]("Harga Beli Tidak Boleh Kosong!");
      $('#i_product_price_buy').focus();
    }else if ($('#i_product_price_min').val() == '') {
      toastr["error"]("Minimal Harga Tidak Boleh Kosong!");
      $('#i_product_price_min').focus();
    }else if ($('#i_product_price_max').val() == '') {
      toastr["error"]("Maksimal Harga Tidak Boleh Kosong!");
      $('#i_product_price_max').focus();
    }else if ($('#i_product_price_margin').val() == '') {
      toastr["error"]("Margin Tidak Boleh Kosong!");
      $('#i_product_price_margin').focus();
    }else if ($('#i_product_price_sell').val() == '') {
      toastr["error"]("Harga Jual Tidak Boleh Kosong!");
      $('#i_product_price_sell').focus();
    }else if ($('#i_product_first_stock').val() == '') {
      toastr["error"]("Stok Awal Tidak Boleh Kosong!");
      $('#i_product_first_stock').focus();
    }else if ($('#i_product_category').val() == '') {
      toastr["error"]("Pilih Kategori Produk Dulu!");
      $('#i_product_category').focus();
    }else if ($('#i_product_unit').val() == '') {
      toastr["error"]("Satuan Belum Dipilih!");
      $('#i_product_unit').focus();
    }else{
      // AJAX Insert
      disabledInsertForm();
      $("#resultInsert").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i></center>");
      $.ajax({
          type:"post",
          url:"<?php echo $base_url."pages/master/product/saveAgain.php" ?>",
            data:"auto_code="+auto_code+"&i_product_code="+i_product_code+"&i_product_name="+i_product_name+"&i_product_description="+i_product_description+"&i_product_price_buy="+i_product_price_buy+"&i_product_price_min="+i_product_price_min+"&i_product_price_max="+i_product_price_max+"&i_product_price_margin="+i_product_price_margin+"&i_product_price_sell="+i_product_price_sell+"&i_product_first_stock="+i_product_first_stock+"&i_product_category="+i_product_category+"&i_product_unit="+i_product_unit+"&stockable="+stockable,
          success:function(data){
            $("#resultInsert").html(data);
          }
      });      
    }
  }

  $('#i_product_code').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_product_code').val() == '') {
        toastr["error"]("Kode product Harus Di Isi!");
        $('#i_product_code').focus();
      }else {$('#i_product_name').focus();}
    }
  });
  $('#i_product_name').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_product_name').val() == '') {
        toastr["error"]("Nama product Harus Di Isi!");
        $('#i_product_name').focus();
      }else {$('#i_product_description').focus();}
    }
  });$('#i_product_description').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_product_description').val() == '') {
        toastr["error"]("Deskripsi product Harus Di Isi!");
        $('#i_product_description').focus();
      }else {$('#i_product_price_buy').focus();}
    }
  });
  $('#i_product_price_buy').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_product_price_buy').val() == '') {
        toastr["error"]("Harga Beli Tidak Boleh Kosong!");
        $('#i_product_price_buy').focus();
      }else {$('#i_product_price_margin').focus();}
    }
  });
  $('#i_product_price_margin').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_product_price_margin').val() == '') {
        toastr["error"]("Margin Tidak Boleh Kosong!");
        $('#i_product_price_margin').focus();
      }else {$('#i_product_price_sell').focus();}
    }
  });
  $('#i_product_price_sell').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_product_price_sell').val() == '') {
        toastr["error"]("Harga Jual Tidak Boleh Kosong!");
        $('#i_product_price_sell').focus();
      }else {$('#i_product_price_min').focus();}
    }
  });
  $('#i_product_price_min').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_product_price_min').val() == '') {
        toastr["error"]("minimal Harga Tidak Boleh Kosong!");
        $('#i_product_price_min').focus();
      }else {$('#i_product_price_max').focus();}
    }
  });
  $('#i_product_price_max').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_product_price_max').val() == '') {
        toastr["error"]("Maksimal Harga Tidak Boleh Kosong!");
        $('#i_product_price_max').focus();
      }else {$('#i_product_first_stock').focus();}
    }
  });
  $('#i_product_first_stock').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_product_first_stock').val() == '') {
        toastr["error"]("Margin Tidak Boleh Kosong!");
        $('#i_product_first_stock').focus();
      }else {$('#i_product_category').focus();}
    }
  });
  $('#i_product_category').change(function(e) {
    if ($('#i_product_category').val() == '') {
      toastr["error"]("Kategori Produk Harus Dipilih!");
      $('#i_product_category').focus();
    }else {$('#i_product_unit').focus();}
  });
  $('#i_product_unit').change(function(e) {
    if ($('#i_product_unit').val() == '') {
      toastr["error"]("Satuan Produk Harus Dipilih!");
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

  // tooltips();

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