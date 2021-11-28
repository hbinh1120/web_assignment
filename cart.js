function remove(product_id) {
    let xmlhttp = new XMLHttpRequest();  
    let data = {
        product_id: product_id
    };
    xmlhttp.open("POST", "api/removecart.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/json");
    xmlhttp.send(JSON.stringify(data));
    window.location = "cart.php";
}