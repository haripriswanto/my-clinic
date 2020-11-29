
<?php 
  include('../../../config/config.php');
  $querySelectSetting =  mysqli_query($config, " SELECT * FROM tb_system_setting ");

    $number = 0;
    while ($rowDataSetting = mysqli_fetch_array($querySelectSetting)){
      $number                 = $number + 1 ;
      $id_system              = $rowDataSetting['id_system'];
      $system_title           = $rowDataSetting['system_title'];
      $system_header          = $rowDataSetting['system_header'];
      $system_dashboard_text  = $rowDataSetting['system_dashboard_text'];
      $system_instansi_name   = $rowDataSetting['system_instansi_name'];
      $system_owner           = $rowDataSetting['system_owner'];
      $system_phone           = $rowDataSetting['system_phone'];
      $system_address         = $rowDataSetting['system_address'];
      $system_email           = $rowDataSetting['system_email'];
      $system_url             = $rowDataSetting['system_url'];
      $system_outlet_code     = $rowDataSetting['system_outlet_code'];
      $system_footer_struct   = $rowDataSetting['system_footer_struct'];
    }

  ?>

<table class="table table-hover table-striped" id="dataSetting">
  <thead>
    <tr>
      <th>#</th>
      <th>Nama Toko</th>
      <th>Telp</th>
      <th>Alamat</th>
      <th>Email</th>
      <th>URL</th>
    </tr>
  </thead>
  <tr>
    <td><?php echo $number ?></td>
    <td><?php echo $system_instansi_name ; ?></td>
    <td><?php echo $system_phone ; ?></td>
    <td><?php echo $system_address ; ?></td>
    <td><?php echo $system_email ; ?></td>
    <td><?php echo $system_url ; ?></td>                      
  </tr> 
</table>

<script type="text/javascript">
  // Datatable
  $(document).ready(function() {
      $('#dataSetting').DataTable({
          responsive: true
      });
  });
</script>