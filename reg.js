function validate(form) {
    var a,b,c,e,f,g,h,i,j,k,l,m;
    var reg1,reg2,reg3,reg4,reg5,reg6,reg7,reg8,reg9,reg10;
    reg1 = /[^a-zA-Z]/g;
    reg2 = /[^a-zA-Z0-9, .()-]/g;
    reg3 = /[a-zA-Z]{4,}/g;
    reg4 = /(\W{1,}|[ ])/g;
    reg5 = /\d{10}/g;
    reg6 = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{3})+$/g;
    reg7 = /[A-Z]{1,}/g;
    reg8 = /[a-z]{1,}/g;
    reg9 = /[0-9]{1,}/g;
    reg10= /(\W{1,}|[_]{1,})/g;
    reg11 = /[ ]{1,}/g;

    a = document.getElementById("id111").value;
    if (a == "") {
        alert("First Name must be filled.");
        return false;
    }
    else if(reg1.test(a)) {
        alert("Name should not contain numbers or special characters.");
        return false;
    }

    b = document.getElementById("id2").value;
    if (b == "") {
        alert("Middle Name must be filled.");
        return false;
    }
    else if(reg1.test(b)) {
        alert("Name should not contain numbers, special characters or underscore.");
        return false;
    }

    c = document.getElementById("id3").value;
    if (c == "") {
        alert("Last Name must be filled.");
        return false;
    }
    else if(reg1.test(c)) {
        alert("Name should not contain numbers, special characters or underscore.");
        return false;
    }

    e = document.getElementById("id5").value;
    if (e == "") {
        alert("Please fill your address.");
        return false;
    }
    else if(reg2.test(e)) {
        alert("Address should not contain special characters.");
        return false;
    }

    f = document.getElementById("id6").value;
    if (f == "--select--") {
        alert("City must be selected.");
        return false;
    }

    g = document.getElementById("id7").value;
    if (g == "--select--") {
        alert("State must be selected.");
        return false;
    }

    h = document.forms["validation"]["gender"].value;
    if(h == "") {
        alert("Gender must be selected.");
        return false;
    }

    i = document.getElementById("id8").value;
    if (i == "") {
        alert("Enter your username.");
        return false;
    }
    else if(i.length < 7 || i.length > 10) {
        alert("Invalid username length.");
        return false;
    }
    else if(!reg3.test(i)) {
        alert("Username must contain atleast 4 letters.");
        return false;
    }
    else if(reg4.test(i) ) {
        alert("Invalid Username.");
        return false;
    }

    j = document.getElementById("id9").value;
    if (j == "") {
        alert("Please enter your phone no.");
        return false;
    }
    else if(j.length != 10 || !reg5.test(j)) {
        alert("Invalid phone number.");
        return false;
    }

    k = document.getElementById("id10").value;
    if (k == "") {
        alert("Enter your e-mail id.");
        return false;
    }
    else if (!reg6.test(k)) {
        alert("Invalid e-mail id.");
        return false;
    }
    else if(k.length < 15) {
        alert("Invalid username or domain name length.");
        return false;
    }
    

    l = document.getElementById("id11").value;
    if (l == "") {
        alert("Enter your password.");
        return false;
    }
    else if(l.length < 7) {
        alert("Password length too short.");
        return false;
    }
    else if(!reg7.test(l)) {
        alert("Atleast one uppercase letter is required in password.");
        return false;
    }
    else if(!reg8.test(l)) {
        alert("Atleast one lowercase letter is required in password.");
        return false;
    }
    else if(!reg9.test(l)) {
        alert("Atleast one numeric value is required in password.");
        return false;
    }
    else if(!reg10.test(l)) {
        alert("Atleast one special character is required in password.");
        return false;
    }
    else if(reg11.test(l)) {
        alert("Spaces are not allowed in password.");
        return false ;
    }


    m = document.getElementById("id12").value;
    if (m == "") {
        alert("Please confirm your password by re-entering.");
        return false;
    }
    else if(l != m) {
        alert("Passwords does not match.");
        return false;
    }
   
    n = document.getElementById("id13").value;
    if (n.length == 0) {
        alert("Terms and conditions should be agreed.");
        return false;
    }

    else {
        return true;
    }

}
