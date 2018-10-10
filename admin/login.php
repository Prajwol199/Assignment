<?php


if(isset($_POST['login'])){
    require_once '../admin/controller/User.php';
    $login = new User();
    $login->isLoginUser();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="static/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="static/css/style.css">

</head>
<boby >
<div class="container">
    <div class="row">
        <div class="loginPage col-md-5 col-md-offset-4">
            <div class="panel panel-primary" style="margin-top:100px; ">
                <div class="panel-heading">Login to dashboard</div>
                <div class="panel-body">
                    <form  method="post"  name="form" onsubmit="validation(event)">
                        <div class="form-group input-group">
                            <span class="input-group-addon" id="sizing-addon2"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" name="email" class="form-control" placeholder="Username"
                                   aria-describedby="sizing-addon2" value="<?php if((isset($_COOKIE['email']))){
                                    echo $_COOKIE['email'];
                                   }?>">
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" id="sizing-addon2"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" name="password" class="form-control" placeholder="Password"
                                   aria-describedby="sizing-addon2" value="<?php if(isset($_COOKIE['password'])){
                                    echo $_COOKIE['password'];
                                   }?>">
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="remember" id="rem">
                            <label for="rem"> Remember me</label>
                        </div>

                       <a href="../public/recover_password.php">Forgot password?</a>

                        <div class="form-group">
                            <button class="btn btn-success btn pull-right" name="login">LogIn</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="static/js/script.js"></script>
</body>
</html>