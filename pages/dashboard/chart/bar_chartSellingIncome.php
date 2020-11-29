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
	
	$sellingPayment = "SELECT SUM(total_paid) AS total_income,
		substring(date_insert from 1 for 7)  as periode 
		FROM tb_selling_payment
		WHERE 
			date_insert >= '".$yearOption."-01-01' AND time_insert >= '00:00:00' 
			AND date_insert <= '".$yearOption."-".$monthOption."-".$dayOption."' AND time_insert <= '23:59:59' 
			AND bl_state <> 'D'
			GROUP BY periode
	";
    $queryTotalSellingIncome = mysqli_query($config, $sellingPayment);
?>
<script>
	var ctx = document.getElementById("chart_sellingPayment").getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: [<?php 
						$bulan = '';
						while($row0 = mysqli_fetch_array($queryTotalSellingIncome)){
						$bln = $row0['periode'];
						switch ($bln) {
							case ''.$yearOption.'-01':
								$bulans = 'Januari' ;
								break;
							case ''.$yearOption.'-02':
								$bulans = 'Februari' ;
								break;
							case ''.$yearOption.'-03':
								$bulans = 'Maret' ;
								break;
							case ''.$yearOption.'-04':
								$bulans = 'April' ;
								break;
							case ''.$yearOption.'-05':
								$bulans = 'Mei' ;
								break;
							case ''.$yearOption.'-06':
								$bulans = 'Juni' ;
								break;
							case ''.$yearOption.'-07':
								$bulans = 'Juli' ;
								break;
							case ''.$yearOption.'-08':
								$bulans = 'Agustus' ;
								break;
							case ''.$yearOption.'-09':
								$bulans = 'September' ;
								break;
							case ''.$yearOption.'-10':
								$bulans = 'Oktober' ;
								break;
							case ''.$yearOption.'-11':
								$bulans = 'November' ;
								break;
							case ''.$yearOption.'-12':
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
						mysqli_data_seek($queryTotalSellingIncome, 0);
			?>],
			datasets: [{
				label: '<?php echo $yearOption; ?>',
				data: [<?php 
                             $totalIncome = '';
                             while($row1 = mysqli_fetch_array($queryTotalSellingIncome)){
                                if(!$totalIncome) {
                                   $totalIncome = "'" . $row1['total_income'] . "'";
                                } else {   
                                   $totalIncome = $totalIncome . ' , ' . "'" . $row1['total_income'] . "'";
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
                                  'rgb(8, 129, 204)',
                                  'rgb(2, 199, 199)'
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
                                  'rgb(6, 98, 156)',
                                  'rgb(3, 168, 168)'
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

<canvas id="chart_sellingPayment"></canvas>