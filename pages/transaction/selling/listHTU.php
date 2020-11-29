<?php 
  include('../../../config/config.php');
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <b>Daftar Cara Pakai!</b>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>
    <div class="panel-body">
        <a data-toggle="modal" data-target='#insertHTU' id="buttonAddHTU" title="Tambah Cara Pakai" class="btn btn-primary" data-backdrop="static" data-keyboard="false">
          <span class="fa fa-plus-circle"></span> Tambah Data
        </a>
        <div class="row">
            <div class="col-md-12"><hr></div>
        </div>
        <table id="lookupHTU" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th width="30">#</th>
                    <th>Cara Pakai</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $c_name_L = mysqli_escape_string($config, strtolower($_GET['c_selling_HTU']));
                $c_name_U = mysqli_escape_string($config, strtoupper($_GET['c_selling_HTU']));
                $c_name_C = mysqli_escape_string($config, ucwords($c_name_L));

                $query = mysqli_query($config, "
                            SELECT * FROM tb_master_htu 
                                WHERE htu_description LIKE '%$c_name_L%' OR htu_description LIKE '%$c_name_U%' OR htu_description LIKE '%$c_name_C%' 
                                AND bl_state = 'A'
                                ORDER BY htu_description ASC");
                $number = 0;
                while ($row = mysqli_fetch_array($query)){
                    $number             = $number + 1 ;
                    $id_htu             = $row['id_htu'];
                    $htu_code           = $row['htu_code'];
                    $htu_description    = $row['htu_description'];
                    $htu_type           = $row['htu_type'];
                    $ts_insert          = $row['ts_insert'];
                    $ts_update          = $row['ts_update'];
                    $bl_state           = $row['bl_state'];

                ?>
                <tr id="select_htu" style="cursor: pointer;" htu_code="<?php echo $htu_code; ?>" htu_description="<?php echo $htu_description; ?>">
                    <td><?php echo $number; ?></td>
                    <td><?php echo $htu_description; ?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">

    $('#buttonAddHTU').click(function() {
        $("#listHTU").modal("hide");
    });

    function insertHTUEffect() {$("#insertHTU").show( 'clip', 800 );};

    //jika dipilih, nim akan masuk ke input dan modal di tutup
    $(document).on('click', '#select_htu', function (e) {
        document.getElementById("c_selling_HTU_code").value = $(this).attr('htu_code');
        document.getElementById("c_selling_HTU").value = $(this).attr('htu_description');
        $('#listHTU').modal('hide');
        document.getElementById('buttonAddCart').focus();
    });            

    //tabel lookup Produk
    $(function () {$("#lookupHTU").dataTable();});

</script>