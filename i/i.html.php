<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>

<!DOCTYPE html>
<html>
<head>
<title>IMGnest - <?php htmlout($title); ?></title>
<meta name="description" content="<?php htmlout($description);?>">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/head.html.php'; ?>
</head>

<body>

<div class="wrap">

	<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/' . $headertype . 'Header.html.php'; ?>

	<div class="ALL">
			
			<div class="leftofform">
				<div class="imageview" style="background-image: url('/includes/livethumb/submittedthumb.php?src=<?php htmlout($url);?>&x=800&y=450&f=0&q=50')"></div>
			</div>
			
			<div class="rightofform">			
				<div class="imageinfo">
					<i style="color: #788081;" class="fa fa-user"></i>
					<p style="margin-right: 15px;" class="userinfo"><?php if($username!='[deleted]'):?><a href="/profile?profileid=<?php htmlout($username); ?>"><?php endif;?><?php htmlout($username);?><?php if($username!='[deleted]'):?></a><?php endif;?></p>
					<i style="color: #788081;" class="fa fa-calendar-o"></i>
					<p class="dateinfo"><?php htmlout(date_format($date, 'Y-m-d'));?></p>
					<i style="color: #788081;" class="fa fa-tag"></i>
					<p class="categoryinfo"><?php htmlout($category);?></p>
					<?php if($_SESSION['user_id']==$submitteduserid): ?>
						<i style="color: red;" class="fa fa-trash-o"></i>
						<a onClick="if(confirm('Are you sure you want to remove this picture?'))window.location='?imageid=<?php htmlout($_GET['imageid']); ?>&delete';">
							<p class="removeinfo">Remove</p>
						</a>
					<?php endif; ?>
					
					<div class="verticalline"></div>
					<h1 class="stdheader"><?php htmlout($title);?></h1>
					<div style="margin-top: 10px;" class="stdtext"><?php markdownmessageout($description);?></div>	
				</div>
				<?php if($amount>0) :?>
					<p style="position: relative; top: 20px; font-size: 13px;" class="stdtext"><strong>Note:</strong> This is a paid request. The edited images will automatically be watermarked until the uploader has payed the chosen amount of money: <strong>$<?php htmlout($amount);?></strong></p>
				<?php endif; ?>
			</div>
			<div class="clear"></div>
			<div class="downloadsubmit">
				<a href="<?php htmlout($downloadlink);?>" <?php htmlout($autodownload); ?>="<?php htmlout($downloadtext);?>"><div class="downloadsubmitbutton"><p class="downloadsubmitbuttontext">DOWNLOAD</p></div></a>
				<a href="?submit=<?php htmlout($_GET['imageid'])?>"><div style="float: right;" class="downloadsubmitbutton"><p class="downloadsubmitbuttontext" style="left: 80px;">SUBMIT</div></a>
				<div class="clear"></div>
				<div class="editinfo"></div>
			</div>
			<hr />
			<h2 class="repliestext">Replies</h2>
			<div class="submittedimagespreview">
				<?php if(isset($previewimages)): foreach($previewimages as $previewimage): ?>
					<a href="<?php echo "?editedid="; htmlout($previewimage['id'])?>">
						<div class="image" style="background-image: url('/editedthumbs/<?php htmlout($previewimage['url']);?>');">
							<?php if($amount>0): ?>
								<div class="imageamount"><i style="position: relative; top: 4px; color: #77988d" class="<?php if($previewimage['locked']==1): ?>fa fa-lock<?php else: ?>fa fa-unlock-alt<?php endif; ?>"></i></div>
							<?php endif ;?>
							<div style="top: 120px;" class="imagelabel">
								<i style="color: #464646; position: relative; top: 10px; left: 3px;" class="fa fa-user"></i>
								<p style="margin-left: 7px;" class="labeltext"><?php htmlout($previewimage['user_name']); ?></p>
								<p style="font-size: 25px; font-family: 'BebasNeue'; color: #dc4343; text-align: right; top: -15px;" class="stdtext"><?php htmlout($previewimage['likesnumber']); ?></p>
							</div>
						</div>
					</a>				
				<?php endforeach; 
				else:
					echo "<p class='stdtext'>No replies have been submitted yet. Be the first to edit this picture.</p>";?>
				<?php endif; ?>
			</div>
			
			<hr />
		
			<?php if ($login->isUserLoggedIn() == true): ?>
				<form method="post" action="?imageid=<?php htmlout($_GET['imageid']); ?>&addsubmitcomment">
					<textarea placeholder="Add a comment" style="width: 1194px; height: 120px; margin-top: 40px;" name="commenttext"></textarea>
					<input type="hidden" name="submittedid" value="<?php htmlout($_GET['imageid']); ?>" />
					<input type="submit" name="comment" class="commentbutton" value="SUBMIT COMMENT" />
				</form>
				<div class="clear"></div>
			<?php endif; ?>
			
			<?php if(isset($comments)): foreach($comments as $comment): ?>
				<div class="editcomment">
					<p <?php if($comment['fromuser'] == $username): ?> style="color: #77988d;" <?php endif; ?> class="stdtext commentusername">
						<a href="/profile/?profileid=<?php htmlout($comment['fromuser']); ?>">
							<strong><?php htmlout($comment['fromuser']); ?></strong>
						</a>
					</p>
					<p style="display: inline; font-size: 12px; color: #464646; left: 5px; top: 2px;" class="stdtext"><?php htmlout(ago($comment['date'])); ?></p>
					<div style="border-radius: 4px; margin-top: 20px; color: #464646;" class="stdtext"><?php markdownmessageout($comment['commenttext']); ?></div>
				</div>
			<?php endforeach; endif; ?>
			
		
	</div>
	
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/footer.html.php'; ?>

</body>
</html>