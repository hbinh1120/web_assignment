function getProductList() {
    let xmlhttp = new XMLHttpRequest();  
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            displayProductList(JSON.parse(this.responseText));
        }
    };
    xmlhttp.open("GET", "api/getproductlist.php", true);
    xmlhttp.send();
}

function displayProductList(productList) {
    let centerlist = document.getElementById("centerlist");
    productList.forEach(element => {
        let centeritem = document.createElement("div");
        centeritem.classList.add("centeritem");
        let itemimage = document.createElement("div");
        itemimage.classList.add("itemimage");
        let price = document.createElement("div");
        price.classList.add("price");
        let buybutton = document.createElement("div");
        buybutton.classList.add("buybutton");
        let img = document.createElement("img");
        img.src= element.imgurl;
        img.alt = "";
        let button = document.createElement("input");
        button.type = "button";
        button.value = "Buy now";
        centeritem.appendChild(itemimage);
        centeritem.appendChild(price);
        centeritem.appendChild(buybutton);
        itemimage.appendChild(img);
        buybutton.appendChild(button);

        centerlist.appendChild(centeritem);
    });
}

getProductList();