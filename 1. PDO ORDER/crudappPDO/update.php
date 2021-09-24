<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (isset($_POST['update'])) {

        if (!empty($_POST['brand_name']) && !empty($_POST['model_name']) && !empty($_POST['size_name'])) {

            $brand_name = $_POST['brand_name'];
            $model_name = $_POST['model_name'];
            $size_name = $_POST['size_name'];

            $stmt = $pdo->prepare("UPDATE product_table set brand_name='$brand_name',model_name='$model_name',size_name='$size_name' Where id={$_GET['id']}");
            if ($stmt->execute()) {
                $msg =  "<h2>Brand Updated Successfully<h2>";
            } else {
                $msg =  "<h2>Database Error</h2>";
            }
        }
    }

    $stmt = $pdo->prepare("SELECT * FROM product_table WHERE id = '{$_GET['id']}'");
    $stmt->execute();
    $brands = $stmt->fetch(PDO::FETCH_OBJ);
    if (!$brands) {
        exit('Brand doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>

<?= template_header('Read') ?>

<div class="content update">
    <h2>Update Brand <?= $brands->brand_name ?> ( #<?= $brands->id; ?>)</h2>
    <form action="update.php?id=<?= $brands->id; ?>" method="post">
        <label for="brand_name">Brand</label>
        <input type="text" name="brand_name" placeholder="Enter Brand name" id="brand_name" required="" value="<?= $brands->brand_name ?>">
        <label for="model_name">Model</label>
        <input type="text" name="model_name" placeholder="Enter Model name" id="model_name" required="" value="<?= $brands->model_name ?>">
        <label for="size_name">Size</label>
        <input type="text" name="size_name" placeholder="Enter Size name" id="size_name" required="" value="<?= $brands->size_name ?>">
        <input type="submit" value="Update" name="update">
    </form>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>

<?= template_footer() ?>