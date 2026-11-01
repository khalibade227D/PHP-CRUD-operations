    <?php
session_start();
    $error = $_SESSION['login_error'] ?? "";
unset($_SESSION['login_error']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="center-page">
    <main class="card">
        <h1>Welcome back</h1>
        <p class="muted">Log in to your account</p>

        <?php
        if ($error !== '') {
            echo '<p class="alert alert--error is-visible" role="alert">';
            echo htmlspecialchars($error);
            echo '</p>';
            // exit;
        }
        ?>
        <form action="include/login-formhandler.php" method="post" class="form">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" autocomplete="email" placeholder="you@example.com">

            <label for="pwd">Password</label>
            <input type="password" id="pwd" name="pwd" autocomplete="current-password" placeholder="At least 8 characters">

            <button type="submit" class="btn">Log in</button>
            <a class="btnswitch" id="Login" href="index.php" data-target="login">Don't have an Account? Sign Up </a>
             <a class="btnswitch" id="Login" href="Forgotpassword.php" data-target="login"><B>Reset password</B> </a>
        </form>
    </main>

    <script>
    </Script>

</body>

</html>