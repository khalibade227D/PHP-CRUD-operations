<?php

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Require any logged-in user. Redirects to login if not authenticated.
 */
function require_login(): void
{
    if (!isset($_SESSION['user_id'], $_SESSION['user_name'])) {
        header('Location: loginpage.php');
        exit;
    }
}

/**
 * Require admin access (user_id === 1 AND user_name === 'admin').
 * Redirects non-admin users to the dashboard, guests to login.
 */
function require_Admin_login(): void
{
    if (!isset($_SESSION['user_id'], $_SESSION['user_name'])) {
        header('Location: loginpage.php');
        exit;
    }

    if ((int) $_SESSION['user_id'] !== 1 || $_SESSION['user_name'] !== 'admin') {
        header('Location: dashboard.php');
        exit;
    }
}
