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
    username.innerHTML = user.username;
    let name = document.getElementById("name");
    name.innerHTML = user.name;
    let phone = document.getElementById("phone");
    phone.innerHTML = user.phone;
    let bdate = document.getElementById("bdate");
    bdate.innerHTML = user.bdate;
}