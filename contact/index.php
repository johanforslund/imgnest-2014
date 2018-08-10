<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/login/index.php';
$login = new Login();

include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/pagination/function.php';

if ($login->isUserLoggedIn() == true)
{
	$headertype = 'user';
}
else
{
	$headertype = 'guest';
}

if(isset($_POST['submit']))
{
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Host = "mail.imgnest.com";
	$mail->SMTPDebug  = 2;
	$mail->SMTPAuth = true;
	$mail->Port = 26;
	$mail->Username = "contact@imgnest.com";
	$mail->Password = "???";
	$mail->SetFrom($_POST['email'], $_POST['name']);
	$mail->Subject = 'Message from ' . $_POST['name'];
	$mail->Body = "From:" .  $_POST['name'] . "\n E-Mail: " . $_POST['email'] . "\n Message:\n" . $_POST['message'];

	$address = "contact@imgnest.com";
	$mail->AddAddress($address, 'IMGnest');

	if(!$mail->Send())
	{
		$error = 'Unable to send mail.' . $mail->ErrorInfo;
		include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
		exit();
	}
	else
	{
		header('Location: ?success');
	}
}

if(isset($_GET['success']))
{
	include 'success.html.php';
	exit();
}

include 'contact.html.php';
