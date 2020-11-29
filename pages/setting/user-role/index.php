<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">SYSTEM ROLE USER</h1>
    </div>
</div>

<div class="row">
  <div class="col-md-12">
    <a data-toggle="modal" href='#insertForm' id="buttonAdd" title="Tambah Data Menu" class="btn btn-primary">
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
        <h3 class="panel-title"><b>DATA Menu</b> 
        </h3>
      </div>
      <div class="panel-body" id="fetchDataUser"></div>
    </div>
  </div>
</div>

<!-- INSERT Menu -->
<div class="modal fade" id="insertForm">
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

<!-- EDIT Menu -->
<div class="modal fade" id="editForm">
    <div class="modal-dialog">
        <div class="panel panel-primary" id="fetchFormEdit">
        </div>
    </div>
</div>

<!-- Detail Menu -->
<div class="modal fade" id="modalDetail">
    <div class="modal-dialog modal-lg">
        <div class="panel panel-primary" id="fetchModalDetail">
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="deleteConfirm">
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


function loadData(){
  $("#fetchDataUser").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><i> Sedang Proses ...</i></center>");
  $("#fetchDataUser").load('<?php echo $base_url."pages/setting/user-role/read.php" ?>');
}

$(document).ready(function() {
  loadData();
});

function closeForm(){
  $('#editForm').modal('hide');
  $('#insertForm').modal('hide');
  $('#deleteConfirm').modal('hide');
  $('#modalDetail').modal('hide');
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


function disableButtonUpdate(){
  $("#buttonUpdate").disabled = true;
  $("#buttonCancel").disabled = true;
}
function enablebBttonUpdate(){
  $("#buttonUpdate").disabled = false;
  $("#buttonCancel").disabled = false;
}

function disableButtonInsert(){
  $("#buttonInsert").disabled = true;
  $("#buttonCancel").disabled = true;
}
function enableButtonInsert(){
  $("#buttonInsert").disabled = false;
  $("#buttonCancel").disabled = false;
}

function disableButtonSaveDetail(){
  $("#buttonSaveAccess").disabled = true;
}

$("#buttonRefresh").click(function(event) {
  loadData();
});

//INSERT
$('#insertForm').on('show.bs.modal', function (e) {
  // LOADING
  $("#fetchFormInsert").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><i> Sedang Proses ...</i></center>");
    $.ajax({
        type : 'post',
        url : '<?php echo $base_url."pages/setting/user-role/insert.php" ?>',
        success : function(data){
        $('#fetchFormInsert').html(data);//menampilkan data ke dalam modal
        }
    });
 });

// EDIT
$('#editForm').on('show.bs.modal', function (e) {
    var idEdit = $(e.relatedTarget).data('id'); 
  // LOADING
    $("#fetchFormEdit").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><i> Sedang Proses ...</i></center>");
    $.ajax({
        type : 'get',
        url : '<?php echo $base_url."pages/setting/user-role/edit.php" ?>',
        data :  'idEdit='+idEdit,
        success : function(data){
        $('#fetchFormEdit').html(data); //menampilkan data ke dalam modal
        }
    });
 });

// DETAIL
$('#modalDetail').on('show.bs.modal', function (e) {
    var idDetail = $(e.relatedTarget).data('id'); 
  // LOADING
    $("#fetchModalDetail").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><i> Sedang Proses ...</i></center>");
    $.ajax({
        type : 'get',
        url : '<?php echo $base_url."pages/setting/user-role/detail.php" ?>',
        data :  'idDetail='+idDetail,
        success : function(data){
        $('#fetchModalDetail').html(data); //menampilkan data ke dalam modal
        }
    });
 });

//DELETE
$('#deleteConfirm').on('show.bs.modal', function (e) {
    var del_id = $(e.relatedTarget).data('id'); 
  // LOADING
    $("#fetchDeleteConfirm").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><i> Sedang Proses ...</i></center>");
    $.ajax({
        type : 'post',
        url : '<?php echo $base_url."pages/setting/user-role/confirm.php" ?>',
        data :  'del_id='+ del_id,
        success : function(data){
        $('#fetchDeleteConfirm').html(data);
        }
    });
 });
</script>


<?php 
  // log Activity
  $insertLogData = log_insert('READ', 'Akses Menu System Menu', $ip_address, $os, $browser);
  $queryInsertLogData = mysqli_query($config, $insertLogData);
  if (!$queryInsertLogData) {
    echo "<span class='alert alert-danger'>Error Query Insert Log</span>";
  }
?>
