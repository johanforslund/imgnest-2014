<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>

<!DOCTYPE html>
<html>
<head>
<meta name="description" content="Whether you are in need of getting an image edited - or searching for images to edit - this is the website for you.">
<title>IMGnest - Messages</title>
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
				<?php if(isset($messages)): ?>
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
				<?php endif; ?>
					<?php if(isset($messages)): foreach($messages as $message): ?>
						
							<tr href="?messageid=<?php htmlout($message['id']); ?>" class="<?php if($message['beenread'] == 1){echo 'messages';}else{echo 'urmessages';}?>">
								<td>
									<?php if($message['beenread'] == 1)
									{
										echo '<i class="fa fa-eye"></i>';
									}
									else
									{
										echo '<i class="fa fa-eye-slash"></i>';
									}?>
								</td>
								<td><?php htmlout($message['from']); ?></td>
								<td><?php htmlout($message['title']); ?></td>
								<td style="color: #888888;"><?php echo substr(markdown2blank($message['messagetext']), 0, 75) . '...'; ?></a></td>
								<td><?php htmlout(date_format(date_create($message['date']), 'Y-m-d H:i')); ?></td>
								<td></td>
								<td><a href="?delete=<?php htmlout($message['id']); ?>"><i class="fa fa-trash-o"></i></td>
							</tr>
						</a>
					<?php endforeach;
					else:
						echo "<p class='stdtext'>Empty in here.</p>";
					endif; ?>
				<?php if(isset($messages)): ?>
				</table>
				<?php endif; ?>
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