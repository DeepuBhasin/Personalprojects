<?php
session_start();
session_destroy();
header('location:index.php?message='.urlencode('Logout Successfully'));

?>