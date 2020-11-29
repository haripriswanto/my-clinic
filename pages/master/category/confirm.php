<?php 
include('../../../config/config.php');

if (!empty($_SESSION['login']['user_name'])) {

  $idDelete = $_GET['idDelete'];
  
    $selectData = " SELECT * FROM tb_master_category WHERE id_category = '$idDelete' AND bl_state = 'A' ";
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
<h3>Yakin Ingin Menghapus <b><?php echo $category_description ?></b> ?</h3>
    <div class="modal-footer">
      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <span id="resultDelete"></span>
      </div>
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <input type="hidden" name="id_delete" id="id_delete" value="<?php echo $id_category ?>">
        <input type="hidden" name="deleteCategoryDescription" id="deleteCategoryDescription" value="<?php echo $category_description ?>">
  	    <button class="btn btn-danger" title="Hapus Kategori" id="buttonDelete"> Hapus </button>
  		  <button class="btn btn-default" data-dismiss="modal" aria-hidden="true" id="buttonCancelDelete">Batal</button>
      </div>
	</div>

<script type="text/javascript">
  // Delete Ajax
  function actionDelete(){
    var id_delete                  = $('#id_delete').val();
    var deleteCategoryDescription  = $('#deleteCategoryDescription').val();

    document.getElementById('buttonDelete').disabled = true;
    document.getElementById('buttonCancelDelete').disabled = true;
    $("#resultDelete").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i></center>");
    $.ajax({
        type:"get",
        url:"<?php echo $base_url."pages/master/category/delete.php" ?>",
        data:"id_delete="+id_delete+"&deleteCategoryDescription="+deleteCategoryDescription,
        success:function(data){
          $("#resultDelete").html(data);
        }
    });
  }

  $('#buttonDelete').click(function(event) {
    actionDelete();
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