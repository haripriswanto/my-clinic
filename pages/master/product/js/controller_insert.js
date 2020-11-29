
  $(document).ready(function() {
    $("#info-margin").tooltip({
      show: {
        effect: "slideDown",
        delay: 10
      },
      hide: {
        effect: "drop",
        delay: 250
      }, position: {
          my: "left top",
          at: "left bottom"
        },
    });
  });

  function autoCode(status){
    status = status;   
    document.getElementById('i_product_code').disabled = status;
    $('#i_product_code').focus();
    $('#i_product_code').val('');
    $("#message").html("");
    enabledInsertForm();
  }

  document.getElementById('i_product_code').disabled = true;
  document.getElementById('selling_price').disabled = true;
  $('#i_product_name').focus();

  function checkCode() {
    var i_product_code  = $('#i_product_code').val().trim();
    if(i_product_code != ''){
        $('#message').html('<img src="<?php echo $base_url."assets/images/load.gif" ?>" width="15" height="15"/>');
        $.ajax({
            url: '<?php echo $base_url.'pages/master/product/codeCheck.php'; ?>',
            type: 'post',
            data: {i_product_code: i_product_code},
            success: function(response){
                $('#message').html(response);
             }
        });
    }else{
        $("#message").html("");
    }
  }

  function sumSellingPrice(){
    var buying                = $('#i_product_price_buy').val();
    var margin                = $('#i_product_price_margin').val();
    var min_price             = document.getElementById('i_product_price_min');
    var max_price             = document.getElementById('i_product_price_max');
    var i_product_price_sell  = document.getElementById('i_product_price_sell');
    var selling_price         = document.getElementById('selling_price');
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
        selling_price.value = result;
      }
    } else if (buying === '' || margin === '') {
      min_price.value = '';
      max_price.value = '';
      i_product_price_sell.value = '';
      selling_price.value = '';
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
    }else if ($('#i_product_first_stock').val() == '') {
      $.notify("Stok Awal Tidak Boleh Kosong!", "error");
      $('#i_product_first_stock').focus();
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
          url:"<?php echo $base_url."pages/master/product/saveAgain.php" ?>",
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
      }else {$('#i_product_price_margin').focus();}
    }
  });
  $('#i_product_price_margin').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_product_price_margin').val() == '') {
        $.notify("Margin Tidak Boleh Kosong!", "error");
        $('#i_product_price_margin').focus();
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
      }else {$('#i_product_first_stock').focus();}
    }
  });
  $('#i_product_first_stock').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_product_first_stock').val() == '') {
        $.notify("Margin Tidak Boleh Kosong!", "error");
        $('#i_product_first_stock').focus();
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

