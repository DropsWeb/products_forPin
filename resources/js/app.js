require('./bootstrap');
document.addEventListener("DOMContentLoaded", function() {
    let count_attr = 0;

    let add_count = document.querySelector(".add_attr");
    let attribute_container = document.querySelector(".form_attributes");

    add_count.addEventListener("click", add_attribute);

    function add_attribute(event) {
        count_attr++;
        attribute_container.innerHTML += `
        <div class="attribute" id="attr${count_attr}">
        <div class="row">
            <div class="col">
                <label for="statusProduct" class="form-label">Название</label>
                <input type="text" name="attrName${count_attr}" class="form-control" aria-label="First name">
            </div>
            <div class="col">
                <label for="statusProduct" class="form-label">Значение</label>
                <input type="text" name="attrValue${count_attr}" class="form-control" aria-label="Last name">
            </div>
            <div class="col-1 p-1">
                <div class="del_attr" data-idattr="attr${count_attr}"><img src="/images/clear_attr.png" alt=""></div>
            </div>
        </div>
        </div>
        `
    }
})