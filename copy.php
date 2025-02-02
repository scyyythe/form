<?php
session_start();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $middle_initial = $_POST['middle'];

    $lastnameInvalid = '';
    $firstnameInvalid = '';
    $middleInvalid = '';

    // Last Name validation
    if (empty($lastname)) {
        $lastnameInvalid = "Last Name is required";
    } else {
        if (!preg_match("/^[a-zA-Z]*$/", $lastname)) {
            $lastnameInvalid = "Only letters are allowed.";
        }
    }

    // First Name validation
    if (empty($_POST["firstname"])) {
        $firstnameInvalid = "First Name is required.";
    } else {
        if (!preg_match("/^[a-zA-Z]*$/", $firstname)) {
            $firstnameInvalid = "Only letters are allowed.";
        }
    }

    // Middle Initial validation
    if (empty($_POST["middle"])) {
        $middleInvalid = "Middle Initial is required.";
    } else {
        if (!preg_match("/^[a-zA-Z]*$/", $middle)) {
            $middleInvalid = "Only letters are allowed.";
        }
    }

    // Tax Identification validation
    if (empty($_POST["tax"])) {
        $taxErr = "Tax ID is required.";
    } else {
        $tax = $_POST["tax"];
        if (!preg_match("/^[0-9]{3}-[0-9]{2}-[0-9]{4}$/", $tax)) {
            $taxErr = "Invalid format (XXX-XX-XXXX).";
        }
    }

    // Nationality validation
    if (empty($_POST["nationality"])) {
        $nationalityErr = "Nationality is required.";
    } else {
        $nationality = $_POST["nationality"];
    }

    // Religion validation
    if (empty($_POST["religion"])) {
        $religionErr = "Religion is required.";
    } else {
        $religion = $_POST["religion"];
    }

    // Place of Birth validation
    if (empty($_POST["city"])) {
        $cityErr = "City is required.";
    } else {
        $city = $_POST["city"];
    }

    if (empty($_POST["municipality"])) {
        $municipalityErr = "Municipality is required.";
    } else {
        $municipality = $_POST["municipality"];
    }

    if (empty($_POST["province"])) {
        $provinceErr = "Province is required.";
    } else {
        $province = $_POST["province"];
    }

    // Contact Information validation
    if (empty($_POST["mobile"])) {
        $mobileErr = "Mobile number is required.";
    } else {
        $mobile = $_POST["mobile"];
        if (!preg_match("/^[0-9]{11}$/", $mobile)) {
            $mobileErr = "Invalid mobile number.";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email address is required.";
    } else {
        $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format.";
        }
    }

    if (empty($_POST["telephone"])) {
        $telephoneErr = "Telephone number is required.";
    } else {
        $telephone = $_POST["telephone"];
    }

    // If no errors, you can proceed with form submission (e.g., insert into database)
    if (empty($lastnameInvalid) && empty($firstnameInvalid) && empty($middleInvalid) && empty($taxErr) && empty($nationalityErr) && empty($religionErr) && empty($cityErr) && empty($municipalityErr) && empty($provinceErr) && empty($mobileErr) && empty($emailErr) && empty($telephoneErr)) {
        // Process form submission (e.g., insert into database)
    }
}
