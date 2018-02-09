
/* this page will unset any session variables and then end the current session and redirect the user back to the login page */
/* https://stackoverflow.com/questions/12209438/logout-button-php/12209491 */


<?php
session_start();
unset($_SESSION);
session_destroy();
session_write_close();
header('Location: /htdocs/login.php');
die;
?>