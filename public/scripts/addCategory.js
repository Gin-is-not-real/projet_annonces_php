let btnAddCategory = document.querySelector('#btn-new-category');
if(btnAddCategory != null) {
    btnAddCategory.addEventListener('click', addNewCategory);
}


function addNewCategory() {
    let inputNewCategory = document.querySelector('#new-category');
    let fieldset = document.querySelector('fieldset');
    let categoriesStr = [];
    document.querySelectorAll("input[type='checkbox']").forEach(elt=> {
        categoriesStr.push(elt.value);
    })

    let cat = inputNewCategory.value;
    if(!categoriesStr.includes(cat)) {
        console.log('hey !');

        let div = document.createElement('div');
        let label = document.createElement('label');
        label.for = cat;
        label.textContent = cat;

        let check = document.createElement('input');
        check.type = 'checkbox';
        check.name = 'categories[]';
        check.id = cat;
        check.value = cat;

        div.appendChild(label);
        div.appendChild(check);
        fieldset.appendChild(div);

    } 
}
