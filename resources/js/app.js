require('./bootstrap');
document.addEventListener("DOMContentLoaded", function() {
    let count_attr = 0;

    let add_count = document.querySelector(".add_attr");
    let attribute_container = document.querySelector(".form_attributes");
    let products_block = document.querySelectorAll(".list_products__items-item");


    let info_collapse = new bootstrap.Collapse(document.getElementById("infoProduct"), {
        toggle: false
    });
    let edit_product = info_collapse._element.querySelector(".action_edit");
    let remove_product = info_collapse._element.querySelector(".action_remove");


    add_count.addEventListener("click", add_attribute);
    products_block.forEach(product => {
        product.addEventListener("click", () => {
            get_info(product);
        });
    })

    remove_product.addEventListener("click", rmProduct);

    function rmProduct(event) {
        let id = info_collapse._element.querySelector(".product_actions").dataset.id;
        let token = info_collapse._element.querySelector(".product_actions").dataset.token;

        let data = {
            id: id
        };
        fetch('/remove_product', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8',
                'X-CSRF-Token': token
            },
            body: JSON.stringify(data)
        }).then(data => {
            if (data.status == 200) {
                location.reload();
            }
        })
    }

    function add_attribute(event) {
        count_attr++;
        attribute_container.insertAdjacentHTML("beforeend",
            `
            <div class="attribute" id="attr${count_attr}">
            <div class="row">
                <div class="col">
                    <label for="statusProduct" class="form-label">Название</label>
                    <input type="text" name="data[${count_attr}][name]" class="form-control" aria-label="First name">
                </div>
                <div class="col">
                    <label for="statusProduct" class="form-label">Значение</label>
                    <input type="text" name="data[${count_attr}][value]" class="form-control" aria-label="Last name">
                </div>
                <div class="col-1 p-1">
                    <div class="del_attr" data-index="${count_attr}" data-idattr="attr${count_attr}"><img src="/images/clear_attr.png" alt=""></div>
                </div>
            </div>
            </div>
            `
        )

        document.querySelectorAll(".del_attr").forEach(elem => {
            elem.addEventListener("click", function() {
                let index = elem.dataset.index;
                document.querySelector(`#attr${index}`).parentNode.removeChild(document.querySelector(`#attr${index}`));
            })
        })
    }

    function get_info(data) {
        let product_data = JSON.parse(data.dataset.product);
        product_data.DATA = JSON.parse(product_data.DATA);

        let info_product = info_collapse._element.querySelector(".modal-body");
        info_collapse._element.querySelector(".modal-title").innerText = product_data.NAME;
        info_collapse._element.querySelector(".product_actions").dataset.id = product_data.id;

        let attributes = "";
        for (attribute in product_data.DATA) {
            let elem = product_data.DATA[attribute]
            attributes += `
                <div class="col product_value">${elem.name} : ${elem.value}</div>
            `
        }

        info_product.innerText = "";

        info_product.insertAdjacentHTML("beforeend", `
            <div class="row mb-3">
                <div class="col-2 product_name">Артикул</div>
                <div class="col-6 product_value">${product_data.ARTICLE}</div>
            </div>
            <div class="row mb-3">
                <div class="col-2 product_name">Название</div>
                <div class="col-6 product_value">${product_data.NAME}</div>
            </div>
            <div class="row mb-3">
                <div class="col-2 product_name">Статус</div>
                <div class="col-6 product_value">${product_data.STATUS}</div>
            </div>
            <div class="row mb-3">
                <div class="col-2 product_name">Атрибуты</div>
                <div class="col-6">
                    ${attributes}
                </div>
            <div>
        `);



        info_collapse.show();
    }




})