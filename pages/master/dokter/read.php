<div class="table-responsive">
  <table class="table table-hover table-striped" id="dataTable">
    <thead>
      <tr>
        <th>#</th>
        <th>Kode</th>
        <th>Nama Dokter</th>
        <th>Alamat</th>
        <th>Telp</th>
        <th>Action</th>
      </tr>
    </thead>
      <?php 
        include('../../../config/config.php');
        $query =  mysqli_query($config, " SELECT * FROM tb_master_dokter WHERE bl_state = 'A' ORDER BY dokter_name ASC");

          $number = 0;
          while ($row = mysqli_fetch_array($query)){
            $number                 = $number + 1 ;
            $id_dokter            = $row['id_dokter'];
            $dokter_code          = $row['dokter_code'];
            $dokter_type          = $row['dokter_type'];
            $dokter_name          = $row['dokter_name'];
            $dokter_address       = $row['dokter_address'];
            $dokter_email         = $row['dokter_email'];
            $dokter_phone         = $row['dokter_phone'];
            $outlet_code_relation = $row['outlet_code_relation'];
            $ts_insert            = $row['ts_insert'];
            $ts_update            = $row['ts_update'];
            $bl_state             = $row['bl_state'];

        ?>
            <tr>
              <td><?php echo $number; ?></td>
              <td><?php echo $dokter_code;?></td>
              <td data-toggle="modal" id="#buttonDetail" data-id="<?php echo $id_dokter; ?>" data-target="#detail" style="cursor: pointer;"><?php echo $dokter_name; ?></td>
              <td><?php echo $dokter_address; ?></td>
              <td><?php echo $dokter_phone; ?></td>
              <td>
                <a data-toggle="modal" data-id="<?php echo $id_dokter; ?>" href="#edit" id="#buttonEdit" title="Ubah Data" class="btn btn-xs btn-primary">
                    <span class="fa fa-pencil"></span>
                </a>
                <a data-toggle="modal" data-id="<?php echo $id_dokter; ?>" data-target="#delete" id="#buttonDelete" title="Hapus Data" class="btn btn-xs btn-danger">
                  <span class="fa fa-times"></span>
                </a>
              </td>
        </tr>   
        <?php } ?>
  </table>
</div>

<script>
  $(document).ready(function() {
      $('#dataTable').DataTable({
              responsive: true
      });
  });
</script>