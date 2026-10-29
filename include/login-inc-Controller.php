<?php


declare(strict_types=1);

function Fields_are_empty(
    string $email,
    string $pwd
) {

    if (empty($email) || empty($pwd)) {
        return true;
    } else {
        return false;
    }
}
function pwd_had_8andmore(
    string $pwd
) {

    if (strlen($pwd) >= 8) {
        return true;
    } else {
        return false;
    }
}
function is_email_valid(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}
