<?php

session_start();
$success = $_SESSION['register_success'] ?? '';
unset($_SESSION['register_success']);
$error = $_SESSION['register_error'] ?? '';
unset($_SESSION['register_error']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup Page</title>
  <link rel="stylesheet" href="css/style.css">
</head>


<body class="center-page">
  <main class="card" id="signup-card">
    <h1>Welcome</h1>
    <p class="muted">Register your Account.</p>

    <?php if ($error !== ''): ?>
      <p class="alert alert--error is-visible" role="alert"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <?php if ($success !== ''): ?>
      <p class="alert alert--success is-visible" role="alert"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <form action="include/Register-Formhandler.php" method="POST" class="form">
      <label for="name">Name</label>
      <input type="text" id="name" name="name" autocomplete="name" placeholder="e.g. khalifa">

      <label for="email">Email</label>
      <input type="email" id="email" name="email" autocomplete="email" placeholder="you@example.com">

      <label for="pwd">Password</label>
      <input type="password" id="pwd" name="pwd" autocomplete="current-password" placeholder="At least 8 characters">

      <button type="submit" class="btn">Sign Up</button>
      <a class="btnswitch" id="Register" href="loginpage.php" data-target="login">Already have an Account? Login</a>
    </form>
  </main>



  <script>
  </script>

</body>

</html>