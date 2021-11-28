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

function increment() {
    let cartnumber = document.getElementById("cartnumber");
    cartnumber.innerHTML = parseInt(cartnumber.innerHTML) + 1;
}

function decrement() {
    let cartnumber = document.getElementById("cartnumber");
    if (parseInt(cartnumber.innerHTML) > 1) 
        cartnumber.innerHTML = parseInt(cartnumber.innerHTML) - 1;
}

function addCart() {
    let cartnumber = document.getElementById("cartnumber").innerHTML;
    let product_id = document.getElementById("product_id");
    let data = {
        number: cartnumber,
        product_id: product_id.value
    };
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "api/addcart.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/json");
    xmlhttp.send(JSON.stringify(data))
}

function makeReview() {
    let username = document.getElementById("username");
    let product_id = document.getElementById("product_id");
    let comment = document.getElementById("comment");
    let rating = document.querySelector('input[name="rating"]:checked').value;
    let data = {
        username: username.value,
        comment: comment.value,
        product_id: product_id.value,
        rating: rating
    };

    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "api/addreview.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/json");
    xmlhttp.send(JSON.stringify(data));
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

function displayReviewList(reviewList) {
    let reviewlist = document.getElementById("reviewlist");
    while (reviewlist.firstChild) reviewlist.removeChild(reviewlist.firstChild);
    reviewList.forEach(element => {
        let reviewcontainer = document.createElement("div");
        reviewcontainer.classList.add("reviewcontainer");
        //LAD
        let userimg = document.createElement("div");
        userimg.classList.add("userimg");
        let reviewinfo = document.createElement("div");
        reviewinfo.classList.add("reviewinfo");
        //LAD
        let reviewusername = document.createElement("div");
        reviewusername.classList.add("reviewusername");
        let reviewrating = document.createElement("div");
        reviewrating.classList.add("reviewrating");
        let reviewcomment = document.createElement("div");
        reviewcomment.classList.add("reviewcomment");

        reviewusername.innerHTML = element.username;
        reviewrating.innerHTML = "Rating: " + element.rating;
        reviewcomment.innerHTML = element.comment;

        //LAD
        let uimg = document.createElement("img");
        uimg.src = "img/user.png";
        
        userimg.appendChild(uimg);
        reviewinfo.appendChild(reviewusername);
        reviewinfo.appendChild(reviewrating);
        reviewinfo.appendChild(reviewcomment);
        reviewcontainer.appendChild(userimg);
        reviewcontainer.appendChild(reviewinfo);
        reviewlist.appendChild(reviewcontainer);
        //LAD

        /*
        reviewcontainer.appendChild(reviewusername);
        reviewcontainer.appendChild(reviewrating);
        reviewcontainer.appendChild(reviewcomment);
        reviewlist.appendChild(reviewcontainer);
        */
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
        let f_rating = parseFloat(element.rating);
        let i_rating = parseInt(f_rating);

        for(let i = 0; i < i_rating; i++){
            let star_img = document.createElement("img");
            star_img.src = "img/blackstar.png";
            star_img.alt = "";
            itemrating.appendChild(star_img);
        }

        if(f_rating - i_rating > 0.5){
            
        }
        //let product_rating = document.createTextNode(element.rating);
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
        //itemrating.appendChild(product_rating);
        //LAD
        centerlist.appendChild(centeritem);
    });
}