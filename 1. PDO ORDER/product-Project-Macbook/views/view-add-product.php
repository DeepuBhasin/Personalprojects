<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Add</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="row my-3">
        <div class="col-md-5">
            <h1 class="mx-5">Product Add</h1>
        </div>
        <div class="col-md-5 my-2">

            <a href="index.php" class="btn btn-danger" style="float:right">Cancel</a>
            <button type="button" class="btn btn-success" style="float:right; margin-right: 20px;" id="saveBtn">Save</a>
        </div>
        <hr />
    </div>
    <div class="row mx-3">
        <form id="product_form" method="post" class="col-md-6">
            <div class="mb-3">
                <label for="sku" class="form-label">SKU</label>
                <input type="text" class="form-control" id="sku" name="sku" required placeholder="SKU" />
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required placeholder="Name" />
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price ($)</label>
                <input type="number" min="0" class="form-control" id="price" name="price" required placeholder="Price" />
            </div>
            <div class="mb-3">
                <label for="productType" class="form-label">Type Switcher</label>
                <select class="form-select" name="typeSwitcher" required id="productType">
                    <option value="">Type Switcher</option>
                    <option value="DVD">DVD</option>
                    <option value="Furniture">Furniture</option>
                    <option value="Book">Book</option>
                </select>
            </div>

            <div id="selectedSwitcher"></div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="./js/view-add-product.js"></script>
</body>

</html>