<div class="row">
  <div class="col-md-12">
    <h1 class="page-header">MASTER</h1>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <button data-toggle="modal" data-target='#insertFormProduct' id="buttonAdd" title="Tambah Data" class="btn btn-primary" data-backdrop="static" data-keyboard="false">
      <span class="fa fa-plus-circle"></span> Tambah
    </button>
    <button id="buttonRefresh" class="btn btn-success" title="Refresh">
      <span class="fa fa-refresh"></span> Aktif
    </button>
    <button id="showDataArchive" class="btn btn-default" title="Data Arsip">
      <span class="fa fa-archive"></span> Arsip
    </button>
    <button id="synchronButton" class="btn btn-warning" title="Sinkronkan Data Produk">
      <span id="syncProgress"> <i class="fa fa-toggle-on"></i> Sinkron</span>
    </button>
  </div>
</div>
<div class="clearfix"><br></div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title"><b id="headerProduct">Data Produk Aktif</b> 
        </h3>
      </div>
      <div class="panel-body" id="resultHandler"></div>
    </div>    
  </div>
</div>

<!-- INSERT -->
<div class="modal fade " id="insertFormProduct">
    <div class="modal-dialog">
        <div class="panel panel-primary" id="fetchDataInsert"></div>
    </div>
</div>

<!-- EDIT -->
<div class="modal fade" id="editFormProduct">
    <div class="modal-dialog">
        <div class="panel panel-primary" id="fetchDataEdit"></div>
    </div>
</div>

<!-- DETAIL -->
<div class="modal fade" id="detail">
    <div class="modal-dialog modal-lg">
        <div class="panel panel-primary" id="fetchDataDetail"></div>
    </div>
</div> 

<!-- DELETE -->
<div class="modal fade" id="deleteConfirm">
    <div class="modal-dialog">
        <div class="panel panel-primary">
            <div class="panel-heading">
              <b>Konfirmasi!</b>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="panel-body" id="fetchDataDelete"></div>
        </div>
    </div>
</div> 

<!-- Arsip -->
<div class="modal fade" id="archiveConfirm">
    <div class="modal-dialog">
        <div class="panel panel-primary">
            <div class="panel-heading">
              <b>Konfirmasi!</b>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="panel-body" id="fetchDataArchive"></div>
        </div>
    </div>
</div> 

<!-- Arsip -->
<div class="modal fade" id="restoreConfirm">
    <div class="modal-dialog">
        <div class="panel panel-primary">
            <div class="panel-heading">
              <b>Konfirmasi!</b>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="panel-body" id="fetchRestoreProgress"></div>
        </div>
    </div>
</div> 

<script type="text/javascript">

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
    $("#syncProgress").html("<center><img src='<?php echo $base_url.'assets/images/load.gif' ?>' width='20' height='20'/><i>sedang Proses</i></center>");
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
  $('#insertFormProduct').on('show.bs.modal', function (e) {
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
  $('#editFormProduct').on('show.bs.modal', function (e) {
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
  $('#restoreConfirm').on('show.bs.modal', function (e) {
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
  $('#archiveConfirm').on('show.bs.modal', function (e) {
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
      $("#deleteConfirm").modal('show');
      $.get('<?php echo $base_url."pages/master/product/confirm.php" ?>',
          {
            id:$(this).attr('data-id'),
            name:$(this).attr('data-name'),
            code:$(this).attr('data-code')
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
    $('#i_product_price_sell').val('');
    $('#i_product_price_buy').val('');
    $('#i_product_price_min').val('');
    $('#i_product_price_max').val('');
    $('#i_product_price_margin').val('');
    $('#i_product_first_stock').val('');
    $('#i_product_category').val('');
    $('#i_product_unit').val('');
    $('#i_product_name').focus();
  }

  function closeForm(){
    $('#insertFormProduct').modal('hide');
    $('#editFormProduct').modal('hide');
    $('#deleteConfirm').modal('hide');
    $('#restoreConfirm').modal('hide');
    $('#archiveConfirm').modal('hide');
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

</script>

<?php 
  // log Activity
  $insertLogData = log_insert('READ', 'Akses Menu Master Produk', $ip_address, $os, $browser);
  $queryInsertLogData = mysqli_query($config, $insertLogData);
  if (!$queryInsertLogData) {
    echo "<span class='alert alert-danger'>Error Query Insert Log</span>";
  }
?>