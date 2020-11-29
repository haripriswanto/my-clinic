
    // Datatable
    $(document).ready(function() {
        $('#dataTables').DataTable({
            responsive: true
        });
    });

    // ToolTip bootstrap
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    $(document).ready(function(){
        $("a").tooltip();
    });
    $(document).ready(function(){
        $("submit").tooltip();
    });

  $(document).ready(function(){
      // SEARCHING PRODUCT
        $('#notification_popup').on('show.bs.modal', function (e) {
            var row_id = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : '../../pages/notification/notification_popup.php',
                data :  'row_id='+ row_id,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });

      // Shopping Cart
        $('#shoppingCartPopup').on('show.bs.modal', function (e) {
            var row_id = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : '../../pages/transaction/selling/review_transaction_selling.php',
                data :  'row_id='+ row_id,
                success : function(data){
                $('.cartResult').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
