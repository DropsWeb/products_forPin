require('./bootstrap');
document.addEventListener("DOMContentLoaded", function() {
    let count_attr = 0;
    let count_attr_edit = 0;


    let create_product_container = document.querySelector(".create_product");
    let edit_product_container = document.querySelector(".edit_product");
    let add_count_create = create_product_container.querySelector(".add_attr");
    let add_count_edit;
    let attribute_container_add = create_product_container.querySelector(".form_attributes");
    let attribute_container_edit;
    let products_block = document.querySelectorAll(".list_products__items-item");

    // Выбранный товар
    let product_data;


    let info_collapse = new bootstrap.Collapse(document.getElementById("infoProduct"), {
        toggle: false
    });
    let edit_collapse = new bootstrap.Collapse(document.getElementById("editProduct"), {
        toggle: false
    });
    let edit_product = info_collapse._element.querySelector(".action_edit");
    let remove_product = info_collapse._element.querySelector(".action_remove");


    add_count_create.addEventListener("click", function(event) { add_attribute(event, attribute_container_add, "add") }, false);

    products_block.forEach(product => {
        product.addEventListener("click", () => {
            get_info(product);
        });
    })

    remove_product.addEventListener("click", rmProduct);
    edit_product.addEventListener("click", edProduct);


    function add_attribute(event, attribute_container, type) {
        let counter;
        if (type == "add") {
            count_attr++;
            counter = count_attr;
        } else {
            count_attr_edit++;
            counter = count_attr_edit;
        }
        count_attr++;
        attribute_container.insertAdjacentHTML("beforeend",
            `
            <div class="attribute" id="attr${counter}">
            <div class="row">
                <div class="col">
                    <label for="statusProduct" class="form-label">Название</label>
                    <input type="text" required name="data[${counter}][name]" class="form-control" aria-label="First name">
                </div>
                <div class="col">
                    <label for="statusProduct" class="form-label">Значение</label>
                    <input type="text" required name="data[${counter}][value]" class="form-control" aria-label="Last name">
                </div>
                <div class="col-1 p-1">
                    <div class="del_attr" data-index="${counter}" data-idattr="attr${counter}"><img src="/images/clear_attr.png" alt=""></div>
                </div>
            </div>
            </div>
            `
        )

        attribute_container.querySelectorAll(".del_attr").forEach(elem => {
            elem.addEventListener("click", function() {
                let index = elem.dataset.index;
                attribute_container.querySelector(`#attr${index}`).parentNode.removeChild(document.querySelector(`#attr${index}`));
            })
        })
    }

    function get_info(data) {
        edit_collapse.hide();
        product_data = JSON.parse(data.dataset.product);
        product_data.data = JSON.parse(product_data.data);

        let info_product = info_collapse._element.querySelector(".modal-body");
        info_collapse._element.querySelector(".modal-title").innerText = product_data.name;
        info_collapse._element.querySelector(".product_actions").dataset.id = product_data.id;

        let attributes = "";
        for (attribute in product_data.data) {
            let elem = product_data.data[attribute]
            attributes += `
                <div class="col product_value">${elem.name} : ${elem.value}</div>
            `
        }

        info_product.innerText = "";

        info_product.insertAdjacentHTML("beforeend", `
            <div class="row mb-3">
                <div class="col-2 product_name">Артикул</div>
                <div class="col-6 product_value">${product_data.article}</div>
            </div>
            <div class="row mb-3">
                <div class="col-2 product_name">Название</div>
                <div class="col-6 product_value">${product_data.name}</div>
            </div>
            <div class="row mb-3">
                <div class="col-2 product_name">Статус</div>
                <div class="col-6 product_value">${product_data.status}</div>
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

    function edProduct(event) {
        info_collapse.hide();
        let token = edit_product_container.dataset.token;
        let attributes = "";
        count_attr_edit = Object.keys(product_data.data).length;
        let counter = 0;
        for (attribute in product_data.data) {
            let elem = product_data.data[attribute]
            counter++;
            attributes += `
                <div class="attribute" id="attr${counter}">
                    <div class="row">
                        <div class="col">
                            <label for="statusProduct" class="form-label">Название</label>
                            <input type="text" required name="data[${counter}][name]" value="${elem.name}" class="form-control" aria-label="First name">
                        </div>
                        <div class="col">
                            <label for="statusProduct" class="form-label">Значение</label>
                            <input type="text" required name="data[${counter}][value]" value="${elem.value}" class="form-control" aria-label="Last name">
                        </div>
                        <div class="col-1 p-1">
                            <div class="del_attr" data-index="${counter}" data-idattr="attr${counter}"><img src="/images/clear_attr.png" alt=""></div>
                        </div>
                    </div>
                </div>
            `
        }

        let edit_content = `
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Редактировать ${product_data.name}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-toggle="collapse" data-bs-target="#editProduct" aria-expanded="false" aria-controls="editProduct"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/edit_product">
                        <input type="hidden" name="_token" value="${token}">
                        <input type="hidden" name="id" value="${product_data.id}">
                        <div class="mb-3">
                            <label for="articleProduct" class="form-label">Артикул</label>
                            <input type="string" required name="article" class="form-control" id="articleProduct" value="${product_data.article}" aria-describedby="articleProduct">
                        </div>
                        <div class="mb-3">
                            <label for="nameProduct" class="form-label">Название</label>
                            <input type="string" required name="name" class="form-control" id="nameProduct" value="${product_data.name}" aria-describedby="nameProduct">
                        </div>
                        <div class="mb-3">
                            <label for="statusProduct" class="form-label">Статус</label>
                            <select class="form-select" name="status" id="statusProduct" value="${product_data.status}" aria-label="Default select example">
                                <option value="available">Доступен</option>
                                <option value="unavailable">Не доступен</option>
                            </select>
                        </div>
                        <div class="mb-3 d-flex flex-column">
                            <label for="" class="form-label-attr mb-4"> Атрибуты</label>
                            <div class="form_attributes">${attributes}</div>
                            <div class="add_attr mt-4 mb-3">+ Добавить атрибут</div>
                        </div>
                        <button type="submit" class="add_product">Сохранить</button>
                    </form>
                </div>
            </div>
        `

        edit_product_container.innerText = "";
        edit_product_container.insertAdjacentHTML('beforeend', edit_content);
        add_count_create = create_product_container.querySelector(".add_attr");
        add_count_edit = edit_product_container.querySelector(".add_attr");
        attribute_container_edit = edit_product_container.querySelector(".form_attributes");
        add_count_edit.addEventListener("click", function(event) { add_attribute(event, attribute_container_edit, "edit") }, false);
        edit_collapse.show();



        attribute_container_edit.querySelectorAll(".del_attr").forEach(elem => {
            elem.addEventListener("click", function() {
                let index = elem.dataset.index;
                attribute_container_edit.querySelector(`#attr${index}`).parentNode.removeChild(document.querySelector(`#attr${index}`));
            })
        })
    }



})