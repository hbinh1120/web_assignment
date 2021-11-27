
function login() {
    let username = document.getElementById("username");
    let password = document.getElementById("password");
    let data = {
        username: username.value,
        password: password.value
    };

    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //see api/login.php for response format
            //do something
            /*let status = JSON.parse(this.responseText);
            console.log(this.responseText);
            if (status.status == 1)
                window.location.replace("http://localhost/web_assignment/product.php");
            else {

            }*/
        }
    };
    xmlhttp.open("POST", "api/login.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/json");
    xmlhttp.send(JSON.stringify(data));
}