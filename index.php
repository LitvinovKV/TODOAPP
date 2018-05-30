<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/main.css">
    <link rel="stylesheet" href="CSS/bootstrap/css/bootstrap.css">
</head>
<body>

    <?php
        session_start();
        // Если уже запущена сессия с параметром UserLogin, то покинуть страницу логирования
        if (isset($_SESSION['UserLogin'])) header('location:  http://' . $_SERVER['HTTP_HOST'] . '/tasks.php');
        require_once "ButtonControl.php";
    ?>

    <form method="POST">
        <div id="blockForm">
            <div class="form-group">
                <label for="exampleInputEmail1">User name</label>
                <input class="form-control"  placeholder="Enter user name" name="UserLog">
                <small id="emailHelp" class="form-text text-muted">It's simple project and your data nobody needs...</small>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter password" name="UserPass">
            </div>
    
            <button type="submit" class="btn btn-primary" name="LogIn">Log In</button>
            <button type="submit" class="btn btn-primary" name="SignUp">Sign Up</button>
        </div>
    </form>

</body>
</html>