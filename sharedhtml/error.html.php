<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';?>

<!DOCTYPE html>
<html>
<head>
<title>IMGnest - Error Page</title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/head.html.php'; ?>
</head>

<body>

<div class="wrap">

	<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/' . $headertype . 'Header.html.php'; ?>

	<div class="ALL">
		
		<i style="color: #d53030; position:relative; top: -3px; font-size: 40px;" class="fa fa-exclamation-triangle"></i><h1 style="color: #d53030; display: inline-block;" class="stdheader">ERROR</h1><br />
		<p class="stdtext"><?php htmlout($error); ?></p>
			
	</div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/footer.html.php'; ?>

</body>
</html>