<?php
	session_start();
	session_destroy();
	header('Location: fp_reg_page.php');
	exit;
?>
