<?php
include 'functions.php';
echo  template_header('Read');
$DBH = pdo_connect_mysql();
?>

<div class="content read">
    <h2>List of Brand</h2>
    <a href="create.php" class="create-contact">Create New Brand</a>
    <table>
        <thead>
            <tr>
                <td>#</td>
                <td>Brands</td>
                <td>Models</td>
                <td>Sizes</td>
                <td>Edit</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $DBH->prepare("SELECT * FROM product_table ORDER BY id ASC LIMIT 10 OFFSET 0"); //

            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $i = 0;
                while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            ?>
                    <tr>
                        <td><?= ++$i; ?></td>
                        <td><?= $row->brand_name ?></td>
                        <td><?= $row->model_name ?></td>
                        <td><?= $row->size_name ?></td>
                        <td class="actions" style="text-align: left;"><a href="update.php?id=<?= $row->id ?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                            <a href="delete.php?id=<?= $row->id ?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                        </td>
                    </tr>
                <?php
                }
            } else { ?>
                <tr>
                    <td colspan="5">No Record Found . . . </td>

                </tr>
            <?php

            }

            ?>
        </tbody>

    </table>
    <!-- <div class="pagination">
        <?php if ($page > 1) : ?>
            <a href="read.php?page=<?= $page - 1 ?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
        <?php endif; ?>
        <?php if ($page * $records_per_page < $num_brands) : ?>

            <a href="read.php?page=<?= $page + 1 ?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
        <?php endif; ?>

    </div> -->
</div>

<?= template_footer() ?>