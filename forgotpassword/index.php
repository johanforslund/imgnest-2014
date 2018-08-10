<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/login/index.php';
$login = new Login();

if ($login->isUserLoggedIn() == true) 
{	
	header('Location: /');	
}
$headertype = 'guest';

if ($login->messages) {
    foreach ($login->messages as $message) {
        $messages = $message;
    }
}
else
{
	$messages = '';
}

if ($login->errors) {
    foreach ($login->errors as $error) {
        $errors = $error;
    }
}
else
{
	$errors = '';
}

include 'forgotpassword.html.php';
exit();
