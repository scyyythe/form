<?php
session_start();

//for validation
$_SESSION['lastnameInvalid'] = '';
$_SESSION['firstnameInvalid'] = '';
$_SESSION['middleInvalid'] = '';

$valid = true;

//store data
$_SESSION['lastname'] = $_POST['lastname'] ?? '';
$_SESSION['firstname'] = $_POST['firstname'] ?? '';
$_SESSION['middle'] = $_POST['middle'] ?? '';

if (empty($_POST['lastname'])) {
    $_SESSION['lastnameInvalid'] = 'Last Name is required';
    $valid = false;
} elseif (!preg_match("/^[a-zA-Z]+$/", $_POST['lastname'])) {
    $_SESSION['lastnameInvalid'] = 'Last Name should not contain numbers or special characters';
    $valid = false;
}

if (empty($_POST['firstname'])) {
    $_SESSION['firstnameInvalid'] = 'First Name is required';
    $valid = false;
} elseif (!preg_match("/^[a-zA-Z]+$/", $_POST['firstname'])) {
    $_SESSION['firstnameInvalid'] = 'First Name should not contain numbers or special characters';
    $valid = false;
}

if (empty($_POST['middle'])) {
    $_SESSION['middleInvalid'] = 'Middle Initial is required';
    $valid = false;
} elseif (!preg_match("/^[a-zA-Z]+$/", $_POST['middle'])) {
    $_SESSION['middleInvalid'] = 'Middle Initial should not contain numbers or special characters';
    $valid = false;
}


if ($valid) {
    header("Location: ../success.php");
    exit();
} else {
    header("Location: ../index.php");
    exit();
}
