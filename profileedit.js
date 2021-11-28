function getUserByUsername(username) {
    let xmlhttp = new XMLHttpRequest();  
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //see api/getproductbyid.php for response format
            console.log(this.responseText);
            displayUser(JSON.parse(this.responseText));
        }
    };
    xmlhttp.open("GET", "api/getuser.php?username=" + username, true);
    xmlhttp.send();
}

function displayUser(user) {
    let username = document.getElementById("username");
    username.innerHTML = "Username: " + user.username;
    let name = document.getElementById("name");
    name.value = user.name;
    name.defaultValue = user.name;
    let phone = document.getElementById("phone");
    phone.value = user.phone;
    phone.defaultValue = user.phone;
    let bdate = document.getElementById("bdate");
    bdate.value = user.bdate;
    bdate.defaultValue = user.bdate;
}

function update(username) {
    let name = document.getElementById("name");
    let password = document.getElementById("password");
    let phone = document.getElementById("phone");
    let bdate = document.getElementById("bdate");
    let data = {
        name: name.value,
        password: password.value,
        phone: phone.value,
        bdate: bdate
    };

    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "api/modifyuser.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/json");
    xmlhttp.send(JSON.stringify(data));
    window.location = "profile.php?username=" + username;
}