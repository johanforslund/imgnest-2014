<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/login/index.php';
$login = new Login();

if ($login->passwordResetWasSuccessful() == true && $login->passwordResetLinkIsValid() != true)
{
    header('Location: /login');
}
else
{
    $headertype = 'guest';
	include 'forgotpassword.html.php';
}
