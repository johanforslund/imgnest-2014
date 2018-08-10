<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/login/index.php';
$login = new Login();

include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

if ($login->isUserLoggedIn() == false) 
{	
	header('Location: /');	
}

$headertype = 'user';

if(isset($_GET['delete']))
{
	try
	{
		$s = $pdo->prepare('DELETE FROM messages WHERE id = :id AND touser = :touser');
		$s->bindValue(':id', $_GET['delete']);
		$s->bindValue(':touser', $_SESSION['user_id']);
		$s->execute();
	}
	catch(PDOException $e)
	{	
		$error = 'Error removing message';
		include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
		exit();
	}
}

if(isset($_GET['messageid']))
{
	try
	{
		$s = $pdo->prepare('UPDATE messages SET beenread = 1 WHERE id = :id AND touser = :touser');
		$s->bindValue(':id', $_GET['messageid']);
		$s->bindValue(':touser', $_SESSION['user_id']);
		$s->execute();
	}
	catch(PDOException $e)
	{	
		$error = 'Unable to set message to read';
		include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
		exit();
	}	
	
	try
	{
		$result = $pdo->prepare('SELECT id, fromuser, sender, title, date, messagetext, beenread FROM messages WHERE touser = :touser AND id = :id ORDER BY date DESC');
		$result->bindValue(':touser', $_SESSION['user_id']);
		$result->bindValue(':id', $_GET['messageid']);
		$result->execute();
	}
	catch(PDOException $e)
	{
		$error = 'Unable to query sql.';
		include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
		exit();
	}
	
	$resultset = $result->fetch();
	
	$from = $resultset['sender'];
	$title = $resultset['title'];
	$messagetext = $resultset['messagetext'];
	$date = $resultset['date'];
	$id = $resultset['id'];
	$beenread = $resultset['beenread'];
	
	include 'messageoutput.html.php';
	exit();
}

try
{
	$result = $pdo->prepare('SELECT id, sender, title, date, messagetext, beenread FROM messages WHERE touser = :touser ORDER BY date DESC');
	$result->bindValue(':touser', $_SESSION['user_id']);
	$result->execute();
}
catch(PDOException $e)
{
	$error = 'Unable to query sql.';
	include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
	exit();
}

foreach($result as $row)
{
	$messages[] = array(
		'from' => $row['sender'],
		'title' => $row['title'],
		'messagetext' => $row['messagetext'],
		'date' => $row['date'],
		'beenread' => $row['beenread'],
		'id' => $row['id']);
}

include 'messages.html.php';
exit();