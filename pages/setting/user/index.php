<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Pengelolaan User</h1>
    </div>
</div>

<div class="row">
  <div class="col-md-12">
    <a data-toggle="modal" href='#insertFormUser' id="buttonAdd" title="Tambah Data User" class="btn btn-primary">
      <span class="fa fa-plus-circle"></span> Tambah
    </a>
    <a id="buttonRefresh" title="Refresh" class="btn btn-default">
      <span class="fa fa-refresh"></span>
    </a>
  </div>
</div>
<div class="clearfix"><br></div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title"><b>DATA USER</b> 
        </h3>
      </div>
      <div class="panel-body" id="fetchDataUser"></div>
    </div>
  </div>
</div>

<!-- INSERT user -->
<div class="modal fade" id="insertFormUser">
    <div class="modal-dialog">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <b>Form Tambah Data</b>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="panel-body" id="fetchFormInsert"></div>
        </div>
    </div>
</div>

<!-- EDIT user -->
<div class="modal fade" id="editFormUser">
    <div class="modal-dialog">
        <div class="panel panel-primary" id="fetchFormEdit">
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="deleteConfirmUser">
    <div class="modal-dialog">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <b>Konfirmasi!</b>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="panel-body" id="fetchDeleteConfirm"></div>
        </div>
    </div>
</div> 

<script type="text/javascript">

  function insertEffect() {
    $("#insert").show( 'clip', 800 );
  };

  $("#buttonAdd").click(function(event) {
    insertEffect();
  });


function loadDataUser(){
  $("#fetchDataUser").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><i> Sedang Proses ...</i></center>");
  $("#fetchDataUser").load('<?php echo $base_url."pages/setting/user/read.php" ?>');
}

$(document).ready(function() {
  loadDataUser();
});

function closeForm(){
  $('#editFormUser').modal('hide');
  $('#insertFormUser').modal('hide');
  $('#deleteConfirmUser').modal('hide');
}

// Clear Form
function clearForm(){
  $("#insert_title").val('');
  $("#insert_header").val('');
  $("#insert_dashboard").val('');
  $("#insert_instansi_name").val('');
  $("#insert_owner").val('');
  $("#insert_phone").val('');
  $("#insert_address").val('');
  $("#insert_email").val('');
  $("#insert_url").val('');
  $("#insert_outlet_code").val('');
  $("#insert_footer_struct").val('');
  $("#insert_title").focus();
}


function disableButtonEdit(){
  $("#buttonUpdate").disabled = true;
  $("#buttonCancelUpdate").disabled = true;
}
function ensableButtonEdit(){
  $("#buttonUpdate").disabled = false;
  $("#buttonCancelUpdate").disabled = false;
}

function disableButtonInsert(){
  $("#buttonInsert").disabled = true;
  $("#buttonCancel").disabled = true;
}
function enableButtonInsert(){
  $("#buttonInsert").disabled = false;
  $("#buttonCancel").disabled = false;
}

$("#buttonRefresh").click(function(event) {
  loadDataUser();
});

//INSERT
$('#insertFormUser').on('show.bs.modal', function (e) {
  // LOADING
  $("#fetchFormInsert").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><i> Sedang Proses ...</i></center>");
    $.ajax({
        type : 'post',
        url : '<?php echo $base_url."pages/setting/user/insert.php" ?>',
        success : function(data){
        $('#fetchFormInsert').html(data);//menampilkan data ke dalam modal
        }
    });
 });

// EDIT
$('#editFormUser').on('show.bs.modal', function (e) {
    var idEdit = $(e.relatedTarget).data('id'); 
  // LOADING
    $("#fetchFormEdit").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><i> Sedang Proses ...</i></center>");
    $.ajax({
        type : 'get',
        url : '<?php echo $base_url."pages/setting/user/edit.php" ?>',
        data :  'idEdit='+idEdit,
        success : function(data){
        $('#fetchFormEdit').html(data); //menampilkan data ke dalam modal
        }
    });
 });

//DELETE
$('#deleteConfirmUser').on('show.bs.modal', function (e) {
    var del_id = $(e.relatedTarget).data('id'); 
  // LOADING
    $("#fetchDeleteConfirm").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><i> Sedang Proses ...</i></center>");
    $.ajax({
        type : 'post',
        url : '<?php echo $base_url."pages/setting/user/confirm.php" ?>',
        data :  'del_id='+ del_id,
        success : function(data){
        $('#fetchDeleteConfirm').html(data);
        }
    });
 });
</script>


<?php 
  // log Activity
  $insertLogData = log_insert('READ', 'Akses Menu System User', $ip_address, $os, $browser);
  $queryInsertLogData = mysqli_query($config, $insertLogData);
  if (!$queryInsertLogData) {
    echo "<span class='alert alert-danger'>Error Query Insert Log</span>";
  }
?>
