<?php 
  include('../../../config/config.php');
  $c_name_L = mysqli_escape_string($config, strtolower($_GET['customer_name']));
  $c_name_U = mysqli_escape_string($config, strtoupper($_GET['customer_name']));
  $c_name_C = mysqli_escape_string($config, ucwords($c_name_L));
  // var_dump($c_name_L, $c_name_U, $c_name_C);exit();
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <b>Daftar Pelanggan!</b>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>
    <div class="panel-body">
        <a data-toggle="modal" data-target='#insertCustomer' id="buttonAddCustomer" title="Tambah Data Pelanggan" class="btn btn-primary" data-backdrop="static" data-keyboard="false">
          <span class="fa fa-plus-circle"></span> Tambah Data
        </a>
        <div class="row">
            <div class="col-md-12"><hr></div>
        </div>
        <table id="lookupcustomer" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Gender</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $selectCustomer = "SELECT * FROM tb_customer 
                WHERE (full_name LIKE '%$c_name_L%' OR full_name LIKE '%$c_name_U%' OR full_name LIKE '%$c_name_C%') 
                AND bl_state = 'A' AND outlet_code_relation = '$system_outlet_code' ORDER BY full_name ASC";
                $querySelectCustomer = mysqli_query($config, $selectCustomer);

                $number = 0;
                while ($rowSelectCustomer = mysqli_fetch_array($querySelectCustomer)){
                    $number                 = $number + 1 ;
                    $id_customer            = $rowSelectCustomer['id_customer'];
                    $customer_code          = $rowSelectCustomer['customer_code'];
                    $full_name              = $rowSelectCustomer['full_name'];
                    $customer_category      = $rowSelectCustomer['customer_category'];
                    $phone                  = $rowSelectCustomer['phone'];
                    $age                    = $rowSelectCustomer['age'];
                    $address                = $rowSelectCustomer['address'];
                    $email                  = $rowSelectCustomer['email'];
                    $gender                 = $rowSelectCustomer['gender'];
                    $birthday               = $rowSelectCustomer['birthday'];
                    $outlet_code_relation   = $rowSelectCustomer['outlet_code_relation'];
                    $ts_insert              = $rowSelectCustomer['ts_insert'];
                    $ts_update              = $rowSelectCustomer['ts_update'];
                    $bl_state               = $rowSelectCustomer['ts_update'];

                    if ($gender == '1') {$gender = 'Laki-Laki';}
                    else{$gender = 'Perempuan';}
                ?>
                <tr id="select_customer" style="cursor: pointer;" customer_code="<?php echo $customer_code; ?>" customer_code_hide="<?php echo $customer_code; ?>"  customer_name="<?php echo $full_name ?>">
                    <td><?php echo $customer_code; ?></td>
                    <td><?php echo $full_name; ?></td>
                    <td><?php echo $gender; ?></td>
                    <td><?php echo $address; ?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        </div>
</div>

<script type="text/javascript">

    $('#buttonAddCustomer').click(function() {
        $("#listCustomer").modal("hide");
    });

    
  function insertCustomer() {$("#buttonAddCustomer").show( 'clip', 800 );};


    $(document).ready(function() {
        var table = $('#lookupcustomer').DataTable();
        $('#lookupcustomer tbody').on( 'click', 'tr', function () {
            $(this).toggleClass('selected');
        });
        $('#button').click( function () {
            alert( table.rows('.selected').data().length +' row(s) selected' );
        });
    });
//jika dipilih, nim akan masuk ke input dan modal di tutup
    $(document).on('click', '#select_customer', function (e) {
        document.getElementById("customer_code").value = $(this).attr('customer_code');
        document.getElementById("customer_code_hide").value = $(this).attr('customer_code_hide');
        document.getElementById("customer_name").value = $(this).attr('customer_name');
        $('#listCustomer').modal('hide');
        if ($('#dokter_code').val() == '') {
            $('#listDokter').modal('show');
        }
        document.getElementById('dokter_name').focus();
    });            

//tabel lookup Produk
    $(function () {
        $("#lookupcustomer").dataTable();
    });

</script>