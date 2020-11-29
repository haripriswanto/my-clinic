
<?php 
  include('../../../config/config.php');
  
  if (!empty($_SESSION['login'])) {
?>
  <div class="panel-heading">
      <b>Form Tambah Data</b>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  </div>
  <div class="panel-body">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="form-group">
        <label for="">Deskripsi Kategori</label>
        <input type="text" class="form-control" id="insertCategoryDescription" name="insertCategoryDescription" placeholder="Nama Kategori" title="Nama Kategori">
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <legend></legend>
      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <div id="resultInsert"></div>
      </div>
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-right">
        <button type="submit" class="btn btn-primary" id="buttonInsert">Simpan</button>
        <button type="button" class="btn btn-default" id="buttonCancel" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>


<script type="text/javascript">

  

  $('#insertCategoryDescription').focus();

  // Save Kategori
  function saveCategory(){
    var insertCategoryDescription  = $('#insertCategoryDescription').val();
    
    if ($('#insertCategoryDescription').val() == '') {
      toastr['error']("Deskripsi Kategori Harus Diisi!");
      $('#insertCategoryDescription').focus();
    }else{
      // AJAX Insert
      disableForm();
      $("#resultInsert").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i></center>");
      $.ajax({
          type:"get",
          url:"<?php echo $base_url."pages/master/category/save.php" ?>",
          data:"insertCategoryDescription="+insertCategoryDescription,
          success:function(data){
            $("#resultInsert").html(data);
          }
      });      
    }
  }

  function disableForm(){
    document.getElementById('buttonInsert').disabled = true;
    document.getElementById('buttonCancel').disabled = true;
    document.getElementById('insertCategoryDescription').disabled = true;
  }
  function enableForm(){
    document.getElementById('buttonInsert').disabled = false;
    document.getElementById('buttonCancel').disabled = false;
    document.getElementById('insertCategoryDescription').disabled = false;
  }
  function clearForm(){
    $('#insertCategoryDescription').val('');
    $('#insertCategoryDescription').focus();
  }

  $('#insertCategoryDescription').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#insertCategoryDescription').val() == '') {
        toastr['error']("Deskripsi Kategori Harus Di Isi!");
        $('#insertCategoryDescription').focus();
      }else {$('#buttonInsert').focus();}
    }
  });

  $('#buttonInsert').click(function(e) {
    saveCategory();
  });
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