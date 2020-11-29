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
	
	$sellingPayment = "SELECT SUM(product_qty) as jml_terjual, product_code_relation as produk_code, product_name as product_name, 
    substring(ts_insert from 1 for 7) as periode 
        FROM tb_selling_transaction_detail 
        WHERE 
        ts_insert BETWEEN '".$yearOption."-".$monthOption."-01 00:00:00' AND '".$yearOption."-".$monthOption."-".$dayOption." 23:59:59'  
        AND bl_state <> 'D' 
        GROUP BY produk_code, product_name, periode 
        ORDER BY jml_terjual DESC 
        LIMIT 10
	";
    $queryTotalSellingIncome = mysqli_query($config, $sellingPayment);
?>
<script>
	var ctx = document.getElementById("bar_chartBestSellingProduct").getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: [<?php 
						$bulans = '';
						while($row0 = mysqli_fetch_array($queryTotalSellingIncome)){
						$productName = $row0['product_name'];

						if(!$bulans) {
							$bulans = '"' . $productName . '"';
						} else {   
							$bulans = $bulans . ' , ' . '"' . $productName . '"';
						}
					};
				echo($bulans);
                mysqli_data_seek($queryTotalSellingIncome, 0);
			?>],
			datasets: [{
				label: '<?php echo $yearOption; ?>',
				data: [<?php 
                             $totalIncome = '';
                             while($row1 = mysqli_fetch_array($queryTotalSellingIncome)){
                                if(!$totalIncome) {
                                   $totalIncome = "'" . $row1['jml_terjual'] . "'";
                                } else {   
                                   $totalIncome = $totalIncome . ' , ' . "'" . $row1['jml_terjual'] . "'";
                                }
                             };
                             echo($totalIncome);
                             mysqli_data_seek($queryTotalSellingIncome, 0);
                    ?>],
                    backgroundColor: [<?php 
                             $count1=0;
                             while($row2 = mysqli_fetch_array($queryTotalSellingIncome)){
                                if($count1 > 0) echo ',';
                                ?>
                                  'rgb(245, 64, 64)',
                                  'rgb(44, 161, 230)'
                                <?php
                                $count1++;
                             };
                             mysqli_data_seek($queryTotalSellingIncome, 0);
                    ?>
                    ],
                    borderColor: [<?php 
                             $count2=0;
                             while($row = mysqli_fetch_array($queryTotalSellingIncome)){
                                if($count2 > 0) echo ',';
                                ?>
                                  'rgb(207, 54, 54)',
                                  'rgb(34, 127, 181)'
                                <?php
                                $count2++;
                             };
                             mysqli_data_seek($queryTotalSellingIncome, 0);
                    ?>],
                    borderWidth: 1
                }]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					}
				}]
			}
		}
	});
</script>

<canvas id="bar_chartBestSellingProduct"></canvas>