<?php include('../../../../config/config.php'); ?>

<table class="table table-hover table-responsive" id="dataPreview">
    <thead>
        <tr>
            <th>#</th>
            <th>Tgl Transaksi</th>
            <th>Invoice</th>
            <th>Supplier</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php

      $tgl_awal   = mysqli_escape_string($config, $_GET['tgl_awal']);
      $tgl_akhir  = mysqli_escape_string($config, $_GET['tgl_akhir']);
      $status     = mysqli_escape_string($config, $_GET['status']);

      if(!empty($tgl_awal) && !empty($tgl_akhir)){
        $tanggalAwal  = date('Y-m-d', strtotime($tgl_awal." 00:00:00"));
        $tanggalAkhir = date('Y-m-d', strtotime($tgl_akhir." 23:59:59"));        
        $filter = "tb_buying_transaction.date_insert BETWEEN '$tanggalAwal' AND '$tanggalAkhir' AND ";
      }elseif (empty($tgl_awal) && empty($tgl_akhir)) {
        $tanggalAwal  = '';
        $tanggalAkhir = '';       
        $filter = "tb_buying_transaction.date_insert = '$currentDate' AND";
      }
      // var_dump($tanggalAwal, $tanggalAkhir, $tgl_awal, $tgl_akhir);

      $selectDataTransaction = "SELECT * FROM tb_buying_transaction 
      INNER JOIN tb_buying_payment
      ON tb_buying_transaction.invoice_number = tb_buying_payment.invoice_number_relation 
      WHERE $filter tb_buying_transaction.outlet_code_relation = '$system_outlet_code' AND tb_buying_transaction.bl_state = '$status' ORDER BY tb_buying_transaction.ts_insert DESC";
      
      $querySelectDataTransaction =  mysqli_query($config, $selectDataTransaction);
      $cekqty = mysqli_num_rows($querySelectDataTransaction);
      $number = 0;
          while ($rowSelectDataTransaction = mysqli_fetch_array($querySelectDataTransaction)){
            $number                 = $number+1;
            $id_buying_transaction  = $rowSelectDataTransaction['id_buying_transaction'];
            $invoice_number         = $rowSelectDataTransaction['invoice_number'];
            $queue_number           = $rowSelectDataTransaction['queue_number'];
            $supplier_code_relation = $rowSelectDataTransaction['supplier_code_relation'];
            $supplier_description   = $rowSelectDataTransaction['supplier_description'];
            $total_item             = number_format($rowSelectDataTransaction['total_item']);
            $total_paid             = number_format($rowSelectDataTransaction['total_paid']);
            $date_insert            = $rowSelectDataTransaction['date_insert'];
            $time_insert            = $rowSelectDataTransaction['time_insert'];
            $ts_insert              = $rowSelectDataTransaction['ts_insert'];
            $ts_update              = $rowSelectDataTransaction['ts_update'];
            $note                   = $rowSelectDataTransaction['note'];
            $user_code_relation     = $rowSelectDataTransaction['user_code_relation'];
            $type_of_payment        = $rowSelectDataTransaction['type_of_payment'];
      ?>
           
       <tr>
					<td><?php echo $number ?></td>
          <td><?php echo $date_insert." ".$time_insert; ?></td>
					<td><?php echo $invoice_number ?></td>
					<td><?php echo $supplier_description;?></td>
          <td class="text-center"><?php echo $total_item; ?></td>
					<td class="text-center"><?php echo 'Rp. '.$total_paid; ?></td>
          <td class="text-center">
              <button class="btn btn-info btn-xs" data-toggle="modal" data-target='#detailTransaction' data-id="<?php echo $invoice_number ?>" data-toggle="tooltip" data-placement="bottom" title="Detail Transaksi '<?php echo $invoice_number ?>'" id="buttonDetailTransaction"><i class="fa fa-list"></i></button>
            <?php if ($status == 'A') { ?>

              <!-- <a href="<?php echo $base_url."pages/transaction/buying/preview/print.php?invoice_number=".$invoice_number."&type=transaction-details" ?>" target='blank' class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="Cetak Detail Transaksi '<?php echo $invoice_number ?>'"><i class="fa fa-print"></i></a> -->

              <a href="<?php echo $base_url."pages/transaction/buying/preview/print.php?type=Detail&invoice_number=".$invoice_number."&supplier=".$supplier_description."&date=".$date_insert."&time=".$time_insert."&ts_insert=".$ts_insert."&ts_update=".$ts_update."&user=".$user_code_relation."&payment=".$type_of_payment ?>" target='blank' class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="Cetak Detail Transaksi '<?php echo $invoice_number ?>'"><i class="fa fa-print"></i></a>

              <button class="btn btn-danger btn-xs" data-toggle="modal" data-target='#deleteTransactionConfirm' data-id="<?php echo $invoice_number ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus Transaksi '<?php echo $invoice_number ?>'" id="buttonDeleteTransaction"><i class="fa fa-times"></i></button>
            <?php } ?>
          </td>
      </tr>
          <?php } ?>
      </tbody>
  </table>

<script type="text/javascript">
  enabledForm();
  $("#dataPreview").dataTable();
</script>