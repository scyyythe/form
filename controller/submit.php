<?php
session_start();

//for validation
$_SESSION['lastnameInvalid'] = '';
$_SESSION['firstnameInvalid'] = '';
$_SESSION['middleInvalid'] = '';
$_SESSION['dateInvalid'] = '';
$_SESSION['sexInvalid'] = '';
$_SESSION['civilStatusInvalid'] = '';
$_SESSION['otherStatusInvalid'] = '';
$_SESSION['taxInvalid'] = '';
$_SESSION['nationalityInvalid'] = '';
$_SESSION['religionInvalid'] = '';

$valid = true;

//store data
$_SESSION['lastname'] = $_POST['lastname'];
$_SESSION['firstname'] = $_POST['firstname'];
$_SESSION['middle'] = $_POST['middle'];
$_SESSION['date'] = $_POST['date'];
$_SESSION['sex'] = $_POST['sex'];
$_SESSION['civilStatus'] = $_POST['civilStatus'];
$_SESSION['otherStatus'] = $_POST['otherStatus'];
$_SESSION['tax'] = $_POST['tax'];
$_SESSION['nationality'] = $_POST['nationality'];
$_SESSION['religion'] = $_POST['religion'];

//last name validation
if (empty($_POST['lastname'])) {
    $_SESSION['lastnameInvalid'] = 'Last name is required!';
    $valid = false;
} elseif (!preg_match("/^[A-Z][a-zA-Z]*$/", $_POST['lastname'])) {
    $_SESSION['lastnameInvalid'] = 'Last name must start with a capital letter and contain only letters!';
    $valid = false;
}

//first name validation
if (empty($_POST['firstname'])) {
    $_SESSION['firstnameInvalid'] = 'First name is required !';
    $valid = false;
} elseif (!preg_match("/^[A-Z][a-zA-Z]*$/", $_POST['firstname'])) {
    $_SESSION['firstnameInvalid'] = 'First name must start with a capital letter and contain only letters!';
    $valid = false;
}
//middle intial validation
if (empty($_POST['middle'])) {
    $_SESSION['middleInvalid'] = 'Middle Initial is required';
    $valid = false;
} elseif (!preg_match("/^[A-Z]$|^[A-Z]\.$/", $_POST['middle'])) {
    $_SESSION['middleInvalid'] = 'Middle initial should be a single uppercase letter, optionally followed by a period.';
    $valid = false;
} else {
    $_SESSION['middle'] = $_POST['middle'];
}


//date of birth validation
if (empty($_POST['date'])) {
    $_SESSION['dateInvalid'] = 'Date is required!';
    $valid = false;
}

//sex validation
if (empty($_POST['sex'])) {
    $_SESSION['sexInvalid'] = 'Gender is required!';
    $valid = false;
}

// civilstatus validation
if (empty($_POST['civilStatus'])) {
    $_SESSION['civilStatusInvalid'] = 'Civil status is required!';
    $valid = false;
}

// civil status "Others" validation
if ($_POST['civilStatus'] == 'others' && empty($_POST['otherStatus'])) {
    $_SESSION['otherStatusInvalid'] = 'Please specify your civil status';
    $valid = false;
} elseif ($_POST['civilStatus'] == 'others' && !preg_match("/^[A-Za-z\s]+$/", $_POST['otherStatus'])) {
    $_SESSION['otherStatusInvalid'] = 'Other Status must contain only letters and spaces';
    $valid = false;
}

//tax validation
if (empty($_POST['tax'])) {
    $_SESSION['taxInvalid'] = 'Please specify your tax number';
    $valid = false;
} elseif (!preg_match("/^[0-9]{3}-[0-9]{2}-[0-9]{4}$/", $_POST['tax'])) {
    $_SESSION['taxInvalid'] = 'Invalid format (XXX-XX-XXXX)';
    $valid = false;
}

if (empty($_POST['nationality'])) {
    $_SESSION['nationalityInvalid'] = 'Nationality is required!';
    $valid = false;
} elseif (!preg_match("/^[A-Z][a-zA-Z]*$/", $_POST['nationality'])) {
    $_SESSION['nationalityInvalid'] = 'Nationality must start with a capital letter and contain only letters!';
    $valid = false;
}

if (empty($_POST['religion'])) {
    $_SESSION['religionInvalid'] = 'Religion is required!';
    $valid = false;
} elseif (!preg_match("/^[A-Z][a-zA-Z\s]*$/", $_POST['religion'])) {
    $_SESSION['religionInvalid'] = 'Please enter a valid religion name!';
    $valid = false;
}



//check if naa sud ang fields or naa error
if ($valid) {
    header("Location: ../success.php");
    exit();
} else {
    header("Location: ../index.php");
    exit();
}
