<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';?>

<!DOCTYPE html>
<html>
<head>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/head.html.php'; ?>
</head>

<body>

<div class="wrap">

	<div class="ALL">
		
		<form action="?action" method="post" style="text-align: center; margin-top: 30px;">
			<input placeholder="ID" name="id" type="text" required />
			<input type="submit" value="Do it."/>
		</form>
			
	</div>
</div>

</body>
</html>