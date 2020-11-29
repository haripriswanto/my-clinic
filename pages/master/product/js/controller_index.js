  // INDEX
  
  $("#buttonRefresh").click(function(e) {
    loadData();
  });

  $("#showDataArchive").click(function(e) {
    loadDataArsip();
  });

  $('#synchronButton').on('click', function(e) {
    syncDataProduct();
  });

  // Syncronize
  function syncDataProduct(){
    disabledHeaderButton();
    $("#syncProgress").html("<center><img src='assets/images/load.gif' width='20' height='20'/><i>sedang Proses</i></center>");
    $('#syncProgress').load('<?php echo $base_url."pages/master/product/sync.php"?>');
  }


  // Load Data Customer
  function loadData(){
    disabledHeaderButton();
    $("#resultHandler").html("<center><img src='<?php echo $base_url.'assets/images/load.gif' ?>'  width='50' height='50'/><br><i>sedang Proses..</i></center>");
    $('#resultHandler').load('<?php echo $base_url."pages/master/product/read.php"?>');
  }
  
  // Load Data Customer
  function loadDataArsip(){
    disabledHeaderButton();
    $("#resultHandler").html("<center><img src='<?php echo $base_url.'assets/images/load.gif' ?>'  width='50' height='50'/><br><i>sedang Proses..</i></center>");
    $('#resultHandler').load('<?php echo $base_url."pages/master/product/archive/readArsip.php"?>');
  }
  
  loadData();

  function insertEffect() {$("#insert").show( 'clip', 800 );};

  $("#buttonAdd").click(function(event) {insertEffect();});

  //INSERT DATA 
  $('#insert').on('show.bs.modal', function (e) {
    $("#fetchDataInsert").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><br><i> Sedang Proses ...</i></center>");
    $.ajax({
      type : 'get',
      url : '<?php echo $base_url."pages/master/product/insert.php" ?>',
      success : function(data){
      $('#fetchDataInsert').html(data);//menampilkan data ke dalam modal
      }
    });
   });

  // EDIT DATA
  $('#edit').on('show.bs.modal', function (e) {
    var idEdit = $(e.relatedTarget).data('id'); 
    $("#fetchDataEdit").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><br><i> Sedang Proses ...</i></center>");
    $.ajax({
      type : 'get',
      url : '<?php echo $base_url."pages/master/product/edit.php" ?>',
      data :  'idEdit='+ idEdit,
      success : function(data){
      $('#fetchDataEdit').html(data); //menampilkan data ke dalam modal
      }
    });
   });

  // Restore DATA
  $('#restore').on('show.bs.modal', function (e) {
    var idRestore = $(e.relatedTarget).data('id');
    $("#fetchDataEdit").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><br><i> Sedang Proses ...</i></center>");
    $.ajax({
      type : 'get',
      url : '<?php echo $base_url."pages/master/product/archive/confirmRestore.php" ?>',
      data :  'idRestore='+ idRestore,
      success : function(data){
      $('#fetchRestoreProgress').html(data); //menampilkan data ke dalam modal
      }
    });
   });

  // Restore DATA
  $('#archive').on('show.bs.modal', function (e) {
    var idArchive = $(e.relatedTarget).data('id');
    $("#fetchDataEdit").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><br><i> Sedang Proses ...</i></center>");
    $.ajax({
      type : 'get',
      url : '<?php echo $base_url."pages/master/product/archive/confirmArchive.php" ?>',
      data :  'idArchive='+ idArchive,
      success : function(data){
      $('#fetchDataArchive').html(data); //menampilkan data ke dalam modal
      }
    });
   });

  //DELETE
  $(document).on('click','.buttonDelete',function(e){
      e.preventDefault();
      $("#delete").modal('show');
      $.get('<?php echo $base_url."pages/master/product/confirm.php" ?>',
          {
            id:$(this).attr('data-id'),
            name:$(this).attr('data-name')
          },
          function(html){
              $("#fetchDataDelete").html(html);
          }
      );
  });

  //DETAIL
  $('#detail').on('show.bs.modal', function (e) {
      var idDetail = $(e.relatedTarget).data('id');
      $("#fetchDataDetail").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><br><i> Sedang Proses ...</i></center>");
      $.ajax({
          type : 'get',
          url : '<?php echo $base_url."pages/master/product/detail.php" ?>',
          data :  'idDetail='+ idDetail,
          success : function(data){
          $('#fetchDataDetail').html(data);
          }
      });
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
    $('#i_product_name').focus();
  }

  function closeForm(){
    $('#insert').modal('hide');
    $('#edit').modal('hide');
    $('#delete').modal('hide');
    $('#restore').modal('hide');
    $('#archive').modal('hide');
  }

  function enabledInsertForm(){
    document.getElementById('buttonInsertAgain').disabled = false;
    document.getElementById('buttonInsert').disabled = false;
    document.getElementById('buttonClose').disabled = false;
    document.getElementById('buttonCancel').disabled = false;
  }
  function disabledInsertForm(){
    document.getElementById('buttonInsertAgain').disabled = true;
    document.getElementById('buttonInsert').disabled = true;
    document.getElementById('buttonClose').disabled = true;
    document.getElementById('buttonCancel').disabled = true;
  }
  function enabledUpdateForm(){
    document.getElementById('buttonUpdate').disabled = false;
    document.getElementById('buttonCloseUpdate').disabled = false;
    document.getElementById('buttonCancelUpdate').disabled = false;
  }
  function disabledUpdateForm(){
    document.getElementById('buttonUpdate').disabled = true;
    document.getElementById('buttonCloseUpdate').disabled = true;
    document.getElementById('buttonCancelUpdate').disabled = true;
  }
  function enabledHeaderButton(){
    document.getElementById('buttonAdd').disabled = false;
    document.getElementById('buttonRefresh').disabled = false;
    document.getElementById('showDataArchive').disabled = false;
    document.getElementById('synchronButton').disabled = false;
  }

  function disabledHeaderButton(){
    document.getElementById('buttonAdd').disabled = true;
    document.getElementById('buttonRefresh').disabled = true;
    document.getElementById('showDataArchive').disabled = true;
    document.getElementById('synchronButton').disabled = true;
  }