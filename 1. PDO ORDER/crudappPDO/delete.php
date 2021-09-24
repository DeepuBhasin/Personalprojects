<?php
include 'functions.php';
$DBH = pdo_connect_mysql();
$msg = '';

// Check that the contact ID exists
if (isset($_GET['id'])) {

    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $DBH->prepare("SELECT * FROM product_table WHERE id= {$_GET['id']} ");

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_OBJ);

    $row_id = $row->id;

    if (!$row_id) {
        exit('Brand doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $DBH->prepare("DELETE FROM product_table WHERE id= $row_id");
            $contact = $stmt->execute();
            $msg = 'You have Deleted the Brand';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>

<?= template_header('Delete') ?>

<div class="content delete">
    <h2>Delete Brand </h2>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php else : ?>
        <p>Are you sure you want to Delete <strong><?= $row->brand_name; ?> (#<?= $row_id; ?>) </strong> Brand ?</p>
        <div class="yesno">
            <a href="delete.php?id=<?= $row_id ?>&confirm=yes">Yes</a>
            <a href="delete.php?id=<?= $row_id ?>&confirm=no">No</a>
        </div>
    <?php endif; ?>
</div>

<?= template_footer() ?>