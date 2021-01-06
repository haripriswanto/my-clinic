<?php include('../../../config/config.php'); ?>

<div class="table-responsive">
  <table class="table table-active table-hover" id="listPatients">
    <thead>
      <tr>
        <th>

          <div class="checkbox">
            <input type="checkbox" value="">
          </div>

        </th>
        <th>MR</th>
        <th>Nama Pasien</th>
        <th>Tgl Lahir</th>
        <th>Umur</th>
        <th>jenis Pelayanan</th>
        <th>Tgl Masuk</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <!-- <tr>
        <td>1</td>
        <td>Static</td>
        <td>Static</td>
        <td>Static</td>
        <td>Static</td>
        <td>Static</td>
        <td>Static</td>
      </tr> -->
      <?php
      $selectlistPatients = "SELECT * FROM tb_patient_active ORDER BY tb_patient_active.ts_insert DESC";

      // var_dump($selectlistPatients);exit();

      $querySelectlistPatients =  mysqli_query($config, $selectlistPatients);
      $cekqty = mysqli_num_rows($querySelectlistPatients);
      $number = 0;
      $total_item_ = 0;
      $total_harga_result = 0;
      if ($cekqty < 1) {
      ?>
        <tr>
          <td colspan="7">
            <div class="alert alert-danger text-center">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <strong>Pasien beum ada!</strong>
            </div>
          </td>
        </tr>
        <?php
      } else {
        while ($rowSelectlistPatients = mysqli_fetch_array($querySelectlistPatients)) {
          $number                 = $number + 1;

          $tanggal = new DateTime($rowSelectlistPatients['tgl_lahir']);
          $today = new DateTime('today');
          $y = $today->diff($tanggal)->y;
          $m = $today->diff($tanggal)->m;
          $d = $today->diff($tanggal)->d;
        ?>

          <tr id="selectProductCart" style="cursor: pointer;" data-mr="<?= $rowSelectlistPatients['mr'] ?>" data-nama="<?= $rowSelectlistPatients['nama_lengkap']; ?>" data-umur="<?= $rowSelectlistPatients['tgl_lahir']; ?>" data-department="<?= $rowSelectlistPatients['nama_department']; ?>" data-date="<?= $rowSelectlistPatients['ts_insert']; ?>">
            <td>
              <div class="checkbox">
                <input type="checkbox" value="">
              </div>
              <?= $number ?>
            </td>
            <td><?= $rowSelectlistPatients['mr'] ?></td>
            <td title="Double Klik Untuk Detail Data Pasien : <?= $rowSelectlistPatients['nama_lengkap'] ?>"><?= $rowSelectlistPatients['nama_lengkap']; ?></td>
            <td><?= $rowSelectlistPatients['tgl_lahir']; ?></td>
            <td><?= "( " . $y . " )" ?></td>
            <td><?= $rowSelectlistPatients['nama_department']; ?></td>
            <td><?= $rowSelectlistPatients['ts_insert']; ?></td>
            <td class="center">
              <a data-toggle="modal" data-target='#cancelRegistration' data-id="<?= $rowSelectlistPatients['id'] ?>" data-placement="right" title="Hapus Item <?= $rowSelectlistPatients['nama_lengkap'] ?>" id="buttonDeleteItem"><i class="fa fa-2x fa-trash"></i></a>
            </td>
          </tr>
      <?php
        }
      }
      ?>
    </tbody>
    <input type="hidden" name="total_harga_" id="total_harga_" value="<?= $total_harga_result ?>">
    <input type="hidden" name="total_item_" id="total_item_" value="<?= $total_item_ ?>">
  </table>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $("#listPatients").dataTable();

    $('#listPatients tbody').on('click', 'tr', function() {
      $(this).toggleClass('selected');
    });
  });
</script>