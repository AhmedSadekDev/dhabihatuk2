var detailsSection = document.createElement('div');
var values = [];

function initiateDetailsSection() {
    let sections = document.getElementsByClassName('product-details');
    detailsSection.innerHTML = sections[sections.length - 1].innerHTML;

    let button = detailsSection.lastElementChild.firstElementChild.firstElementChild;
    button.innerHTML = "-";
    button.classList.remove('btn-success');
    button.classList.add('btn-danger');
    button.setAttribute('onclick', 'removeDetailsSection(this)');
}

function appendDetailsSection() {
    let sections = document.getElementsByClassName('product-details');
    let length = sections.length;
    let lastSection = sections[length-1];

    let newSection = document.createElement('div');
    newSection.classList.add('row', 'product-details');
    
    let text = detailsSection.innerHTML;
    let index = (values.length > 0)?values.shift():length;
    console.log(values, index);
    text = text.replace(/[0]/g, ""+ index +"");
    newSection.innerHTML = text;

    lastSection.parentNode.insertBefore(newSection, lastSection.nextSibling);
}

function removeDetailsSection(button) {
    let parent = button.parentElement.parentElement.parentElement;
    let name = parent.firstElementChild.firstElementChild.querySelector("input").name;
    name = name.split("[")[1];

    let value = parseInt(name.substring(0, name.length - 1));
    values.push(value);
    values.sort();
    console.log(values);
    
    parent.outerHTML = "";
}

window.addEventListener('load', initiateDetailsSection);