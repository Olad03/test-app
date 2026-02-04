
<?php
require('db.php'); // Include the database connection file

if (isset($_POST['username'])) {

    $username = mysqli_real_escape_string($con, stripslashes($_POST['username']));
    $email    = mysqli_real_escape_string($con, stripslashes($_POST['email']));
    $password = mysqli_real_escape_string($con, stripslashes($_POST['password']));

    $trn_date = date("Y-m-d H:i:s");
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, email, password, trn_date)
              VALUES ('$username', '$email', '$hashed_password', '$trn_date')";

    $result = mysqli_query($con, $query);

    if ($result) {
        echo "<div style='color:#fff;text-align:center;font-family:Inter'>
                <h2>You are registered successfully.</h2>
                <p><a href='login.php' style='color:#9fa8ff'>Login</a></p>
              </div>";
    } else {
        echo "<div style='color:#fff;text-align:center;font-family:Inter'>
                <h2>Error registering user.</h2>
                <p><a href='register.php' style='color:#ff9f9f'>Try again</a></p>
              </div>";
    }

} else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Event Evaluation</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

<style>
body {
    margin: 0;
    min-height: 100vh;
    background: linear-gradient(135deg, #0c1445, #2b0b3f);
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Inter', sans-serif;
}

.form-shell {
    width: 100%;
    max-width: 920px;
    background: #0b1d4a;
    border-radius: 14px;
    padding: 60px;
    color: #ffffff;
    box-shadow: 0 40px 100px rgba(0,0,0,.55);
}

h1 {
    text-align: center;
    font-weight: 600;
    margin-bottom: 10px;
}

.subtitle {
    text-align: center;
    font-size: 15px;
    opacity: .85;
    margin-bottom: 45px;
}

label {
    font-size: 14px;
    margin-bottom: 8px;
    display: block;
}

label span {
    color: #ff6b6b;
}

input {
    width: 100%;
    padding: 15px 18px;
    border-radius: 8px;
    border: none;
    font-size: 14px;
    margin-bottom: 25px;
}

.section {
    margin-top: 40px;
    border-top: 1px solid rgba(255,255,255,.25);
    padding-top: 22px;
    font-size: 18px;
}

.submit {
    margin-top: 45px;
    width: 100%;
    padding: 16px;
    border-radius: 10px;
    border: none;
    background: linear-gradient(135deg,#6c63ff,#b845ff);
    color: #ffffff;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
}

.submit:hover {
    opacity: .9;
}

@media(max-width:768px){
    .form-shell { padding:35px; }
}
</style>
</head>

<body>

<div class="form-shell">

    <h1>BluDive Registration Application</h1>
    <p class="subtitle">This is a Sample Registration App Version 1.1</p>

    <!-- FORM FIELD NAMES UNCHANGED -->
    <form method="POST">

        <label>Your Name <span>*</span></label>
        <input type="text" name="username" placeholder="Enter your full name" required>

        <label>Email Address <span>*</span></label>
        <input type="email" name="email" placeholder="Enter your email" required>

        <label>Password <span>*</span></label>
        <input type="password" name="password" placeholder="Create a password" required>

        <div class="section">Please rate the following</div>
        <p style="opacity:.7;font-size:14px">
            (Rate this test App)
        </p>

        <button type="submit" class="submit">Submit Registration</button>

    </form>

</div>

</body>
</html>

<?php } ?>

