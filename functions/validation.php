<?php

// require
function validateRequiredField($fieldName, $validationSession, $errorMessage, &$valid)
{
    if (empty($_POST[$fieldName])) {
        $_SESSION[$validationSession] = $errorMessage;
        $valid = false;
    }
}

// only letter, proper name
function validateNameField($fieldName, $validationSession, $errorMessage, &$valid)
{
    validateRequiredField($fieldName, $validationSession, $errorMessage, $valid);

    if ($valid && !preg_match("/^[A-Z][a-zA-Z\s]*$/", $_POST[$fieldName])) {
        $_SESSION[$validationSession] = 'Must start with a capital letter and contain only letters!';
        $valid = false;
    }
}

// middle initial example I.
function validateMiddleInitial($fieldName, $validationSession, &$valid)
{
    validateRequiredField($fieldName, $validationSession, 'Middle Initial is required', $valid);

    if ($valid && !preg_match("/^[A-Z](\.)?$/", $_POST[$fieldName])) {
        $_SESSION[$validationSession] = 'Middle initial should be a single uppercase letter, optionally followed by a period.';
        $valid = false;
    }
}


// validaiton age (18 up dapat)
function validateDateOfBirth($fieldName, $validationSession, &$valid)
{
    validateRequiredField($fieldName, $validationSession, 'Date is required!', $valid);

    if ($valid) {
        $birthDate = new DateTime($_POST[$fieldName]);
        $now = new DateTime();
        $age = $now->diff($birthDate)->y;

        if ($age < 18) {
            $_SESSION[$validationSession] = 'You must be at least 18 years old!';
            $valid = false;
        }
    }
}

// Validate Only Letters
function checkLetters($value)
{
    return preg_match("/^[A-Z][a-zA-Z\s]*$/", $value);
}

// Validate Numbers Only
function isNumber($value)
{
    return preg_match("/^[0-9]+$/", $value);
}

// Validate Tax Format (XXX-XX-XXXX)
function validateTax($fieldName, $validationSession, &$valid)
{
    validateRequiredField($fieldName, $validationSession, 'Tax number is required!', $valid);
    if ($valid && !preg_match("/^[0-9]{3}-[0-9]{2}-[0-9]{4}$/", $_POST[$fieldName])) {
        $_SESSION[$validationSession] = 'Invalid format (XXX-XX-XXXX)';
        $valid = false;
    }
}

// Validate Generic Text Input (Capitalized & Letters)
function validateTextInput($fieldName, $validationSession, $errorMessage, &$valid)
{
    validateRequiredField($fieldName, $validationSession, $errorMessage, $valid);

    if ($valid && !preg_match('/^[A-Z][A-Za-z0-9 ]*$/', $_POST[$fieldName])) {
        $_SESSION[$validationSession] = 'Invalid input! Must start with a capital letter and contain only letters, numbers, and spaces.';
        $valid = false;
    }
}

// email validaiton
function validateEmail($fieldName, $validationSession, &$valid)
{
    validateRequiredField($fieldName, $validationSession, 'Email is required!', $valid);

    if ($valid && !filter_var($_POST[$fieldName], FILTER_VALIDATE_EMAIL)) {
        $_SESSION[$validationSession] = 'Invalid email format!';
        $valid = false;
    }
}

// numbers onl
function validateNumeric($fieldName, $validationSession, $errorMessage, &$valid)
{
    validateRequiredField($fieldName, $validationSession, $errorMessage, $valid);
    if ($valid && !isNumber($_POST[$fieldName])) {
        $_SESSION[$validationSession] = 'Must be numeric!';
        $valid = false;
    }
}

function validateTelephone($fieldName, $validationSession, $errorMessage, &$valid)
{

    validateRequiredField($fieldName, $validationSession, $errorMessage, $valid);
    if ($valid && !preg_match("/^\+1 \(\d{3}\) \d{3}-\d{4}$/", $_POST[$fieldName])) {
        $_SESSION[$validationSession] = 'Telephone number must be in the format: +1 (746) 672-4801';
        $valid = false;
    }
}
