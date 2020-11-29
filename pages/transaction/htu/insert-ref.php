
        <a data-toggle="modal" data-target='#insertHtu' id="buttonAddHTU" title="Tambah Cara Pakai" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" data-backdrop="static" data-keyboard="false"> <span class="fa fa-plus-circle"></span> Cara Pakai</a>
        <!-- Insert How To Use -->
        <div class="modal fade" id="insertHtu">
            <div class="modal-dialog">
                <div class="panel panel-primary" id="fetchDataInsertHTU">
                </div>
            </div>
        </div>


        <script type="text/javascript">

          function insertEffect() {$("#insertProduct").show( 'clip', 800 );};
          function editEffect() {$("#insertHtu").show( 'clip', 800 );};
          function deleteEffect() {$("#delete").show( 'clip', 800 );};
          function detailEffect() {$("#detail").show( 'clip', 800 );};

          $("#buttonAddProduct").click(function(event) {insertEffect();});
          $("#buttonAddHTU").click(function(event) {editEffect();});
          $("#buttonDelete").click(function(event) {deleteEffect();});
          $("#buttonDetail").click(function(event) {detailEffect();});
            
          //Insert Produk
          $('#insertProduct').on('show.bs.modal', function (e) {
            $("#fetchDataInsert").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><br><i> Sedang Proses ...</i></center>");
            $.ajax({
              type : 'get',
              url : '<?php echo $base_url."pages/transaction/product/insert.php" ?>',
              success : function(data){
              $('#fetchDataInsertProduct').html(data);//menampilkan data ke dalam modal
              }
            });
           });
          //Insert Cara Pakai
          $('#insertHtu').on('show.bs.modal', function (e) {
            $("#fetchDataInsertHTU").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><br><i> Sedang Proses ...</i></center>");
            $.ajax({
              type : 'get',
              url : '<?php echo $base_url."pages/transaction/htu/insert.php" ?>',
              success : function(data){
              $('#fetchDataInsertHTU').html(data);//menampilkan data ke dalam modal
              }
            });
           });


			$('#c_how_to_use').change(function(e) {
			    if ($('#c_how_to_use').val()=='') {
			        $.notify('Cara Pakai Harus Dipilih!', 'error');
			        $('#buttonAddCart').focus();
			    }else{
			        $('#buttonAddCart').focus();
			    }
			});	
        </script>


        <div class="form-group">
            <select name="c_how_to_use" id="c_how_to_use" class="form-control">
                <option value="">Cara Pakai</option>
                <?php  
                    $selectOptionHTU = mysqli_query($config, "SELECT * FROM tb_master_htu WHERE bl_state = 'A' ");
                    while($rowSelectOptionHTU = mysqli_fetch_array($selectOptionHTU)){
                        $id_htu             = $rowSelectOptionHTU['id_htu'];
                        $htu_code           = $rowSelectOptionHTU['htu_code'];
                        $htu_description    = $rowSelectOptionHTU['htu_description'];
                        $htu_type           = $rowSelectOptionHTU['htu_type'];
                ?>
                    <option value="<?php echo $htu_code ?>"><?php echo $htu_description ?></option>
                <?php } ?>
            </select>
        </div>