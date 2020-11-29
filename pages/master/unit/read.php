<div class="table-responsive">
  <table class="table table-hover table-striped" id="dataUnit">
    <thead>
      <tr>
        <th>#</th>
        <th>Kode</th>
        <th>Deskripsi Satuan</th>
        <th>Action</th>
      </tr>
    </thead>
      <?php 
        include('../../../config/config.php');
        $selectDataUnit = " SELECT * FROM tb_master_unit WHERE bl_state = 'A' ORDER BY unit_description ASC";
        $querySelectDataUnit =  mysqli_query($config, $selectDataUnit);

          $number = 0;
          while ($rowSelectDataUnit = mysqli_fetch_array($querySelectDataUnit)){
            $number             = $number + 1 ;
            $idUnit             = $rowSelectDataUnit['id_unit'];
            $unit_code          = $rowSelectDataUnit['unit_code'];
            $unit_description   = $rowSelectDataUnit['unit_description'];
            $bl_state           = $rowSelectDataUnit['bl_state'];
        ?>
            <tr>
              <td><?php echo $number; ?></td>
              <td><?php echo $unit_code;?></td>
              <td><?php echo $unit_description; ?></td>
              <td>
                <a data-toggle="modal" data-id="<?php echo $idUnit; ?>" href="#edit" id="#buttonEdit" title="Ubah Data Satuan" class="btn btn-xs btn-primary">
                    <span class="fa fa-pencil"></span>
                </a>
                <a data-toggle="modal" data-id="<?php echo $idUnit; ?>" data-target="#delete" id="#buttonDelete" title="Hapus Data Satuan" class="btn btn-xs btn-danger">
                  <span class="fa fa-times"></span>
                </a>
              </td>
        </tr>   
        <?php } ?>
  </table>
</div>

<script>
  $(document).ready(function() {
      $('#dataUnit').DataTable({
              responsive: true
      });
  });
</script>