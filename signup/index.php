<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/login/register.php';
$registration = new Registration();

include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/pagination/function.php';

$headertype = 'guest';
$signuperror = '';

$username = '';
$email = '';

if(isset($_POST['register']))
{
	$username = $_POST['user_name'];
	$email = $_POST['user_email'];
}

if ($registration->errors)
{
	foreach ($registration->errors as $error)
	{
		$signuperror = $error;
	}
}

// show positive messages
if ($registration->messages)
{
	foreach ($registration->messages as $message)
	{
		$signupmessage = $message;
	}
}
if (!$registration->registration_successful && !$registration->verification_successful)
{
	include 'signup.html.php';
}
else
{
	include 'activation.html.php';
}
exit();