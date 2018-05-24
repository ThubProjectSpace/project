<?php
	session_start();

	// STORING THE SESSION VARIABLES
	if (!isset($_SESSION['id'])) {
	   echo "<script>location.href='index.php'</script>";
	}
?>