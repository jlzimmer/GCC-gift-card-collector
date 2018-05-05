<?php
    if(!session_start()) {
		header("Location: ../index.php?result=badSession");
		exit;
    }
    
    $_SESSION = array();
    session_destroy();
    header("Location: ../index.php?result=sessionEnded");
    exit;
?>