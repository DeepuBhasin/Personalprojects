<?php
//database connection
ob_start();
session_start();
$dsn = 'mysql:dbname=charger;host=localhost';
$user = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "PDO error" . $e->getMessage();
    die();
}

if (isset($_SESSION['success'])) { ?>
    <div class="alert alert-success fade in alert-msg-header">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><?php echo $_SESSION['success']; ?></strong>
    </div><?php
}
unset($_SESSION['success']);
if (isset($_SESSION['error'])) { ?>
    <div class="alert alert-danger fade in alert-msg-header">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><?php echo $_SESSION['error']; ?></strong>
    </div><?php
}
unset($_SESSION['error']);
?>