
function login() {
    let name = document.getElementById("name");
    let password = document.getElementById("password");
    let data = {
        name: name.value,
        password: password.value
    };

    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //see api/login.php for response format
            //do something
        }
    };
    xmlhttp.open("POST", "login.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/json");
    xmlhttp.send(JSON.stringify(data));
}