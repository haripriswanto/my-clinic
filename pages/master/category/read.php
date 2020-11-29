<div class="table-responsive">
  <table class="table table-hover table-striped" id="dataTable">
    <thead>
      <tr>
        <th>#</th>
        <th>Kode</th>
        <th>Deskripsi Kategori</th>
        <th>Action</th>
      </tr>
    </thead>
      <?php 
        include('../../../config/config.php');

        $selectData = " SELECT * FROM tb_master_category WHERE bl_state = 'A' ORDER BY category_description ASC";
        $querySelectData =  mysqli_query($config, $selectData);

          $number = 0;
          while ($rowSelectData = mysqli_fetch_array($querySelectData)){
            $number               = $number + 1 ;
            $id_category          = $rowSelectData['id_category'];
            $category_code        = $rowSelectData['category_code'];
            $category_description = $rowSelectData['category_description'];
            $bl_state             = $rowSelectData['bl_state'];
        ?>
            <tr>
              <td><?php echo $number; ?></td>
              <td><?php echo $category_code;?></td>
              <td><?php echo $category_description; ?></td>
              <td>
                <a data-toggle="modal" data-id="<?php echo $id_category; ?>" href="#edit" id="#buttonEdit" title="Ubah Data Satuan" class="btn btn-xs btn-primary" >
                    <span class="fa fa-pencil"></span>
                </a>
                <a data-toggle="modal" data-id="<?php echo $id_category; ?>" data-target="#delete" id="#buttonDelete" title="Hapus Data Satuan" class="btn btn-xs btn-danger">
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