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

function getProductList() {
    let xmlhttp = new XMLHttpRequest();  
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //see api/getproductlist.php for response format
            productListGlobal = JSON.parse(this.responseText);
            displayProductList(productListGlobal);
        }
    };
    xmlhttp.open("GET", "api/getproductlist.php", true);
    xmlhttp.send();
}

function getProductListByCategory(category) {
    let xmlhttp = new XMLHttpRequest();  
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //see api/getproductlist.php for response format
            productListGlobal = JSON.parse(this.responseText);
            displayProductList(productListGlobal);
        }
    };
    xmlhttp.open("GET", "api/getproductlist.php?category_name=" + category, true);
    xmlhttp.send();
}

function getProductById(product_id) {
    let xmlhttp = new XMLHttpRequest();  
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //see api/getproductbyid.php for response format
            displayProduct(JSON.parse(this.responseText));
        }
    };
    xmlhttp.open("GET", "api/getproductbyid.php?product_id=" + product_id, true);
    xmlhttp.send();
}

function getReviewByProduct(product_id) {
    let xmlhttp = new XMLHttpRequest();  
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //see api/getreviewlist.php for response format
            displayReviewList(JSON.parse(this.responseText));
        }
    };
    xmlhttp.open("GET", "api/getreviewlist.php?product_id=" + product_id, true);
    xmlhttp.send();
}

function displayProduct(product) {

}

function displayReviewList(reviewList) {

}

function displayProductList(productList) {
    let centerlist = document.getElementById("centerlist");
    while (centerlist.firstChild) {
        centerlist.removeChild(centerlist.firstChild);
    }
    productList.forEach(element => {
        let centeritem = document.createElement("div");
        centeritem.classList.add("centeritem");
        let itemimage = document.createElement("div");
        itemimage.classList.add("itemimage");
        //LAD
        let itemname = document.createElement("div");
        itemname.classList.add("itemname");

        let itemrating = document.createElement("div");
        itemrating.classList.add("itemrating");
        //LAD
        let price = document.createElement("div");
        price.classList.add("price");
        let buybutton = document.createElement("div");
        buybutton.classList.add("buybutton");
        let img = document.createElement("img");
        img.src= element.imgurl[0]["imgurl"];
        img.alt = "";
        let button = document.createElement("input");
        button.type = "button";
        button.value = "Buy now";
        //LAD
        let product_name = document.createTextNode(element.product_name);
        let product_price = document.createTextNode(element.price);

        let product_rating = document.createTextNode(element.rating);
        //LAD
        centeritem.appendChild(itemimage);
        //LAD
        centeritem.appendChild(itemname);
        //LAD
        centeritem.appendChild(price);
        //LAD
        centeritem.appendChild(itemrating);
        //LAD
        centeritem.appendChild(buybutton);
        itemimage.appendChild(img);
        buybutton.appendChild(button);
        //LAD
        itemname.appendChild(product_name);
        price.appendChild(product_price);
        itemrating.appendChild(product_rating);
        //LAD
        centerlist.appendChild(centeritem);
    });
}