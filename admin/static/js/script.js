function validation(){

    var email = document.forms["form"]["email"];
    var pass = document.forms["form"]["password"];


    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(!email.value.match(mailformat)){
        // alert("You have entered an invalid email address!");
        document.getElementById("error").innerHTML = "You have entered an invalid email address!";
        return false;
    }
    else if(!pass.value){
       //alert('Password cannot be empty');
       document.getElementById("error").innerHTML = "Password cannot be empty.";
        return false; 
    }
    return true;
}


function pageValidate(){
    var pgname = document.forms["pageForm"]["name"];
    var des = document.forms["pageForm"]["des"];

    if(!pgname.value){
        //alert("Page name is empty");
        document.getElementById("error").innerHTML = "Page Name cannot be empty.";
        return false;
    }
    if(!des.value){
        //alert("Description is empty");
         document.getElementById("error").innerHTML = "Description cannot be empty.";
        return false;
    }
    return true;
}

function updatePassword(){
    var oldpass = document.forms["Password"]["opassword"];
    var newpass = document.forms["Password"]["npassword"];

    if(!oldpass.value){
        //alert("Old password cannot be empty");
        document.getElementById("error").innerHTML = "Old password cannot be empty.";
        return false;
    }
    if(!newpass.value){
        //alert("New password cannot be empty");
        document.getElementById("error").innerHTML = "New password cannot be empty.";
        return false;
    }
    return true;
}

function editValidator(){
    var pgname = document.forms["pageForm"]["name"];
    var des = document.forms["pageForm"]["des"];

    if(!pgname.value){
        //alert("Page name is empty");
        document.getElementById("error").innerHTML = "Page Name cannot be empty.";
        return false;
    }
    if(!des.value.trim()){
        //alert("Description is empty");
         document.getElementById("error").innerHTML = "Description cannot be empty.";
        return false;
    }
    return true;
}

function siteValidation(){
     var name = document.forms["form"]["name"];
     var url = document.forms["form"]["url"];
     var footer = document.forms["form"]["footer"];

     if(!name.value){
          document.getElementById("error").innerHTML = "Site name cannot be empty";
          return false;
     }
     if(!url.value){
          document.getElementById("error").innerHTML = "Site URL cannot be empty";
          return false;
     }
     if(!footer.value){
          document.getElementById("error").innerHTML = "Footer cannot be empty";
          return false;
     }
     return true;
}