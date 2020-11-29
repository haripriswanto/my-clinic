
<?php 
  include('../../../config/config.php');

  if (!empty($_SESSION['login'])) {

    $id = $_GET['idEdit'];
    $querySelectUser =  mysqli_query($config, " 
      SELECT * FROM tb_system_user_role 
      WHERE id = '$id' AND is_active = 'A'
      ORDER BY ts_update ASC");

      $rowSelect = mysqli_fetch_array($querySelectUser);
        $id                = $rowSelect['id'];
        $role_code         = $rowSelect['role_code'];
        $role_description  = $rowSelect['role_description'];
        $ts_insert         = $rowSelect['ts_insert'];
        $ts_update         = $rowSelect['ts_update'];

?>

<div class="panel-heading">
    <b>Form Ubah Data</b>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="panel-body">
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
          <label>Kode Role</label>
          <input type="hidden" name="e_roleId" id="e_roleId" value="<?= $id; ?>">
          <input type="text" class="form-control" name="e_roleCode" id="e_roleCode" placeholder="Kode" value="<?= $role_code ?>">
      </div>
    </div>
    <div class="col-md-8">
      <div class="form-group">
          <label>Deskripsi Role</label>
          <input type="text" class="form-control" name="e_roleDescription" id="e_roleDescription" placeholder="Deskripsi Role" value="<?= $role_description ?>">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12"> 
      <legend></legend>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8"> 
      <div id="resultUpdate"></div>
    </div>
    <div class="col-md-4"> 
      <button type="submit" class="btn btn-primary" id="buttonUpdate">Submit</button>
      <button type="button" class="btn btn-default" id="buttonCancel" data-dismiss="modal">Batal</button>
    </div>
  </div>
</div>

<script type="text/javascript">

  function checkUser() {
    var e_roleCode   = $('#e_roleCode').val().trim();
    var edit_id_user      = '';
    if(e_roleCode != ''){
        $('#message').html('<img src="<?php echo $base_url."assets/images/load.gif" ?>" width="15" height="15"/>');
        $.ajax({
            url: '<?php echo $base_url.'pages/setting/user-role/checkUser.php'; ?>',
            type: 'post',
            data: {e_roleCode: e_roleCode},
            success: function(response){
                $('#message').html(response);
             }
        });
    }else{
        $("#message").html("");
    }
  }

  $('#e_roleCode').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#e_roleCode').val() == '') {
        toastr['error']("Kode Harus Di Isi!");
        $('#e_roleCode').focus();
      }else {$('#e_roleDescription').focus();}
    }
  });
  $('#e_roleDescription').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#e_roleDescription').val() == '') {
        toastr['error']("Deskripsi Harus Di Isi!");
        $('#e_roleDescription').focus();
      }else {$('#buttonUpdate').focus();}
    }
  });

  $("#buttonUpdate").click(function(event) {
    updateData();
  });

  function updateData(){
      var e_roleId             = $("#e_roleId").val();
      var e_roleCode           = $("#e_roleCode").val();
      var e_roleDescription    = $("#e_roleDescription").val();
  
    if (e_roleCode == '') {
        toastr['error']("Kode Harus Di Isi!");
      $("#e_roleCode").focus();
    }else if (e_roleDescription == '') {
        toastr['error']("Deskripsi Harus Di Isi!");
      $("#e_roleDescription").focus();
    }else{
      // AJAX Insert
      disableButtonUpdate();
      $("#resultUpdate").html("<img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i>");
      $.ajax({
          type:"get",
          url:"<?php echo $base_url."pages/setting/user-role/update.php" ?>",
          data:{
            e_roleId : e_roleId,
            e_roleCode : e_roleCode,
            e_roleDescription : e_roleDescription,

          },
          success:function(data){
            $("#resultUpdate").html(data);
          }
      });
    }
  }
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