<?php
require $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

if(isset($_GET['action']))
{
	try
	{
		$sql = 'DELETE FROM submittedimages WHERE id = :id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':id', $_POST['id']);
		$s->execute();
	}
	catch(PDOException $e)
	{
		echo 'Error';
	}
	
	try
	{
		$sql = 'DELETE FROM editedimages WHERE submittedimage = :submittedimage';
		$s = $pdo->prepare($sql);
		$s->bindValue(':submittedimage', $_POST['id']);
		$s->execute();
	}
	catch(PDOException $e)
	{
		echo 'Error';
	}
	echo 'Success';
}

include 'removeimage.html.php';