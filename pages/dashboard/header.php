
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title"><?php echo "$ucapan"; if ($_SESSION['login']['gender'] == 1) { echo " Mr. ";} elseif ($_SESSION['login']['gender'] == 2) { echo " Mrs. ";} ?> <b class="full_name"><?php echo $_SESSION['login']['full_name']; ?></b></h3>
	</div>
	<div class="panel-body">
		<h2><?php echo $system_dashboard_text; ?></h2>
	</div>
</div>
