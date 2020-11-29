<?php 
  include('../../../config/config.php');
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <b>Daftar PIC (Dokter)!</b>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>
    <div class="panel-body">
        <a data-toggle="modal" data-target='#insertDokter' id="buttonAddDokter" title="Tambah Data Dokter" class="btn btn-primary" data-backdrop="static" data-keyboard="false">
          <span class="fa fa-plus-circle"></span> Tambah Data
        </a>
        <div class="row">
            <div class="col-md-12"><hr></div>
        </div>
        <table id="lookupDokter" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Tipe</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $c_name_L = mysqli_escape_string($config, strtolower($_GET['dokter_name']));
                $c_name_U = mysqli_escape_string($config, strtoupper($_GET['dokter_name']));
                $c_name_C = mysqli_escape_string($config, ucwords($c_name_L));
                $selectDataDokter = "SELECT * FROM tb_master_dokter 
                        WHERE (dokter_name LIKE '%$c_name_L%' OR dokter_name LIKE '%$c_name_U%' OR dokter_name LIKE '%$c_name_C%') AND bl_state = 'A' OR (dokter_code LIKE '%$c_name_L%' OR dokter_code LIKE '%$c_name_U%' OR dokter_code LIKE '%$c_name_C%') 
                        AND bl_state = 'A' AND outlet_code_relation = '$system_outlet_code'
                        ORDER BY dokter_name ASC";

                // var_dump($selectDataDokter);exit;
                $querySelectDataDokter = mysqli_query($config, $selectDataDokter);


                $number = 0;
                while ($rowSelectDataDokter = mysqli_fetch_array($querySelectDataDokter)){
                    $number                 = $number + 1 ;
                    $id_dokter              = $rowSelectDataDokter['id_dokter'];
                    $dokter_code            = $rowSelectDataDokter['dokter_code'];
                    $dokter_type            = $rowSelectDataDokter['dokter_type'];
                    $dokter_name            = $rowSelectDataDokter['dokter_name'];
                    $dokter_address         = $rowSelectDataDokter['dokter_address'];
                    $dokter_email           = $rowSelectDataDokter['dokter_email'];
                    $dokter_phone           = $rowSelectDataDokter['dokter_phone'];
                    $outlet_code_relation   = $rowSelectDataDokter['outlet_code_relation'];
                    $ts_insert              = $rowSelectDataDokter['ts_insert'];
                    $ts_update              = $rowSelectDataDokter['ts_update'];
                    $bl_state               = $rowSelectDataDokter['bl_state'];

                ?>
                <tr id="select_dokter" style="cursor: pointer;" dokter_code="<?php echo $dokter_code; ?>" dokter_code_hide="<?php echo $dokter_code; ?>"  dokter_name="<?php echo $dokter_name ?>">
                    <td><?php echo $dokter_code; ?></td>
                    <td><?php echo $dokter_name; ?></td>
                    <td><?php echo $dokter_type; ?></td>
                    <td><?php echo $dokter_address; ?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">

    $('#buttonAddDokter').click(function() {
        $("#listDokter").modal("hide");
    });

    function insertDokter() {$("#insertDokter").show( 'clip', 800 );};

    //jika dipilih, nim akan masuk ke input dan modal di tutup
    $(document).on('click', '#select_dokter', function (e) {
        document.getElementById("dokter_code").value = $(this).attr('dokter_code');
        document.getElementById("dokter_code_hide").value = $(this).attr('dokter_code_hide');
        document.getElementById("dokter_name").value = $(this).attr('dokter_name');
        $('#listDokter').modal('hide');
        if ($('#c_selling_product_name').val() == '') {
            $('#listProduct').modal('show');
        }
        document.getElementById('c_selling_product_name').focus();
    });            

    //tabel lookup Produk
    $(function () {
        $("#lookupDokter").dataTable();
    });

</script>