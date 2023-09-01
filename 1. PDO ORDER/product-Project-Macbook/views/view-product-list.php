<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="row my-3">
        <div class="col-md-5">
            <h1 class="mx-5">Product List</h1>
        </div>
        <div class="col-md-5 my-2">

            <button type="button" class="btn btn-danger" style="float:right" id="delete-product-btn"> Mass Delete</button>
            <a href=" add-product.php" class="btn btn-success" style="float:right; margin-right: 20px;">Add Product</a>

        </div>
        <hr />

        <div class="col-md-12 p-4">
            <form id="formData" method="post">
                <div class="row mx-3">
                    <?php
                    foreach ($productData as $value) :
                    ?>
                        <div class="card m-1" style="width: 18rem;">
                            <div class="card-body">
                                <input type="checkbox" class="delete-checkbox" id="<?= $value->getId(); ?>" name="product[]" value="<?= $value->getId() ?>" />

                                <p class="card-text text-center mx-3">
                                    <?= $value->getSku(); ?> <br />
                                    <?= $value->getPrice(); ?> <br />
                                    <?= $value->getPrice(); ?> $ <br />
                                    <?= $value->getSelected(); ?>
                                </p>
                            </div>
                        </div>
                    <?php
                    endforeach; ?>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="./js/view-product-list.js"></script>
</body>

</html>