const productType = document.querySelector('#productType');
const selectedSwitcher = document.querySelector('#selectedSwitcher');
const saveBtn = document.querySelector('#saveBtn');
const productForm = document.querySelector('#product_form');

productType.addEventListener('change', function () {
    let insertElement = '';
    let focusElement = '';

    if (this.value === 'DVD') {
        insertElement = `<label for="size" class="form-label">Size (MB) </label>
            <input type="text" name="selected[dvd]" id="size" required placeholder="Size" class="form-control" /> <br />
            <p aria-roledescription="description">Please provide size</p>`;
        focusElement = '#size';
    } else if (this.value === 'Furniture') {
        insertElement = `<label for="height" class="form-label">Height (cm)</label>
            <input type="text" name="selected[height]" id="height" required placeholder="Height" class="form-control" /> <br />
            <label for="width" class="form-label">Width (cm) </label>
            <input type="text" name="selected[width]" id="width" required placeholder="Width" class="form-control" /> <br />
            <label for="length" class="form-label">Length (cm) </label>
            <input type="text" name="selected[length]" id="length" required placeholder="Length" class="form-control" /> <br />
            <p aria-roledescription="description">Please provide Dimensions</p>`;
        focusElement = '#height';
    } else if (this.value === 'Book') {
        insertElement = `<label for="weight" class="form-label">Weight (KG)</label>
            <input type="text" name="selected[weight]" id="weight" required placeholder="Weight" class="form-control" /> <br />
            <p aria-roledescription="description">Please provide Weight</p>`;
        focusElement = '#weight';
    }

    selectedSwitcher.innerHTML = insertElement;
    document.querySelector(focusElement).focus();
});

saveBtn.addEventListener('click', function () {
    function checkValue(id) {
        const element = document.querySelector(id);

        if (!element) {
            return [false, false];
        }

        const value = element.value.trim();
        if (value.length <= 0) {
            return [false, element];
        }
        return [value, element];
    }

    const [sku, skuEl] = checkValue('#sku');
    const [name, nameEl] = checkValue('#name');
    const [price, priceEl] = checkValue('#price');
    const [productTypeValue, productTypeEl] = checkValue('#productType');
    const [size, sizeEl] = checkValue('#size');
    const [height, heightEl] = checkValue('#height');
    const [width, widthEl] = checkValue('#width');
    const [length, lengthEl] = checkValue('#length');
    const [weight, weightEl] = checkValue('#weight');

    if (!sku) {
        alert('Please submit required data for SKU');
        skuEl.focus();
    } else if (!name) {
        alert('Please submit required data for Name');
        nameEl.focus();
    } else if (!price) {
        alert('Please submit required data for Price');
        priceEl.focus();
    } else if (!productTypeValue) {
        alert('Please submit required data for Product Type');
        productTypeEl.focus();
    } else if (sizeEl && !size) {
        alert('Please submit required data for Size');
        sizeEl.focus();
    } else if (heightEl && !height) {
        alert('Please submit required data for Height');
        heightEl.focus();
    } else if (widthEl && !width) {
        alert('Please submit required data for Width');
        widthEl.focus();
    } else if (lengthEl && !length) {
        alert('Please submit required data for Length');
        lengthEl.focus();
    } else if (weightEl && !weight) {
        alert('Please submit required data for Weight');
        weightEl.focus();
    } else {
        productForm.submit();
    }
});