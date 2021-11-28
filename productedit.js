productListGlobal = [];

const searchHandler = function(e) {
    if (e.target.value == "") {
        displayProductList(productListGlobal);
        return;
    }
    let tempProductList = [];
    productListGlobal.forEach(element => {
        if (element.product_name.toUpperCase().indexOf(e.target.value.toUpperCase()) != -1) tempProductList.push(element);
    });
    displayProductList(tempProductList);
}
const search = document.getElementById("search");
search.addEventListener("input", searchHandler);
search.addEventListener("propertychange", searchHandler);

function getProductById(product_id) {
    let xmlhttp = new XMLHttpRequest();  
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //see api/getproductbyid.php for response format
            console.log(this.responseText);
            displayProduct(JSON.parse(this.responseText));
        }
    };
    xmlhttp.open("GET", "api/getproductbyid.php?product_id=" + product_id, true);
    xmlhttp.send();
}

function displayProduct(product) {
    let detailname = document.getElementById("detailname");
    detailname.value = product.product_name;

    let price = document.getElementById("price");
    price.value = product.price;

    let detaildescription = document.getElementById("detaildescription");
    detaildescription.value = product.description;
    let detailstock = document.getElementById("detailstock");
    detailstock.value = product.stock;

    let smallimagelist = document.getElementById("smallimagelist");
    product.imgurl.forEach(element => {
        //LAD
        let smallimg = document.createElement("div");
        smallimg.classList.add("smallimg");
        //LAD
        let smallimage = document.createElement("img");
        smallimage.src = element.imgurl;
        smallimage.alt="";
        //LAD
        smallimg.appendChild(smallimage);
        //LAD
        smallimagelist.appendChild(smallimg);
    });
    let mainimage = document.createElement("img");
    mainimage.src = product.imgurl[0]["imgurl"];
    mainimage.alt="";
    document.getElementById("mainimage").appendChild(mainimage);
}

function update(product_id) {
    let product_name = document.getElementById("detailname");
    let detaildescription = document.getElementById("detaildescription");
    let price = document.getElementById("price");
    let detailstock = document.getElementById("detailstock");
    let data = {
        product_name: product_name.value,
        description: detaildescription.value,
        price: price.value,
        stock: detailstock.value,
        product_id: product_id
    };

    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "api/modifyproductbyid.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/json");
    xmlhttp.send(JSON.stringify(data));
    window.location = "product.php?product_id=" + product_id;
}

function remove(product_id) {
    let data = {
        product_id: product_id
    };

    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "api/deleteproductbyid.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/json");
    xmlhttp.send(JSON.stringify(data));
    window.location = "product.php";
}

function add() {
    let product_name = document.getElementById("detailname");
    let detaildescription = document.getElementById("detaildescription");
    let price = document.getElementById("price");
    let detailstock = document.getElementById("detailstock");
    let data = {
        product_name: product_name.value,
        description: detaildescription.value,
        price: price.value,
        stock: detailstock.value
    };

    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "api/addproduct.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/json");
    xmlhttp.send(JSON.stringify(data));
    //window.location = "product.php";
}