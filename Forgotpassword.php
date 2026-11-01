<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/forgotPassword.css">
     <link rel="stylesheet" href="css/style.css">
    <title>Forgot password page</title>
</head>
<body class="center-page">
    <main class="card">
        <h1>Password reset</h1>
        <?php
        ?>

        <form action="include/Forgot-password-handler.php" method="post" class="form">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" autocomplete="email" placeholder="you@example.com">

           <label for="new-password">New Password</label>
        <input type="password" id="new-password" name="Npwd"
       autocomplete="new-password" placeholder="Enter your new password" required>

        <label for="confirm-password">Confirm Password</label>
        <input type="password" id="confirm-password" name="Cpwd"
       autocomplete="new-password" placeholder="Confirm your password" required>


            <button type="submit" class="btn">Reset Password</button>
            <a class="btnswitch" id="Login" href="loginpage.php" data-target="login">Log in to your account</a>
        </form>
    </main>

    <script>
    </Script>
</body>
</html>