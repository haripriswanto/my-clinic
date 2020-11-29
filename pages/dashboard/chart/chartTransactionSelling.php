<?php 
	include('../../../config/config.php');

	if ($_GET['yearOption'] != '') {
		$monthOption = $_GET['monthOption'];
		$yearOption = $_GET['yearOption'];
	} elseif ($_GET['yearOption'] === '') {	
		$monthOption = date('m');
		$yearOption = date('Y');
	}

	$sellingTransaction = "SELECT SUM(product_qty) AS total_item,
		substring(ts_insert::text from 1 for 7)  as periode 
		FROM tb_selling_transaction_detail
		WHERE ts_insert BETWEEN '".$yearOption."-".$monthOption."-01 00:00:00' AND '".$yearOption."-".$monthOption."-31 23:59:59' 
		AND bl_state <> 'D'
		GROUP BY periode
	";
	$querySellingTransaction = mysqli_query($config, $sellingTransaction);
	$rowSellingTransaction = mysqli_fetch_array($querySellingTransaction);
?>
<canvas id="chart_sellingTransaction" width="300" height="300"></canvas>

<script>
	var ctx = document.getElementById("chart_sellingTransaction").getContext('2d');
	var myBarChart = new Chart(ctxB, {
		type: 'bar',
		data: {
			labels: [<?php 
					$bulan = '';
					while($rowSellingTransaction = mysqli_fetch_array($result)){
					$bln = $rowSellingTransaction['periode'];
					switch ($bln) {
						case ''.$year.'-01':
							$bulans = 'Januari' ;
							break;
						case ''.$year.'-02':
							$bulans = 'Februari' ;
							break;
						case ''.$year.'-03':
							$bulans = 'Maret' ;
							break;
						case ''.$year.'-04':
							$bulans = 'April' ;
							break;
						case ''.$year.'-05':
							$bulans = 'Mei' ;
							break;
						case ''.$year.'-06':
							$bulans = 'Juni' ;
							break;
						case ''.$year.'-07':
							$bulans = 'Juli' ;
							break;
						case ''.$year.'-08':
							$bulans = 'Agustus' ;
							break;
						case ''.$year.'-09':
							$bulans = 'September' ;
							break;
						case ''.$year.'-10':
							$bulans = 'Oktober' ;
							break;
						case ''.$year.'-11':
							$bulans = 'November' ;
							break;
						case ''.$year.'-12':
							$bulans = 'Desember' ;
							break;
						default:
							$bulans = 'Bulan Tidak Ada';
							break;
					}


					if(!$bulan) {
						$bulan = '"' . $bulans . '"';
					} else {   
						$bulan = $bulan . ' , ' . '"' . $bulans . '"';
					}
					};
					echo($bulan);
					mysqli_data_seek($result, 0);
                ?>],
			datasets: [{
				label: 'Total Transaksi Penjualan',
				data: <?php 
						$total = '';
						while($rowSellingTransaction = mysqli_fetch_array($result)){
						if(!$total) {
							$total = "'" . $rowSellingTransaction['total'] . "'";
						} else {   
							$total = $total . ' , ' . "'" . $rowSellingTransaction['total'] . "'";
						}
						};
						echo($total);
						mysqli_result_seek($result, 0);
					?>],
				backgroundColor: [<?php 
						$count=0;
						while($rowSellingTransaction = mysqli_fetch_array($result)){
							if($count > 0) echo ',';
							?>
							'rgb(65, 205, 244)',
							'rgb(52, 237, 175)'
							<?php
							$count++;
						};
						mysqli_result_seek($result, 0);
                    ?>],
				borderColor: [<?php 
						$count=0;
						while($rowSellingTransaction = mysqli_fetch_array($result)){
						if($count>0) echo ',';
						?>
							'rgb(29, 162, 198)',
							'rgb(35, 168, 123)'
						<?php
						$count++;
						};
						mysqli_result_seek($result, 0);
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