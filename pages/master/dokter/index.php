<div class="row">
  <div class="col">
    <h1 class="page-header">MASTER <span id="headerPage"></span></h1>
  </div>
</div>

<div class="row">
  <div class="col">
    <a data-toggle="modal" href='#insert' id="buttonAdd" title="Tambah Data" class="btn btn-primary">
      <span class="fa fa-plus-circle"></span> Tambah
    </a>
    <a id="buttonRefresh" class="btn btn-default">
      <span class="fa fa-refresh"></span>
    </a>
  </div>
</div>

<div class="clearfix"><br></div>
<div class="row">
  <div class="col">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title"><b>DATA DOKTER</b> </h3>
      </div>
      <div class="panel-body" id="resultHandler"></div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var panelTitle = $('.panel-title').html();
  $('#headerPage').html('');
</script>

<!-- INSERT -->
<div class="modal fade" id="insert">
    <div class="modal-dialog modal-lg">
        <div class="panel panel-primary" id="fetchDataInsert">
        </div>
    </div>
</div>

<!-- EDIT -->
<div class="modal fade" id="edit">
    <div class="modal-dialog modal-lg">
        <div class="panel panel-primary" id="fetchDataEdit">
        </div>
    </div>
</div>

<!-- DELETE -->
<div class="modal fade" id="delete">
    <div class="modal-dialog modal-lg">
        <div class="panel panel-primary">
            <div class="panel-heading">
              <b>Konfirmasi!</b>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="panel-body" id="fetchDataDelete"></div>
        </div>
    </div>
</div> 

<!-- DETAIL -->
<div class="modal fade" id="detail">
    <div class="modal-dialog modal-lg">
        <div class="panel panel-primary" id="fetchDataDetail">
        </div>
    </div>
</div> 

<script type="text/javascript">

  function insertEffect() {$("#insert").show( 'clip', 800 );};
  function editEffect() {$("#edit").show( 'clip', 800 );};
  function deleteEffect() {$("#delete").show( 'clip', 800 );};
  function detailEffect() {$("#detail").show( 'clip', 800 );};

  $("#buttonAdd").click(function(event) {insertEffect();});
  $("#buttonEdit").click(function(event) {editEffect();});
  $("#buttonDelete").click(function(event) {deleteEffect();});
  $("#buttonDetail").click(function(event) {detailEffect();});

    loadData();

  //INSERT DATA 
  $('#insert').on('show.bs.modal', function (e) {
      $("#fetchDataInsert").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><br><i> Sedang Proses ...</i></center>");
      $.ajax({
        type : 'get',
        url : '<?php echo $base_url."pages/master/dokter/insert.php" ?>',
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
        url : '<?php echo $base_url."pages/master/dokter/edit.php" ?>',
        data :  'idEdit='+ idEdit,
        success : function(data){
        $('#fetchDataEdit').html(data); //menampilkan data ke dalam modal
        }
      });
   });

  //DELETE
    $('#delete').on('show.bs.modal', function (e) {
        var idDelete = $(e.relatedTarget).data('id');
        $("#fetchDataDelete").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><br><i> Sedang Proses ...</i></center>");
        $.ajax({
          type : 'get',
          url : '<?php echo $base_url."pages/master/dokter/confirm.php" ?>',
          data :  'idDelete='+idDelete,
          success : function(data){
          $('#fetchDataDelete').html(data);
          }
        });
     });

  //DELETE
    $('#detail').on('show.bs.modal', function (e) {
        var idDetail = $(e.relatedTarget).data('id');
        $("#fetchDataDetail").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><br><i> Sedang Proses ...</i></center>");
        $.ajax({
            type : 'get',
            url : '<?php echo $base_url."pages/master/dokter/detail.php" ?>',
            data :  'idDetail='+ idDetail,
            success : function(data){
            $('#fetchDataDetail').html(data);
            }
        });
     });

  $("#buttonRefresh").click(function(e) {
    loadData();
  });

  // Load Data Customer
  function loadData(){
    $("#resultHandler").html("<center><img src='<?php echo $base_url.'assets/images/load.gif' ?>'  width='50' height='50'/><br><i>sedang Proses..</i></center>");
    $('#resultHandler').load('<?php echo $base_url."pages/master/dokter/read.php"?>');
  }
  // INSERT HANDLER AJAX
  function clearInsertForm(){
    $('#dokter_code').val('');
    $('#dokter_type').val('');
    $('#dokter_name').val('');
    $('#dokter_address').val('');
    $('#dokter_email').val('');
    $('#dokter_phone').val('');
    $('#dokter_website').val('');
    $('#dokter_name').focus();
  }

  function closeForm(){
    $('#insert').modal('hide');
    $('#edit').modal('hide');
    $('#delete').modal('hide');
  }

</script>


<?php 
  // insert Log Activity
  $insertLogData = log_insert('READ', 'Akses Menu Data Penanggung Jawab / Dokter', $ip_address, $os, $browser);
  $queryInsertLogData = mysqli_query($config, $insertLogData);
?>