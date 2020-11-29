
<?php 
  include('../../../config/config.php');

  if (!empty($_SESSION['login'])) {

  $idEdit = $_GET['idEdit'];

  $querySelectData =  mysqli_query($config, " SELECT * FROM tb_system_department WHERE id = '$idEdit' AND is_active = 'A' ");

    while ($objData = mysqli_fetch_array($querySelectData)){
      $id                     = $objData['id'];
      $department_code        = $objData['department_code'];
      $department_description = $objData['department_description'];
      $sort_field             = $objData['sort_field'];
  }
?> 

<div class="panel-heading">
    <b>Form Ubah Data </b>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>

<div class="panel-body" id="fetchFormInsert">
  <div class="row">
    <div class="col-md-8">
      <div class="form-group">
        <label>Nama Department</label>
        <input type="hidden" name="idUpdate" id="idUpdate" value="<?= $id; ?>">
        <input type="text" class="form-control" name="editDescription" id="editDescription" placeholder="Nama Department" onkeyup="checkDuplicateData();" value="<?= $department_description; ?>">
        <span class="my-2" id="message"></span>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
          <label>Sort Field</label>
          <input type="text" class="form-control" name="editSortField" id="editSortField" placeholder="Urutan" value="<?= $sort_field; ?>">
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
      <button type="submit" class="btn btn-primary" id="buttonEdit">Submit</button>
      <button type="button" class="btn btn-default" id="buttonCancel" data-dismiss="modal">Batal</button>
    </div>
  </div>
</div>

<script type="text/javascript">
  $( function() {
    $( "#editActiveLabel" ).checkboxradio({
      icon: false
    });
  });

  function checkDuplicateData() {
    var editDescription   = $('#editDescription').val().trim();
    var idUpdate          = $('#idUpdate').val().trim();
    if(editDescription != ''){
        $('#message').html('<img src="<?php echo $base_url."assets/images/load.gif" ?>" width="15" height="15"/>');
        $.ajax({
            url: '<?php echo $base_url.'pages/setting/department/checkData.php'; ?>',
            type: 'post',
            data: {idUpdate:idUpdate, editDescription: editDescription},
            success: function(response){
                $('#message').html(response);
             }
        });
    }else{
        $("#message").html("");
    }
  }


  $( function() {
    $( ".datepicker" ).datepicker({
      dateFormat: 'yy-mm-dd',
      changeMonth: true,
      changeYear: true,
      yearRange:"-59:+0",
      timeFormat: 'H:i:s'
    });
  });
  
  $(document).ready(function() {
      $("#editDescription").focus();
  });
    
  
  $('#editDescription').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#editDescription').val() == '') {
        $.notify("Deskripsi Harus Di Isi!", "error");
        $('#editDescription').focus();
      }else {$('#editSortField').focus();}
    }
  });
  
  $('#editSortField').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#editSortField').val() == '') {
        $.notify("Urutan Harus Di isi.", "error");
        $('#editSortField').focus();
      }else {$('#buttonEdit').focus();}
    }
  });

  $("#buttonEdit").click(function(event) {
    editData();
  });

  function editData(){
      var editDescription     = $("#editDescription").val();
      var editSortField       = $("#editSortField").val();
  
    if (editDescription == '') {
      $.notify("Deskripsi Harus Di Isi!", "error");
      $("#editDescription").focus();
    }else if (editSortField == '') {
      $.notify("Urutan Harus Di Isi!", "error");
      $("#editSortField").focus();
    }else{
      // AJAX Insert
      disablebuttonEdit();
      $("#resultInsert").html("<img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i>");
      $.ajax({
          type:"get",
          url:"<?php echo $base_url."pages/setting/department/update.php" ?>",
          data:"editSortField="+editSortField+"&editDescription="+editDescription,
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