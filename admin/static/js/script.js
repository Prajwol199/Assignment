function validation(event)
{
    event.preventDefault();
    var email = document.forms["form"]["email"];
    var password = document.forms["form"]["password"];

    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(email.value.match(mailformat))
    {
    return true;
    }
    else
    {
    alert("You have entered an invalid email address!");
    return false;
    }

    if(password.value=""){
        alert("password is empty");
        return false;
    }
}