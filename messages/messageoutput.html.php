<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>

<!DOCTYPE html>
<html>
<head>
<meta name="description" content="Whether you are in need of getting an image edited - or searching for images to edit - this is the website for you.">
<title>IMGnest - Message</title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/head.html.php'; ?>
</head>

<body>

<div class="wrap">

	<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/' . $headertype . 'Header.html.php'; ?>

	<div class="ALL">
			
			<div class="browseedit">
				<h1 class="stdheader" style="position: absolute;">Inbox</h1>
			</div>
			
			<div class="imagescontainer">
				<table class="messagebox">
					<tr>
						<th></th>
						<th>From</th>
						<th>Title</th>
						<th>Message</th>
						<th>Date</th>
						<th></th>
						<th></th>
					</tr>
						<tr href="?messageid=<?php htmlout($id); ?>" class="messages">
							<td></td>
							<td><?php htmlout($from); ?></td>
							<td><?php htmlout($title); ?></td>
							<td style="color: #888888;"><?php echo substr(markdown2blank($messagetext), 0, 75) . '...'; ?></a></td>
							<td><?php htmlout(date_format(date_create($date), 'Y-m-d H:i')); ?></td>
							<td></td>
							<td></td>
						</tr>
				</table>
				<div class="messageoutput">
					<h1><?php htmlout($title); ?></h1>
					<p><?php markdownout($messagetext); ?></p>
					
				</div>
			</div>
			
			
	</div>
	
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/footer.html.php'; ?>

<script>
	$('tr').click(function() {
		if($(this).attr('href') !== undefined)
	{
		document.location = $(this).attr('href');
	}
	});
</script>

</body>
</html>