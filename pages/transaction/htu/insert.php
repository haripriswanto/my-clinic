
<?php 
  include('../../../config/config.php');
?>
  
<div class="panel-heading">
    <b>Tambah Data</b>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="buttonCloseHTU">&times;</button>
</div>
<div class="panel-body">

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="form-group">
      <label for="">Cara Pakai</label>
      <input type="text" class="form-control" id="i_htu_description" name="i_htu_description" placeholder="Deskripsi Cara Pakai" title="Deskripsi Cara Pakai">
    </div>
  </div>
  <!-- <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <div class="form-group">
      <label for="">Jenis Etiket</label>
      <select name="i_htu_type" id="i_htu_type" class="form-control">
        <option value="1">Label </option>
        <option value="2">Label Biru</option>
      </select>
    </div>
  </div> -->
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <legend></legend>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
      <div id="resultInsertHTU"></div>
    </div>
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 text-right">
      <!-- <button type="submit" class="btn btn-primary" id="buttonInsertAgainHTU">Simpan Dan Isi Lagi</button> -->
      <button type="submit" class="btn btn-primary" id="buttonInsertHTU">Simpan</button>
      <button type="button" class="btn btn-default" id="buttonCancelHTU" data-dismiss="modal">Batal</button>
    </div>
  </div>    
</div>

<script type="text/javascript">

  $('#i_htu_description').focus();

  // Save HTU
  function saveData(){
    // Validation Form
    if ($('#i_htu_description').val() == '') {
      $.notify("Cara Pakai Harus Diisi!", "error");
      $('#i_htu_description').focus();
    }else{

    var i_htu_description   = $('#i_htu_description').val();
      // AJAX Insert
      disabledInsertForm();
      $("#resultInsertHTU").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i></center>");
      $.ajax({
          type:"get",
          url:"<?php echo $base_url."pages/transaction/htu/save.php" ?>",
          data:"i_htu_description="+i_htu_description,
          success:function(data){
            $("#resultInsertHTU").html(data);
          }
      });      
    }
  }

  $('#i_htu_description').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_htu_description').val() == '') {
        $.notify("Cara Pakai Harus Diisi!", "error");
        $('#i_htu_description').focus();
      }else {$('#buttonInsertHTU').focus();}
    }
  });

  $('#buttonInsertHTU').click(function(e) {
    saveData();
  });

</script>