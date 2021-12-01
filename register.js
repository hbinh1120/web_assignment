
function register() {
    let username = document.getElementById("username");
    let password = document.getElementById("password");
    let data = {
        username: username.value,
        password: password.value
    };

    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            window.location.replace("/assignment/login.php");
        }
    };
    xmlhttp.open("POST", "api/registeruser.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/json");
    xmlhttp.send(JSON.stringify(data));
}