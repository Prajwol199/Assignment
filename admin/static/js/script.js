function validation(){

    var email = document.forms["form"]["email"];
    var pass = document.forms["form"]["password"];


    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(!email.value.match(mailformat)){
        alert("You have entered an invalid email address!");
        return false;
    }
    else if(!pass.value){
       alert('Password cannot be empty');
        return false; 
    }
    return true;
}


function pageValidate(){
    var pgname = document.forms["pageForm"]["name"];
    var des = document.forms["pageForm"]["des"];

    if(!pgname.value){
        alert("Page name is empty");
        return false;
    }
    if(!des.value){
        alert("Description is empty");
        return false;
    }
    return true;
}

function updatePassword(){
    var oldpass = document.forms["Password"]["opassword"];
    var newpass = document.forms["Password"]["npassword"];

    if(!oldpass.value){
        alert("Old password cannot be empty");
        return false;
    }
    if(!newpass.value){
        alert("New password cannot be empty");
        return false;
    }
    return true;
}
