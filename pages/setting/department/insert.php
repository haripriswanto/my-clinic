
<?php 
  include('../../../config/config.php');

  if (!empty($_SESSION['login'])) {
?> 
<div class="row">
  <div class="col-md-8">
    <div class="form-group">
      <label>Nama Department</label>
      <input type="text" class="form-control" name="insertDescription" id="insertDescription" placeholder="Nama Department" onkeyup="checkDuplicateData();">
      <span class="my-2" id="message"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
        <label>Sort Field</label>
        <input type="text" class="form-control" name="insertSortField" id="insertSortField" placeholder="Urutan">
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
  $( function() {
    $( "#insertActiveLabel" ).checkboxradio({
      icon: false
    });
  });

  function checkDuplicateData() {
    var insertDescription   = $('#insertDescription').val().trim();
    var idUpdate     = '';
    if(insertDescription != ''){
        $('#message').html('<img src="<?php echo $base_url."assets/images/load.gif" ?>" width="15" height="15"/>');
        $.ajax({
            url: '<?php echo $base_url.'pages/setting/department/checkData.php'; ?>',
            type: 'post',
            data: {insertDescription: insertDescription},
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
      $("#insertCode").focus();
  });
    
  
  $('#insertDescription').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#insertDescription').val() == '') {
        $.notify("Deskripsi Harus Di Isi!", "error");
        $('#insertDescription').focus();
      }else {$('#insertSortField').focus();}
    }
  });
  
  $('#insertSortField').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#insertSortField').val() == '') {
        $.notify("Urutan Harus Di isi.", "error");
        $('#insertSortField').focus();
      }else {$('#buttonInsert').focus();}
    }
  });

  $("#buttonInsert").click(function(event) {
    insertData();
  });

  function insertData(){
      var insertDescription     = $("#insertDescription").val();
      var insertSortField       = $("#insertSortField").val();
  
    if (insertDescription == '') {
      $.notify("Deskripsi Harus Di Isi!", "error");
      $("#insertDescription").focus();
    }else if (insertSortField == '') {
      $.notify("Urutan Harus Di Isi!", "error");
      $("#insertSortField").focus();
    }else{
      // AJAX Insert
      disableButtonInsert();
      $("#resultInsert").html("<img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i>");
      $.ajax({
          type:"get",
          url:"<?php echo $base_url."pages/setting/department/save.php" ?>",
          data:"insertSortField="+insertSortField+"&insertDescription="+insertDescription,
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