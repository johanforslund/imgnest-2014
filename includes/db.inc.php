<?php
try
{
	$pdo = new PDO('mysql:host=localhost;dbname=imgnest', '???', '???');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->exec('SET NAMES "utf8"');
}
catch (PDOException $e)
{
	$error = 'Unable to connect to the database server.';
	include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
	exit();
}
