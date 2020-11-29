<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">System department</h1>
    </div>
</div>

<div class="row">
  <div class="col-md-12">
    <a data-toggle="modal" href='#insertFormDepartment' id="buttonAdd" title="Tambah Data Department" class="btn btn-primary">
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
        <h3 class="panel-title"><b>Data Department</b> 
        </h3>
      </div>
      <div class="panel-body" id="fetchDataDepartment"></div>
    </div>
  </div>
</div>

<!-- INSERT Department -->
<div class="modal fade" id="insertFormDepartment">
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

<!-- EDIT Department -->
<div class="modal fade" id="editFormDepartment">
    <div class="modal-dialog">
        <div class="panel panel-primary" id="fetchFormEdit">
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="deleteConfirmDepartment">
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
  $("#fetchDataDepartment").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><i> Sedang Proses ...</i></center>");
  $("#fetchDataDepartment").load('<?php echo $base_url."pages/setting/department/read.php" ?>');
}

$(document).ready(function() {
  loadData();
});

function closeForm(){
  $('#editFormDepartment').modal('hide');
  $('#insertFormDepartment').modal('hide');
  $('#deleteConfirmDepartment').modal('hide');
}

function disableButtonEdit(){
  $("#buttonUpdate").disabled = true;
  $("#buttonCancelUpdate").disabled = true;
}
function enableButtonEdit(){
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
  loadData();
});

//INSERT
$('#insertFormDepartment').on('show.bs.modal', function (e) {
  // LOADING
  $("#fetchFormInsert").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><i> Sedang Proses ...</i></center>");
    $.ajax({
        type : 'post',
        url : '<?php echo $base_url."pages/setting/department/insert.php" ?>',
        success : function(data){
        $('#fetchFormInsert').html(data);//menampilkan data ke dalam modal
        }
    });
 });

// EDIT
$('#editFormDepartment').on('show.bs.modal', function (e) {
    var idEdit = $(e.relatedTarget).data('id'); 
  // LOADING
    $("#fetchFormEdit").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><i> Sedang Proses ...</i></center>");
    $.ajax({
        type : 'get',
        url : '<?php echo $base_url."pages/setting/department/edit.php" ?>',
        data :  'idEdit='+idEdit,
        success : function(data){
        $('#fetchFormEdit').html(data); //menampilkan data ke dalam modal
        }
    });
 });

//DELETE
$('#deleteConfirmDepartment').on('show.bs.modal', function (e) {
    var del_id = $(e.relatedTarget).data('id'); 
  // LOADING
    $("#fetchDeleteConfirm").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><i> Sedang Proses ...</i></center>");
    $.ajax({
        type : 'post',
        url : '<?php echo $base_url."pages/setting/department/confirm.php" ?>',
        data :  'del_id='+ del_id,
        success : function(data){
        $('#fetchDeleteConfirm').html(data);
        }
    });
 });
</script>


<?php 
  // log Activity
  $insertLogData = log_insert('READ', 'Akses Menu System Department', $ip_address, $os, $browser);
  $queryInsertLogData = mysqli_query($config, $insertLogData);
  if (!$queryInsertLogData) {
    echo "<span class='alert alert-danger'>Error Query Insert Log</span>";
  }
?>
