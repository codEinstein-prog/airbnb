<?php

// Check for empty signup input
function emptyInputSignup($name, $email, $username, $pwd, $pwdrepeat) {
    return empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdrepeat);
}

// Check for invalid username (alphanumeric only)
function invalidUid($username) {
    return !preg_match("/^[a-zA-Z0-9]*$/", $username);
}

// Check for invalid email format
function invalidEmail($email) {
    return !filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Check if passwords match
function pwdMatch($pwd, $pwdrepeat) {
    return $pwd !== $pwdrepeat;
}

// Check if username or email already exists
function uidExists($conn, $username, $email) {
    $sql = "SELECT * FROM users WHERE UsersUid = ? OR UsersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        mysqli_stmt_close($stmt);
        return $row; // user found
    } 
    
    else {
        mysqli_stmt_close($stmt);
        return false; // user not found
    }
}

// Optional: Securely hash password and insert user
function createUser($conn, $name, $email, $username, $pwd) {
    $sql = "INSERT INTO users (UsersName, UsersEmail, UsersUid, UsersPwd) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: ../signup.php?signup=success");
    exit();
}

