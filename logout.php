<?php
require 'includes/db_config.php';

// Destroy session
session_destroy();

// Redirect to login
header('Location: login.php');
exit();
?>
