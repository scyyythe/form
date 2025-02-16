<?php

require '../functions/validation.php';
require_once '../config/connection.php';
require_once '../model/User.php';
require_once '../controller/session_data.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //for validation
    $validationFields = [
        'lastnameInvalid',
        'firstnameInvalid',
        'middleInvalid',
        'dateInvalid',
        'sexInvalid',
        'civilStatusInvalid',
        'otherStatusInvalid',
        'taxInvalid',
        'nationalityInvalid',
        'religionInvalid',
        'cityInvalid',
        'municipalityInvalid',
        'provinceInvalid',

        'unitInvalid',
        'houseNoInvalid',
        'streetInvalid',
        'subdivisionInvalid',
        'baranggayInvalid',
        'cityMunicipalityInvalid',
        'province_homeInvalid',
        'countryInvalid',
        'zipInvalid',

        'mobileInvalid',
        'emailInvalid',
        'telephoneInvalid',

        'lastnameFatherInvalid',
        'firstnameFatherInvalid',
        'middleinitialFatherInvalid',

        'lastnameMotherInvalid',
        'firstnameMotherInvalid',
        'middleinitialMotherInvalid'
    ];

    foreach ($validationFields as $field) {
        $_SESSION[$field] = '';
    }

    //check 
    $valid = true;

    // store data sa session
    $dataFields = [
        'lastname',
        'firstname',
        'middle',
        'date',
        'sex',
        'civilStatus',
        'otherStatus',
        'tax',
        'nationality',
        'religion',

        'city',
        'municipality_birth',
        'province_birth',

        'unit',
        'houseNo',
        'street',
        'subdivision',
        'baranggay',
        'cityMunicipality',
        'province_home',
        'country',
        'zip',

        'mobile',
        'email',
        'telephone',

        'lastnameFather',
        'firstnameFather',
        'middleinitialFather',

        'lastnameMother',
        'firstnameMother',
        'middleinitialMother'
    ];

    // store data na naa trim
    foreach ($dataFields as $field) {
        $_SESSION[$field] = trim($_POST[$field]);
    }

    // my name
    validateNameField('lastname', 'lastnameInvalid', 'Last name is required!', $valid);
    validateNameField('firstname', 'firstnameInvalid', 'First name is required!', $valid);
    validateMiddleInitial('middle', 'middleInvalid', $valid);

    // fathers name
    validateNameField('lastnameFather', 'lastnameFatherInvalid', 'Father\'s last name is required!', $valid);
    validateNameField('firstnameFather', 'firstnameFatherInvalid', 'Father\'s first name is required!', $valid);
    validateNameField('middleinitialFather', 'middleinitialFatherInvalid', 'Father\'s middle name is required!', $valid);

    //mothers name
    validateNameField('lastnameMother', 'lastnameMotherInvalid', 'Mother\'s last name is required!', $valid);
    validateNameField('firstnameMother', 'firstnameMotherInvalid', 'Mother\'s first name is required!', $valid);
    validateNameField('middleinitialMother', 'middleinitialMotherInvalid', 'Mother\'s middle name is required!', $valid);

    validateNameField('nationality', 'nationalityInvalid', 'Nationality is required!', $valid);
    validateNameField('religion', 'religionInvalid', 'Religion is required!', $valid);

    // Date of Birth
    validateDateOfBirth('date', 'dateInvalid', $valid);

    // sex vsalidation
    validateRequiredField('sex', 'sexInvalid', 'Gender is required!', $valid);

    // civil status validation
    validateRequiredField('civilStatus', 'civilStatusInvalid', 'Civil status is required!', $valid);
    if ($_POST['civilStatus'] == 'others') {
        validateNameField('otherStatus', 'otherStatusInvalid', 'Please specify your civil status', $valid);
    }

    // tax validation
    validateTax('tax', 'taxInvalid', $valid);

    // address
    validateNameField('city', 'cityInvalid', 'City is required!', $valid);
    validateNameField('municipality_birth', 'municipalityInvalid', 'Municipality is required!', $valid);
    validateNameField('province_birth', 'provinceInvalid', 'Province is required!', $valid);
    validateTextInput('unit', 'unitInvalid', 'Unit is required!', $valid);
    validateTextInput('houseNo', 'houseNoInvalid', 'House number is required!', $valid);
    validateNameField('street', 'streetInvalid', 'Street name is required!', $valid);
    validateNameField('subdivision', 'subdivisionInvalid', 'Subdivision name is required!', $valid);
    validateNameField('baranggay', 'baranggayInvalid', 'Baranggay name is required!', $valid);
    validateNameField('cityMunicipality', 'cityMunicipalityInvalid', 'City/Municipality is required!', $valid);
    validateNameField('province_home', 'province_homeInvalid', 'Province (home) is required!', $valid);
    validateNameField('country', 'countryInvalid', 'Country is required!', $valid);


    // number only
    validateNumeric('zip', 'zipInvalid', 'Zip code is required!', $valid);
    validateNumeric('mobile', 'mobileInvalid', 'Mobile number is required!', $valid);
    validateEmail('email', 'emailInvalid', $valid);
    validateNumeric('telephone', 'telephoneInvalid', 'Telephone number is required!', $valid);

    function calculateAge($dob)
    {
        if (empty($dob)) {
            return null;
        }
        $dob = new DateTime($dob);
        $today = new DateTime();
        return $today->diff($dob)->y;
    }

    if ($valid) {
        $dob = $_SESSION['date'] ?? '';
        $age = calculateAge($dob);

        $fields = [
            "lastname" => "lastname",
            "firstname" => "firstname",
            "middle" => "middle",
            "sex" => "sex",
            "civil_status" => "civilStatus",
            "other_status" => "otherStatus",
            "tax" => "tax",
            "nationality" => "nationality",
            "religion" => "religion",
            "city" => "city",
            "municipality_birth" => "municipality_birth",
            "province_birth" => "province_birth",
            "unit" => "unit",
            "house_no" => "houseNo",
            "street" => "street",
            "subdivision" => "subdivision",
            "baranggay" => "baranggay",
            "city_municipality" => "cityMunicipality",
            "province_home" => "province_home",
            "country" => "country",
            "zip" => "zip",
            "mobile" => "mobile",
            "email" => "email",
            "telephone" => "telephone",
            "father_lastname" => "lastnameFather",
            "father_firstname" => "firstnameFather",
            "father_middleinitial" => "middleinitialFather",
            "mother_lastname" => "lastnameMother",
            "mother_firstname" => "firstnameMother",
            "mother_middleinitial" => "middleinitialMother"
        ];

        $data = ["dob" => $dob, "age" => $age];

        foreach ($fields as $key => $sessionKey) {
            $data[$key] = $_SESSION[$sessionKey] ?? '';
        }

        $user = new User($conn);
        $result = $user->insert($data);

        if ($result !== true) {
            echo "Insert failed: " . $result;
            exit();
        }

        header("Location: ../success.php");
        exit();
    } else {
        header("Location: ../index.php");
        exit();
    }
} else {
    echo 'Form has not been submitted yet!';
}
