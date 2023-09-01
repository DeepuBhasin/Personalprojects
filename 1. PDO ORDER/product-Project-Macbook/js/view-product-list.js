let massDeleteBtn = document.querySelector('#delete-product-btn');
let fd = document.querySelector('#formData');
massDeleteBtn.addEventListener('click', function () {
    const deleteCheckbox = document.querySelectorAll('.delete-checkbox');
    let ids = [];
    for (let i = 0; i < deleteCheckbox.length; i++) {
        if (deleteCheckbox[i].checked) {
            ids.push(deleteCheckbox[i].id);
        }
    }

    fd.submit();
});