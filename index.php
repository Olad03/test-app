
<?php
require('db.php'); // Include the database connection file

// If form submitted, insert values into the database.
if (isset($_POST['username'])) {
    // removes backslashes
    $username = stripslashes($_REQUEST['username']);
    // escapes special characters in a string
    $username = mysqli_real_escape_string($con, $username);
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($con, $email);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);
    $trn_date = date("Y-m-d H:i:s");

    // Hash the password securely before storing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT into `users` (username, email, password, trn_date)
              VALUES ('$username', '$email', '$hashed_password', '$trn_date')";
    $result = mysqli_query($con, $query);
    if ($result) {
        echo "<div class='form'>
              <h3>You are registered successfully.</h3>
              <p>Click here to <a href='login.php'>Login</a></p>
              </div>";
    } else {
        echo "<div class='form'>
              <h3>Error registering user.</h3>
              <p>Click here to <a href='register.php'>try again</a></p>
              </div>";
    }
} else {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>Registration</title>
        <link rel="stylesheet" href="style.css" />
    </head>
    <body class="container">
    <div class="form col-md-10">
        <h1 style="padding: 5px" class="text-center">BluDive Create An Account Template</h1>
        <form name="registration" action="" method="post">
            <div class="form-group">
                <label for="username">Your username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required />
            </div>

           <div class="form-group">
               <label for="email">Your Email Address</label>
               <input type="email" id="email" class="form-control" name="email" placeholder="Email" required />
           </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" name="password" placeholder="Password" required />
            </div>

            <div class="form-group">
                <input type="submit" class="form-control btn btn-primary" name="submit" value="Register" />
            </div>
        </form>
    </div>
    </body>
    </html>
<?php } ?>

