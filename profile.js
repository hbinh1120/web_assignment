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
    
}