<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">SYSTEM SETTING</h1>
    </div>
</div>

<?php 
  $query =  mysqli_query($config, " 
  SELECT * FROM tb_system_setting 
        WHERE id_transaction = '1'
          ORDER BY id_system ASC");

    $number = 0;
    while ($row = mysqli_fetch_array($query)){
      $number                 = $number + 1 ;
      $id_system              = $row['id_system'];
      $system_title           = $row['system_title'];
      $system_header          = $row['system_header'];
      $system_dashboard_text  = $row['system_dashboard_text'];
      $system_instansi_name   = $row['system_instansi_name'];
      $system_owner           = $row['system_owner'];
      $system_phone           = $row['system_phone'];
      $system_address         = $row['system_address'];
      $system_email           = $row['system_email'];
      $system_url             = $row['system_url'];
      $system_outlet_code     = $row['system_outlet_code'];
      $system_footer_struct   = $row['system_footer_struct'];
    }

  ?>
<?php if (!empty($id_system)) { ?>
  <a data-toggle="modal" data-id="<?php echo $id_system; ?>" href='#systemEdit' title="Ubah Data System Setting" class="btn btn-primary">
    <span class="fa fa-pencil"></span> Edit
  </a>
<?php } if (empty($id_system)) { ?>
    <a data-toggle="modal" href='#systemInsert' title="Setting" class="btn btn-primary">
      <span class="fa fa-plus-circle"></span>
    </a>
<?php } ?>
    <a id="buttonRefresh" title="Refresh Data" class="btn btn-default">
      <span class="fa fa-refresh"></span>
    </a>
<div class="clearfix"><br></div>

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title"><b>DATA SETTING</b> 
        </h3>
      </div>
      <div class="panel-body" id="fetchdDataSetting"></div>
    </div>
  </div>
</div>


<!-- Edit Page -->
<div class="modal fade" id="systemEdit">
    <div class="modal-dialog">
        <div class="modal-content" id="fetchedDataEdit">
        </div>
    </div>
</div>

<!-- Insert Page -->
<div class="modal fade" id="systemInsert">
    <div class="modal-dialog">
        <div class="modal-content" id="fetchedDataInsert">
        </div>
    </div>
</div>

<script type="text/javascript">

  function loadDataSetting(){
    $("#fetchdDataSetting").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><i> Sedang Proses ...</i></center>");
    $("#fetchdDataSetting").load('<?php echo $base_url."pages/setting/system/read.php" ?>');
  }

  $(document).ready(function() {
    loadDataSetting();
  });

  function closeForm(){
    $('#systemEdit').modal('hide');
    $('#systemInsert').modal('hide');
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

  // Disable Button
  function disableButton(){
    $("#buttonUpdate").disabled = true;
    $("#buttonCancelUpdate").disabled = true;
  }

  $("#buttonRefresh").click(function(event) {
    loadDataSetting();
  });

  // Edit Ajax
  $('#systemEdit').on('show.bs.modal', function (e) {
      var idEdit = $(e.relatedTarget).data('id'); 
      $("#fetchedDataEdit").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i></center>");
      $.ajax({
          type : 'post',
          url : '<?php echo $base_url."pages/setting/system/edit.php" ?>',
          data :  'idEdit='+ idEdit,
          success : function(data){
          $('#fetchedDataEdit').html(data); //menampilkan data ke dalam modal
          }
      });
   });

  // Insert Ajax
  $('#systemInsert').on('show.bs.modal', function (e) {
      var idInsert = $(e.relatedTarget).data('idInsert'); 
      $("#fetchedDataInsert").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i></center>");
      $.ajax({
          type : 'post',
          url : '<?php echo $base_url."pages/setting/system/insert.php" ?>',
          data :  'idInsert='+ idInsert,
          success : function(data){
          $('#fetchedDataInsert').html(data); //menampilkan data ke dalam modal
          }
      });
   });
</script>


<?php 
  // log Activity
  $insertLogData = log_insert('READ', 'Akses Menu System Setting', $ip_address, $os, $browser);
  $queryInsertLogData = mysqli_query($config, $insertLogData);
  if (!$queryInsertLogData) {
    echo "<span class='alert alert-danger'>Error Query Insert Log</span>";
  }
?>