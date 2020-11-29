
<?php 
  include('../../../config/config.php');

  if (!empty($_SESSION['login'])) {
?> 
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
        <label>Kode Role</label>
        <input type="text" class="form-control" name="i_roleCode" id="i_roleCode" placeholder="Kode">
    </div>
  </div>
  <div class="col-md-8">
    <div class="form-group">
        <label>Deskripsi Role</label>
        <input type="text" class="form-control" name="i_roleDescription" id="i_roleDescription" placeholder="Deskripsi Role">
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
    <div id="resultInsert"></div>
  </div>
  <div class="col-md-4"> 
    <button type="submit" class="btn btn-primary" id="buttonInsert">Submit</button>
    <button type="button" class="btn btn-default" id="buttonCancel" data-dismiss="modal">Batal</button>
  </div>
</div>

<script type="text/javascript">

  function checkUser() {
    var i_roleCode   = $('#i_roleCode').val().trim();
    var edit_id_user      = '';
    if(i_roleCode != ''){
        $('#message').html('<img src="<?php echo $base_url."assets/images/load.gif" ?>" width="15" height="15"/>');
        $.ajax({
            url: '<?php echo $base_url.'pages/setting/user-role/checkUser.php'; ?>',
            type: 'post',
            data: {i_roleCode: i_roleCode},
            success: function(response){
                $('#message').html(response);
             }
        });
    }else{
        $("#message").html("");
    }
  }

  $('#i_roleCode').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_roleCode').val() == '') {
        toastr['error']("Kode Harus Di Isi!");
        $('#i_roleCode').focus();
      }else {$('#i_roleDescription').focus();}
    }
  });
  $('#i_roleDescription').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_roleDescription').val() == '') {
        toastr['error']("Deskripsi Harus Di Isi!");
        $('#i_roleDescription').focus();
      }else {$('#buttonInsert').focus();}
    }
  });

  $("#buttonInsert").click(function(event) {
    insertData();
  });

  function insertData(){
      var i_roleCode           = $("#i_roleCode").val();
      var i_roleDescription       = $("#i_roleDescription").val();
  
    if (i_roleCode == '') {
        toastr['error']("Kode Harus Di Isi!");
      $("#i_roleCode").focus();
    }else if (i_roleDescription == '') {
        toastr['error']("Deskripsi Harus Di Isi!");
      $("#i_roleDescription").focus();
    }else{
      // AJAX Insert
      disableButtonInsert();
      $("#resultInsert").html("<img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i>");
      $.ajax({
          type:"get",
          url:"<?php echo $base_url."pages/setting/user-role/save.php" ?>",
          data:"&i_roleCode="+i_roleCode+"&i_roleDescription="+i_roleDescription,
          success:function(data){
            $("#resultInsert").html(data);
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