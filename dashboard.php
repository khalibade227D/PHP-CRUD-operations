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

$id    = $_SESSION['user_id'];
$name  = $_SESSION['user_name'];
$email = $_SESSION['user_email'];

$today    = date('l, j F Y');
$initials = strtoupper(mb_substr($name, 0, 2));
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="css/dashboard.css">
   <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    />
</head>

<body>
  <header class="topbar">
      <button
            class="icon-button menu-button"
            id="openSidebar"
            aria-label="Open menu"
          > 
            <i class="fa-solid fa-bars"></i>
          </button>
     <div class="topbar-title">My Dashboard</div>
    <div class="topbar-user">
            <div class="avatar avatar-top"><?= htmlspecialchars($initials) ?></div>
            <button class="top-logout" id="topLogout">
              <i class="fa-solid fa-arrow-right-from-bracket"></i
              ><span>Log out</span>
            </button>
          </div>
  </header>

          <div class="page-content">
          <section class="welcome-banner" aria-label="Welcome">
            <div class="avatar avatar-welcome"><?= htmlspecialchars($initials) ?></div>
            <div class="welcome-copy">
              <span class="member-pill">MEMBER</span>
              <h1 id="greeting">
                <?= htmlspecialchars($greeting) ?> 

<?= htmlspecialchars($name) ?>
            </h1>
              <p id="todayDate"><?= htmlspecialchars($today) ?></p>
            </div>
          </section>

          <div class="dashboard-grid">
            <section class="card account-card" id="account">
              <div class="card-heading">
                <h2>Account details</h2>
                <p>Your profile information</p>
              </div>
              <div class="details-grid">
                <article class="detail-tile">
                  <span class="detail-icon"
                    ><i class="fa-regular fa-address-card"></i
                  ></span>
                  <div class="detail-copy">
                    <span class="detail-label">USER ID</span><strong><?= htmlspecialchars("#".$id) ?></strong>
                  </div>
                </article>
                <article class="detail-tile">
                  <span class="detail-icon"
                    ><i class="fa-regular fa-user"></i
                  ></span>
                  <div class="detail-copy">
                    <span class="detail-label">FULL NAME</span
                    ><strong><?= htmlspecialchars($name) ?></strong>
                  </div>
                </article>
                <article class="detail-tile">
                  <span class="detail-icon"
                    ><i class="fa-regular fa-envelope"></i
                  ></span>
                  <div class="detail-copy">
                    <span class="detail-label">EMAIL ADDRESS</span
                    ><strong class="email-value"><?= htmlspecialchars($email) ?></strong>
                  </div>
                </article>
                <article class="detail-tile">
                  <span class="detail-icon"
                    ><i class="fa-regular fa-calendar"></i
                  ></span>
                  <div class="detail-copy">
                    <span class="detail-label">TODAY</span
                    ><strong id="todayShort"><?= date('j M Y') ?></strong>
                  </div>
                </article>
              </div>
            </section>

            <section class="card actions-card" id="quick-actions">
              <div class="card-heading">
                <h2>Quick actions</h2>
                <p>Things you can do right now</p>
              </div>
              <div class="actions-list">
                <button class="action-button switch-button" id="switchAccount">
                  <i class="fa-solid fa-right-left"></i
                  ><span>Switch Account</span>
                </button>
                <button class="action-button logout-button" id="logoutButton">
                  <i class="fa-solid fa-arrow-right-from-bracket"></i
                  ><span>Log Out</span>
                </button>
              </div>
            </section>
          </div>
          <footer class="page-footer">
            <span>My Dashboard</span><span>Account overview</span>
          </footer>
        </div>

</body>

</html>
