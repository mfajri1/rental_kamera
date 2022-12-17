<?php 
	include "lib/koneksi.php";
	include "lib/config_web.php";

	session_start();
	unset ($_SESSION['username']);
	unset ($_SESSION['role']);
	unset ($_SESSION['name']);
	unset ($_SESSION['status']);
	unset ($_SESSION['foto']);
	session_destroy();
	 
	header('Location: ' . $admin_url);

?>