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

function getReviewByUsername(username) {
    let xmlhttp = new XMLHttpRequest();  
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //see api/getproductlist.php for response format
            console.log(this.responseText);
            displayReviewList(JSON.parse(this.responseText));
        }
    };
    xmlhttp.open("GET", "api/getreviewlist.php?username=" + username, true);
    xmlhttp.send();
}

function displayUser(user) {
    let username = document.getElementById("username");
    username.innerHTML = "Username: " + user.username;
    let name = document.getElementById("name");
    name.innerHTML = "Full name: " + user.name;
    let phone = document.getElementById("phone");
    phone.innerHTML = "Phone number: " + user.phone;
    let bdate = document.getElementById("bdate");
    bdate.innerHTML = "Date of birth: " + user.bdate;
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