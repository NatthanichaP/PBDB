<?php 
    session_start();
    require_once 'config/db.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section>
            <form action="signin_db.php" method="post">
                
                <div class="input-box">

                    <header>Login</header>

                    <div class="input-field">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" class="input" name="useremail" required="" autocomplete="off">
                        <label for="">Email</label>
                    </div>

                    <div class="input-field">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="password" class="input" name="userpassword" required="">
                        <label for="password">Password</label>
                    </div>
                    <div class="forgot-password">
                        <a href="forgotpwd.php">Forgot your password?</a>
                    </div>


                    <button type="submit" name="signin"> Sign In</button>
                    <div class="register">
                        <p>don't have an account ? <a href="register.php"> Sign Up</a></p>
                    </div>


                </div>
            
            </form>
    </section>
</body>
</html>
