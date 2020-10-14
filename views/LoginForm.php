<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="/css/LoginForm.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="/scripts/auth.js" ></script>
    <title>LogIn</title>
</head>
<body>
    <?php 
 
    print_r($_SESSION) ?>
    <div class="formContiner">
        <h1>Administrative panel</h1>
        <form action="controler/auth.php" onsubmit="validateAndSubmit(event)" method="post" id="loginForm">
            <label for="username">Username</label>
            <i class="fas fa-user-alt"></i>
        <input type="text" name='username' id="username" placeholder="username">
        <br>
        <label for="password">Password</label>
        <i class="fas fa-lock"></i>
        <input type="password" name="password" id="password" placeholder="Password">
        <br>
        <button>Login</button>
        </form>


    </div>
</body>
</html>