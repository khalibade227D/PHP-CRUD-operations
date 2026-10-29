<?php
require_once 'include/auth.php';
require_login();

$hour = (int) date('G');
if ($hour < 12) {
  $greeting = 'Good morning';
} elseif ($hour < 17) {
  $greeting = 'Good afternoon';
} else {
  $greeting = 'Good evening';
}

$id    = (int) $_SESSION['user_id'];
$name  = $_SESSION['user_name'];
$email = $_SESSION['user_email'] ?? '';

$today    = date('l, j F Y');
$initials = strtoupper(mb_substr($name, 0, 2));
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard – <?= htmlspecialchars($name) ?></title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/dashboard.css">
</head>

<body>

  <header class="topbar">
    <span class="topbar-title">My Dashboard</span>
    <a href="logout.php" class="link-btn">Log out</a>
  </header>

  <main class="dash">

    <!-- Profile card -->
    <section class="profile-card">
      <div class="profile-avatar"><?= htmlspecialchars($initials) ?></div>
      <h1 class="profile-name"><?= htmlspecialchars($name) ?></h1>
      <span class="profile-role">Member</span>
      <p class="profile-email"><?= htmlspecialchars($email) ?></p>
    </section>

    <!-- Greeting banner -->
    <section class="greeting-banner">
      <h2><?= $greeting ?>, <?= htmlspecialchars($name) ?>!</h2>
      <p class="muted"><?= $today ?></p>
    </section>

    <!-- Info cards grid -->
    <div class="info-grid">

      <div class="info-card">
        <span class="info-icon">🆔</span>
        <div>
          <p class="info-label">User ID</p>
          <p class="info-value">#<?= $id ?></p>
        </div>
      </div>

      <div class="info-card">
        <span class="info-icon">👤</span>
        <div>
          <p class="info-label">Full Name</p>
          <p class="info-value"><?= htmlspecialchars($name) ?></p>
        </div>
      </div>

      <div class="info-card">
        <span class="info-icon">✉️</span>
        <div>
          <p class="info-label">Email Address</p>
          <p class="info-value"><?= htmlspecialchars($email) ?></p>
        </div>
      </div>

      <div class="info-card">
        <span class="info-icon">📅</span>
        <div>
          <p class="info-label">Today</p>
          <p class="info-value"><?= date('j M Y') ?></p>
        </div>
      </div>

    </div>

    <!-- Quick actions -->
    <section class="quick-actions">
      <h3>Quick Actions</h3>
      <div class="actions-row">
        <a href="loginpage.php" class="action-btn" onclick="return confirm('You will be logged out.');">
          <span class="action-icon">🔑</span>
          Switch Account
        </a>
        <a href="logout.php" class="action-btn action-btn--danger">
          <span class="action-icon">🚪</span>
          Log Out
        </a>
      </div>
    </section>

  </main>

</body>

</html>
