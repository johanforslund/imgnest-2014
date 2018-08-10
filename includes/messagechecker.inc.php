<?php

try
{
	$sql = 'SELECT id FROM messages WHERE touser = :touser AND beenread = 0';
	$s = $pdo->prepare($sql);
	$s->bindValue(':touser', $_SESSION['user_id']);
	$s->execute();
	$total = $s->rowCount();
}
catch(PDOException $e)
{
	$error = 'Error getting number of unread messages';
	include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
	exit();
}

if($total == 0)
{
	$unreadnumberstyle = 'unreadnumbertext0';
	$messageiconsrc = '/images/mail.png';
}
else if($total > 0)
{
	$unreadnumberstyle = 'unreadnumbertext';
	$messageiconsrc = '/images/mailunread.png';
}