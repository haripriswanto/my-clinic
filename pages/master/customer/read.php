<div class="table-responsive">
  <table class="table table-hover table-striped" id="dataCustomer">
    <thead>
      <tr>
        <th>#</th>
        <th>Kode</th>
        <th>Nama Pasien</th>
        <th>Alamat</th>
        <th>Gender</th>
        <th>Tgl Lahir</th>
        <th>Action</th>
      </tr>
    </thead>
      <?php 
        include('../../../config/config.php');
        $query =  mysqli_query($config, " SELECT * FROM tb_customer WHERE bl_state = 'A' ORDER BY id_customer ASC");

          $number = 0;
          while ($row = mysqli_fetch_array($query)){
            $number                 = $number + 1 ;
            $id_customer            = $row['id_customer'];
            $customer_code          = $row['customer_code'];
            $full_name              = $row['full_name'];
            $customer_category      = $row['customer_category'];
            $phone                  = $row['phone'];
            $age                    = $row['age'];
            $address                = $row['address'];
            $email                  = $row['email'];
            $gender                 = $row['gender'];
            $birthday               = $row['birthday'];
            $outlet_code_relation   = $row['outlet_code_relation'];
            $ts_insert              = $row['ts_insert'];
            $ts_update              = $row['ts_update'];
            $bl_state               = $row['bl_state'];

            if ($gender == '1') {
              $genders = 'Laki-Laki';
            }else{
              $genders = 'Wanita';
            }
        ?>
            <tr>
              <td><?php echo $number; ?></td>
              <td><?php echo $customer_code;?></td>
              <td data-toggle="modal" id="#buttonDetail" data-id="<?php echo $id_customer; ?>" data-target="#detail" style="cursor: pointer;"><?php echo $full_name; ?></td>
              <td><?php echo $address; ?></td>
              <td><?php echo $genders; ?></td>
              <td><?php echo $birthday; ?></td>
              <td>
                <a data-toggle="modal" data-id="<?php echo $id_customer; ?>" href="#edit" id="#buttonEdit" title="Ubah Data customer" class="btn btn-xs btn-primary">
                    <span class="fa fa-pencil"></span>
                </a>
                <a data-toggle="modal" data-id="<?php echo $id_customer; ?>" data-target="#delete" id="#buttonDelete" title="Hapus Data customer" class="btn btn-xs btn-danger">
                  <span class="fa fa-times"></span>
                </a>
              </td>
        </tr>   
        <?php } ?>
  </table>
</div>

<script>
  $(document).ready(function() {
    $('#dataCustomer').DataTable({
            responsive: true
    });
  });
</script>