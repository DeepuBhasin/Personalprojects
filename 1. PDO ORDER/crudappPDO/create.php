<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_POST['create'])) {

    if (!empty($_POST['brand_name']) && !empty($_POST['model_name']) && !empty($_POST['size_name'])) {

        $brand_name = $_POST['brand_name'];
        $model_name = $_POST['model_name'];
        $size_name = $_POST['size_name'];

        $stmt = $pdo->prepare('INSERT INTO product_table VALUES (null,?, ?, ?)');
        if ($stmt->execute([$brand_name, $model_name, $size_name])) {
            $msg =  "<h2>Brand Created Successfully<h2>";
        } else {
            $msg =  "<h2>Database Error</h2>";
        }
    }
}
?>


<?= template_header('Create') ?>

<div class="content update">
    <h2>Create New Brand</h2>

    <form action="create.php" method="post">
        <label for="brand_name">Brand</label>
        <input type="text" name="brand_name" placeholder="Enter Brand name" id="brand_name" required="">
        <label for="model_name">Model</label>
        <input type="text" name="model_name" placeholder="Enter Model name" id="model_name" required="">
        <label for="size_name">Size</label>
        <input type="text" name="size_name" placeholder="Enter Size name" id="size_name" required="">
        <input type="submit" value="Create" name="create">
    </form>

    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>

<?= template_footer() ?>