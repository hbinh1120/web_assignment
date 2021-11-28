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
            console.log(this.responseText);
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
    let centerheader = document.getElementById("centerheader");
    centerheader.style.display = "none";
    let detailmain = document.getElementById("detailmain");
    detailmain.style.display = "block";
    let detailname = document.getElementById("detailname");
    detailname.innerHTML = product.product_name;
    let detailrating = document.getElementById("detailrating");
    detailrating.innerHTML = "Rating: " + product.rating;
    let detaildescription = document.getElementById("detaildescription");
    detaildescription.innerHTML = product.description;
    let detailstock = document.getElementById("detailstock");
    detailstock.innerHTML = product.stock + " in stock";

    let smallimagelist = document.getElementById("smallimagelist");
    product.imgurl.forEach(element => {
        let smallimage = document.createElement("img");
        smallimage.src = element.imgurl;
        smallimage.alt="";
        smallimagelist.appendChild(smallimage);
    });
    let mainimage = document.createElement("img");
    mainimage.src = product.imgurl[0]["imgurl"];
    mainimage.alt="";
    document.getElementById("mainimage").appendChild(mainimage);
}

function displayReviewList(reviewList) {
    let reviewlist = document.getElementById("reviewlist");
    while (reviewlist.firstChild) reviewlist.removeChild(reviewlist.firstChild);
    reviewList.forEach(element => {
        let reviewcontainer = document.createElement("div");
        reviewcontainer.classList.add("reviewcontainer");
        let reviewusername = document.createElement("div");
        reviewusername.classList.add("reviewusername");
        let reviewrating = document.createElement("div");
        reviewrating.classList.add("reviewrating");
        let reviewcomment = document.createElement("div");
        reviewcomment.classList.add("reviewcomment");

        reviewusername.innerHTML = element.username;
        reviewrating.innerHTML = "Rating: " + element.rating;
        reviewcomment.innerHTML = element.comment;

        reviewcontainer.appendChild(reviewusername);
        reviewcontainer.appendChild(reviewrating);
        reviewcontainer.appendChild(reviewcomment);
        reviewlist.appendChild(reviewcontainer);
    });
}

function displayProductList(productList) {
    let centerlist = document.getElementById("centerlist");
    while (centerlist.firstChild) centerlist.removeChild(centerlist.firstChild);
    centerlist.style.display = "block";
    productList.forEach(element => {
        let centeritem = document.createElement("div");
        centeritem.classList.add("centeritem");
        centeritem.onclick = function() {
            location.href = "/assignment/product.php?product_id=" + element.product_id;
        }
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
        let img = document.createElement("img");
        img.src= element.imgurl[0]["imgurl"];
        img.alt = "";
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
        itemimage.appendChild(img);
        //LAD
        itemname.appendChild(product_name);
        price.appendChild(product_price);
        itemrating.appendChild(product_rating);
        //LAD
        centerlist.appendChild(centeritem);
    });
}