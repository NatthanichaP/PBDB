<?php
            session_start();
            require_once 'config/db.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section>
            <form action="signup_db.php" method="post">
                <div class="input-box">
                    <header>Register</header>

                    <div class="input-field">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="text" class="input" name="userfname" required="" autocomplete="off">
                        <label for="firstname">Firstname</label>
                    </div>

                    <div class="input-field">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="text" class="input" name="userlname" required="">
                        <label for="lastname">Lastname</label>
                    </div>

                    <div class="input-field">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" class="input" name="useremail" required="">
                        <label for="email">Email</label>
                    </div>

                    <div class="input-field">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="password" class="input" name="userpassword" required="">
                        <label for="password">Password</label>
                    </div>

                    <div class="input-field">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="password" class="input" name="c_password" required="">
                        <label for="confirmpassword">Confirmpassword</label>
                    </div>

                    <div class="input-field">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="phone" class="input" name="userphone" required="">
                        <label for="">Phone</label>
                    </div>

                    <div class="input-field">
                        
                        <select id="membership" name="rank">

                            <option value="disabled selected"> Select rank user</option>
                            <option value="normal" name="normal"> Normal</option>
                            <option value="member" name="member"> Membership</option>
                        </select><br><br>

                        
                    <h3>Subscription costs  <br> $8.5 per month.</h3>
                    </div>


                    <button type="submit" name="signup">Sign Up </button>
                    <div class="register">
                        <p>already have an account ? <a href="index.php"> Sign In</a></p>
                    </div>


                </div>
            
            </form>
</body>
</html>

