<div class="table-responsive">
  <table class="table table-hover table-striped" id="dataSupplier">
    <thead>
      <tr>
        <th>#</th>
        <th>Kode</th>
        <th>Nama Supplier</th>
        <th>Alamat</th>
        <th>Telp</th>
        <th>Action</th>
      </tr>
    </thead>
      <?php 
        include('../../../config/config.php');
        $query =  mysqli_query($config, " SELECT * FROM tb_master_supplier WHERE bl_state = 'A' ORDER BY id_supplier ASC");

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
            $outlet_code_relation   = $row['outlet_code_relation'];
            $ts_insert              = $row['ts_insert'];
            $ts_update              = $row['ts_update'];
            $bl_state               = $row['bl_state'];

        ?>
            <tr>
              <td><?php echo $number; ?></td>
              <td><?php echo $supplier_code;?></td>
              <td data-toggle="modal" id="#buttonDetail" data-id="<?php echo $id_supplier; ?>" data-target="#detail" style="cursor: pointer;"><?php echo $supplier_name; ?></td>
              <td><?php echo $supplier_address; ?></td>
              <td><?php echo $supplier_phone; ?></td>
              <td>
                <a data-toggle="modal" data-id="<?php echo $id_supplier; ?>" href="#edit" id="#buttonEdit" title="Ubah Data supplier" class="btn btn-xs btn-primary">
                    <span class="fa fa-pencil"></span>
                </a>
                <a data-toggle="modal" data-id="<?php echo $id_supplier; ?>" data-target="#delete" id="#buttonDelete" title="Hapus Data supplier" class="btn btn-xs btn-danger">
                  <span class="fa fa-times"></span>
                </a>
              </td>
        </tr>   
        <?php } ?>
  </table>
</div>

<script>
  $(document).ready(function() {
      $('#dataSupplier').DataTable({
              responsive: true
      });
  });
</script>