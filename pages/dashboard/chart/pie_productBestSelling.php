<?php 
    include('../../../config/config.php');
    
	if ($_GET['yearOption'] != '') {
		$monthOption = $_GET['monthOption'];
        $yearOption = $_GET['yearOption'];
        $dayOption = '31';
	} elseif ($_GET['yearOption'] === '') {	
		$monthOption = date('m');
		$yearOption = date('Y');
        $dayOption = date('d', strtotime($currentDate));
    }
    
    if ($monthOption == 01) {$month = 'Januari';}
    elseif ($monthOption == 02) {$month = 'Februari';}
    elseif ($monthOption == 03) {$month = 'Maret';}
    elseif ($monthOption == 04) {$month = 'April';}
    elseif ($monthOption == 05) {$month = 'Mei';}
    elseif ($monthOption == 06) {$month = 'Juni';}
    elseif ($monthOption == 07) {$month = 'Juli';}
    elseif ($monthOption == 08) {$month = 'Agustus';}
    elseif ($monthOption == 09) {$month = 'September';}
    elseif ($monthOption == 10) {$month = 'Oktober';}
    elseif ($monthOption == 11) {$month = 'November';}
    elseif ($monthOption == 12) {$month = 'Desember';}
    
    $selectBestSelling = "SELECT SUM(product_qty) as jml_terjual, product_code_relation as produk_code, product_name as product_name, 
    substring(ts_insert from 1 for 7) as periode 
        FROM tb_selling_transaction_detail 
        WHERE 
        ts_insert BETWEEN '".$yearOption."-".$monthOption."-01 00:00:00' AND '".$yearOption."-".$monthOption."-".$dayOption." 23:59:59'  
        AND bl_state <> 'D' 
        GROUP BY produk_code, product_name, periode 
        ORDER BY jml_terjual DESC 
        LIMIT 10
    ";
    $querySelectBestSelling = mysqli_query($config, $selectBestSelling) or die( mysqli_error() );

    $arrauProduct = array();
    $arrayTotal = array();
    while( $data = mysqli_fetch_assoc($querySelectBestSelling)){
        $arrauProduct[] = $data['product_name'];
        $arrayTotal[] = $data['jml_terjual'];
    } 
?>
<script>
    var ctx = document.getElementById('chart_bestSelling').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'pie',
        // The data for our dataset
        data: {
            labels: <?php echo json_encode($arrauProduct); ?>,
            datasets: [{
                label: 'Penjualan <?php echo $month." ".$yearOption; ?>',
                backgroundColor: 'rgb(19, 235, 181)',
                borderColor: 'rgb(2, 207, 155)',
                data: <?php echo json_encode($arrayTotal); ?>
            }]
            // label: 'Tgl',
        },

        // Configuration options go here
        options: {}
    });
</script>


<canvas id="chart_bestSelling"></canvas>