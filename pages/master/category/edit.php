
<?php 
  include('../../../config/config.php'); 

if (!empty($_SESSION['login']['user_name'])) {
  
  $idEdit = $_GET['idEdit'];
  
    $selectData = " SELECT * FROM tb_master_category WHERE id_category = '$idEdit' AND bl_state = 'A' ";
    $querySelectData =  mysqli_query($config, $selectData);

      $number = 0;
      while ($rowSelectData = mysqli_fetch_array($querySelectData)){
        $number               = $number + 1 ;
        $id_category          = $rowSelectData['id_category'];
        $category_code        = $rowSelectData['category_code'];
        $category_description = $rowSelectData['category_description'];
        $bl_state             = $rowSelectData['bl_state'];
    }
?>

  <div class="panel-heading">
      <b>Form Ubah Data</b>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  </div>
  <div class="panel-body">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="form-group">
        <label for="">Deskripsi Kategori</label>
        <input type="hidden" name="idCategory" id="idCategory" value="<?php echo $id_category ?>">
        <input type="text" class="form-control" id="editCategoryDescription" name="editCategoryDescription" placeholder="Nama Kategori" title="Nama Kategori" value="<?php echo $category_description ?>">
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <legend></legend>
      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <div id="resultInsert"></div>
      </div>
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-right">
        <button type="submit" class="btn btn-primary" id="buttonUpdate">Simpan</button>
        <button type="button" class="btn btn-default" id="buttonCancel" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>


<script type="text/javascript">

  $(document).ready(function() {
    $('#editCategoryDescription').focus();
  });

  // Save Kategori
  function saveCategory(){
    var idCategory              = $('#idCategory').val();
    var editCategoryDescription  = $('#editCategoryDescription').val();
    
    if ($('#editCategoryDescription').val() == '') {
      toastr['error']("Deskripsi Kategori Harus Diisi!");
      $('#editCategoryDescription').focus();
    }else{
      // AJAX Insert
      disableForm();
      $("#resultInsert").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i></center>");
      $.ajax({
          type:"get",
          url:"<?php echo $base_url."pages/master/category/update.php" ?>",
          data:"idCategory="+idCategory+"&editCategoryDescription="+editCategoryDescription,
          success:function(data){
            $("#resultInsert").html(data);
          }
      });      
    }
  }

  function disableForm(){
    document.getElementById('buttonUpdate').disabled = true;
    document.getElementById('buttonCancel').disabled = true;
    document.getElementById('editCategoryDescription').disabled = true;
  }
  function enableForm(){
    document.getElementById('buttonUpdate').disabled = false;
    document.getElementById('buttonCancel').disabled = false;
    document.getElementById('editCategoryDescription').disabled = false;
  }
  function clearForm(){
    $('#editCategoryDescription').val('');
    $('#editCategoryDescription').focus();
  }

  $('#editCategoryDescription').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#editCategoryDescription').val() == '') {
        toastr['error']("Deskripsi Kategori Harus Di Isi!");
        $('#editCategoryDescription').focus();
      }else {$('#buttonUpdate').focus();}
    }
  });

  $('#buttonUpdate').click(function(e) {
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