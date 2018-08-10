<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>

<!DOCTYPE html>
<html>
<head>
<meta name="description" content="<?php htmlout($submitteddescription);?>">
<meta property="og:image" content="http://www.imgnest.com/editedimages/<?php htmlout($editedurl); ?>" />
<title>IMGnest - <?php htmlout($submittedtitle); ?></title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/head.html.php'; ?>
</head>

<body>

<div class="wrap">

	<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/' . $headertype . 'Header.html.php'; ?>

	<div class="ALL">
			
			<h1 style="margin-bottom: 15px; text-align: left;" class="stdheader"><a href="/i/?imageid=<?php htmlout($submittedid); ?>"><?php htmlout($submittedtitle); ?></a></h1>
			<div style="margin-top: 10px; margin-bottom: 10px;" class="stdtext"><?php markdownmessageout($submitteddescription);?></div>
			<hr />
			<?php if($submittedamount>0): ?>
				<?php if($_SESSION['user_id']==$submitteduserid): ?>
					<p style="font-size: 13px;" class="stdtext"><strong>Note:</strong> This is a paid request. The edited image will automatically be watermarked until you has payed the chosen amount of money: $<?php htmlout($submittedamount); ?>. <br /><a class="unlocktext" href=""><i class="fa fa-unlock-alt"></i> <strong>Unlock this edit here</strong></a></p>
				<?php else: ?>
					<p style="font-size: 13px;" class="stdtext"><strong>Note:</strong> This is a paid request. The edited image will automatically be watermarked until the uploader has payed the chosen amount of money: <strong>$<?php htmlout($submittedamount); ?></strong></p>
				<?php endif ;?>
				<hr />
			<?php endif ;?>
			
			<div class="leftofedited">
					
					<h2><a href="/i/?imageid=<?php htmlout($submittedid); ?>">Original</a></h2>
					<i style="color: #788081; position: relative;" class="fa fa-user"></i>
					<p class="userinfo"><?php if($submittedusername!='[deleted]'):?><a href="/profile?profileid=<?php htmlout($submittedusername); ?>"><?php endif;?><?php htmlout($submittedusername);?><?php if($submittedusername!='[deleted]'):?></a><?php endif;?></p><p style="display: inline; font-family: 'Pathway Gothic One'; color: #dc4343; margin-right: 10px; margin-left: 3px;">[<?php htmlout($submitteduserlikes); ?>]</p>
					<i style="color: #788081; position: relative;" class="fa fa-calendar-o"></i>
					<p class="dateinfo"><?php htmlout(date_format($submitteddate, 'Y-m-d'));?></p>
					
					<a target="_blank" href="/submittedimages/<?php htmlout($submittedurl); ?>">
						<div class="editedimageview" style="background-image: url('/includes/livethumb/submittedthumb.php?src=<?php htmlout($submittedurl); ?>&x=550&y=450&f=0&q=50');"></div>
					</a>
			</div>
			
			<div class="rightofedited">
			
				<h2>Edited<?php if($editedlocked==1):?><i style="position: relative; top: 3px; left: 5px; font-size: 27px;" class="fa fa-lock"></i><?php endif; ?></h2>
				<i style="color: #788081; position: relative;" class="fa fa-user"></i>
				<p class="userinfo"><?php if($editedusername!='[deleted]'):?><a href="/profile?profileid=<?php htmlout($editedusername); ?>"><?php endif;?><?php htmlout($editedusername);?><?php if($editedusername!='[deleted]'):?></a><?php endif;?></p><p style="display: inline; font-family: 'Pathway Gothic One'; color: #dc4343; margin-right: 10px; margin-left: 3px;">[<?php htmlout($edituserlikes); ?>]</p>
				<i style="color: #788081; position: relative;" class="fa fa-calendar-o"></i>
				<p class="dateinfo"><?php htmlout(date_format($editeddate, 'Y-m-d'));?></p>
				
				<a target="_blank" href="/<?php if($editedlocked==0): ?>editedimages<?php else: ?>lockedimages<?php endif; ?>/<?php htmlout($editedurl); ?>">
					<?php if($editedlocked==0): ?>
						<div class="editedimageview" style="background-image: url('/includes/livethumb/editedthumb.php?src=<?php htmlout($editedurl); ?>&x=550&y=450&f=0&q=50');"></div>
					<?php else: ?>
						<div class="editedimageview" style="background-image: url('/lockedimages/<?php htmlout($editedurl);?>');"></div>
					 <?php endif; ?>
				</a>
				
				
				
			</div>
			<div class="clear"></div>
			
			<?php if($_SESSION['user_id']==$editeduserid): ?>
					<div class="likewrap">
						<a onClick="if(confirm('Are you sure you want to remove this picture?'))window.location='?editedid=<?php htmlout($_GET['editedid']); ?>&delete';">
							<div style="width: 95px;" class="likebutton">
								<p class="liketext">DELETE</p>
								<i class="fa fa-trash-o likeheart"></i>
							</div>
						</a>
					</div>
				<?php endif; ?>
				
				<?php if ($login->isUserLoggedIn() == true): ?>
					<div class="likewrap">
						<p class="likenumber"><?php htmlout($likesnumber); ?></p>
						<a href="?editedid=<?php htmlout($_GET['editedid']); ?>&like">
							<div class="likebutton">
								<?php if($mylikes==0 && ($_SESSION['user_id'] != $editeduserid)): ?>
									<p class="liketext">LIKE</p>
									<i class="fa fa-star likeheart"></i>
								<?php else: ?>
									<p style="color: #dc4343" class="liketext">LIKE</p>
									<i style="color: #dc4343" class="fa fa-star likeheart"></i>
								<?php endif; ?>
							</div>
						</a>
					</div>
				<?php 
				else: ?>
					<div class="likewrap">
						<p class="likenumber"><?php htmlout($likesnumber); ?></p>
						<a href="/signup">
							<div class="likebutton">
								<p style="color: #dc4343" class="liketext">LIKE</p>
								<i style="color: #dc4343" class="fa fa-star likeheart"></i>
							</div>
						</a>
					</div>
				<?php endif; ?>
			
			<div class="shares">
				<span class='st_facebook_large' displayText='Facebook'></span>
				<span class='st_twitter_large' displayText='Tweet' st_via="IMGnest" st_title="<?php htmlout($editedusername);?> edited an image on IMGnest - '<?php htmlout($submittedtitle);?>':"></span>
				<span class='st_email_large' displayText='Email'></span>
			</div>
				
			<div class="clear"></div>
			
			
			
			<hr />
			<h2 style="margin-top: 0; margin-bottom: 8px;" class="repliestext">Replies</h2>
			
			<div class="submittedimagespreview">
				<?php foreach($previewimages as $previewimage): ?>
					<a href="<?php echo "?editedid="; htmlout($previewimage['id'])?>">
						<?php if($_GET['editedid'] == $previewimage['id']) :?>
							<div class="image" style="margin-bottom: 0; width: 205px; height: 145px; border: 5px solid #77988d; background-image: url('/editedthumbs/<?php htmlout($previewimage['url']);?>');">
								<?php if($submittedamount>0): ?>
									<div class="imageamount"><i style="position: relative; top: 4px; color: #77988d" class="<?php if($editedlocked==1): ?>fa fa-lock<?php else: ?>fa fa-unlock-alt<?php endif; ?>"></i></div>
								<?php endif ;?>
								<div style="top: 110px;" class="imagelabel">
									<i style="color: #464646; position: relative; top: 10px; left: 3px;" class="fa fa-user"></i>
									<p style="margin-left: 7px;" class="labeltext"><?php htmlout($previewimage['user_name']); ?></p>
									<p style="font-size: 25px; font-family: 'BebasNeue'; color: #dc4343; text-align: right; top: -15px;" class="stdtext"><?php htmlout($previewimage['likesnumber']); ?></p>
								</div>
							</div>
						<?php else : ?>
							<div class="image" style="margin-bottom: 0; background-image: url('/editedthumbs/<?php htmlout($previewimage['url']);?>');">
								<?php if($submittedamount>0): ?>
									<div class="imageamount"><i style="position: relative; top: 4px; color: #77988d" class="<?php if($editedlocked==1): ?>fa fa-lock<?php else: ?>fa fa-unlock-alt<?php endif; ?>"></i></div>
								<?php endif ;?>
								<div style="top: 120px;" class="imagelabel">
									<i style="color: #464646; position: relative; top: 10px; left: 3px;" class="fa fa-user"></i>
									<p style="margin-left: 7px;" class="labeltext"><?php htmlout($previewimage['user_name']); ?></p>
									<p style="font-size: 25px; font-family: 'BebasNeue'; color: #dc4343; text-align: right; top: -15px;" class="stdtext"><?php htmlout($previewimage['likesnumber']); ?></p>
								</div>
							</div>
						<?php endif; ?>
					</a>
				<?php endforeach; ?>
			</div>
			
			<hr />
		
			<?php if ($login->isUserLoggedIn() == true): ?>
				<form method="post" action="?editedid=<?php htmlout($_GET['editedid']); ?>&addeditcomment">
					<textarea placeholder="Add a comment" style="width: 1194px; height: 120px; margin-top: 40px;" name="commenttext"></textarea>
					<input type="hidden" name="editedid" value="<?php htmlout($_GET['editedid']); ?>" />
					<input type="submit" name="comment" class="commentbutton" value="SUBMIT COMMENT" />
				</form>
				<div class="clear"></div>
			<?php endif; ?>
			
			<?php if(isset($comments)): foreach($comments as $comment): ?>
				<div class="editcomment">
					<p <?php if($comment['fromuser'] == $editedusername): ?> style="color: #77988d;" <?php endif; ?> class="stdtext commentusername">
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