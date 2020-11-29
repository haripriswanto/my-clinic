<?php 
  include('../../../config/config.php');
  $supplier_name = $_GET['supplier_name']; 
  // var_dump($supplier_name);exit();
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <b>Daftar Supplier!</b>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>
    <div class="panel-body">
        <table id="lookupSupplier" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Telp</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $c_name_L = mysqli_escape_string($config, strtolower($_GET['supplier_name']));
                $c_name_U = mysqli_escape_string($config, strtoupper($_GET['supplier_name']));
                $c_name_C = mysqli_escape_string($config, ucwords($c_name_L));

                $query = mysqli_query($config, "
                            SELECT * FROM tb_master_supplier 
                              WHERE (supplier_name LIKE '%$c_name_C%' OR supplier_name LIKE '%$c_name_L%') 
                              AND bl_state = 'A' AND outlet_code_relation = '$system_outlet_code'
                              ORDER BY supplier_name ASC");

              $number = 0;
              while ($row = mysqli_fetch_array($query)){
                $number                 = $number + 1 ;
                $id_supplier            = $row['id_supplier'];
                $supplier_code          = $row['supplier_code'];
                $supplier_type          = $row['supplier_type'];
                $supplier_name          = $row['supplier_name'];
                $supplier_address       = $row['supplier_address'];
                $supplier_email         = $row['supplier_email'];
                $supplier_phone         = $row['supplier_phone'];
                $website                = $row['website'];
                    ?>
                    <tr id="select_supplier" style="cursor: pointer;" supplier_code="<?php echo $supplier_code; ?>" supplier_code_hide="<?php echo $supplier_code; ?>"  supplier_name="<?php echo $supplier_name ?>">
                        <td><?php echo $supplier_code; ?></td>
                        <td><?php echo $supplier_name; ?></td>
                        <td><?php echo $supplier_address; ?></td>
                        <td><?php echo $supplier_phone; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">

//jika dipilih, nim akan masuk ke input dan modal di tutup
    $(document).on('click', '#select_supplier', function (e) {
        document.getElementById("supplier_code").value = $(this).attr('supplier_code');
        document.getElementById("supplier_code_hide").value = $(this).attr('supplier_code_hide');
        document.getElementById("supplier_name").value = $(this).attr('supplier_name');
        $('#listSupplier').modal('hide');
        document.getElementById('c_buying_product_name').focus(); 
    });            

//tabel lookup Produk
    $(function () {
        $("#lookupSupplier").dataTable();
    });

</script>