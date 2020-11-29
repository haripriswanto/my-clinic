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
    
    if ($monthOption == '01') {$month = 'Januari';}
    elseif ($monthOption == '02') {$month = 'Februari';}
    elseif ($monthOption == '03') {$month = 'Maret';}
    elseif ($monthOption == '04') {$month = 'April';}
    elseif ($monthOption == '05') {$month = 'Mei';}
    elseif ($monthOption == '06') {$month = 'Juni';}
    elseif ($monthOption == '07') {$month = 'Juli';}
    elseif ($monthOption == '08') {$month = 'Agustus';}
    elseif ($monthOption == '09') {$month = 'September';}
    elseif ($monthOption == '10') {$month = 'Oktober';}
    elseif ($monthOption == '11') {$month = 'November';}
    elseif ($monthOption == '12') {$month = 'Desember';}
    
    $selectTotalProductSelling = "SELECT SUM(product_qty) AS total_item,
        substring(ts_insert from 1 for 10)  as periode 
        FROM tb_selling_transaction_detail
        WHERE ts_insert BETWEEN '".$yearOption."-".$monthOption."-01 00:00:00' AND '".$yearOption."-".$monthOption."-".$dayOption." 23:59:59' 
        AND bl_state <> 'D'
        GROUP BY periode";
    $queryTotalProductSelling = mysqli_query($config, $selectTotalProductSelling) or die( mysqli_error() );

    $arrayPeriode = array();
    $arrayTotal = array();
    while( $data = mysqli_fetch_assoc($queryTotalProductSelling)){
        $arrayPeriode[] = substr($data['periode'], 8, 2);
        $arrayTotal[] = $data['total_item'];
    } 
?>
<script>
    var ctx = document.getElementById('line_chartSellingProduct').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',
        // The data for our dataset
        data: {
            labels: <?php echo json_encode($arrayPeriode); ?>,
            datasets: [{
                label: 'Penjualan <?php echo $month." ".$yearOption; ?>',
                backgroundColor: 'transparent',
                borderColor: 'rgb(77, 232, 162)',
                data: <?php echo json_encode($arrayTotal); ?>
            }]
            // label: 'Tgl',
        },

        // Configuration options go here
        options: {}
    });
</script>


<canvas id="line_chartSellingProduct"></canvas>