<?php
session_start();

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

    //function check valid name
    function isValidName($value)
    {
        return preg_match("/^[A-Z][a-zA-Z0-9\s]*$/", $value);
    }

    //function to check if letters raba tanan
    function checkLetters($value)
    {
        return preg_match("/^[A-Z][a-zA-Z\s]*$/", $value);
    }
    //fcuntion to check if number only
    function isNumber($value)
    {
        return is_numeric($value);
    }

    //last name validation
    if (empty($_POST['lastname'])) {
        $_SESSION['lastnameInvalid'] = 'Last name is required!';
        $valid = false;
    } elseif (!checkLetters($_POST['lastname'])) {
        $_SESSION['lastnameInvalid'] = 'Last name must start with a capital letter and contain only letters!';
        $valid = false;
    }

    //first name validation
    if (empty($_POST['firstname'])) {
        $_SESSION['firstnameInvalid'] = 'First name is required !';
        $valid = false;
    } elseif (!checkLetters($_POST['firstname'])) {
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
    }

    //date of birth validation
    if (empty($_POST['date'])) {
        $_SESSION['dateInvalid'] = 'Date is required!';
        $valid = false;
    } else {
        $birthDate = new DateTime($_POST['date']);
        $now = new DateTime();
        $age = $now->diff($birthDate)->y;

        if ($age < 18) {
            $_SESSION['dateInvalid'] = 'You must be at least 18 years old!';
            $valid = false;
        }
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

    //nationality validation
    if (empty($_POST['nationality'])) {
        $_SESSION['nationalityInvalid'] = 'Nationality is required!';
        $valid = false;
    } elseif (!checkLetters($_POST['nationality'])) {
        $_SESSION['nationalityInvalid'] = 'Nationality must start with a capital letter and contain only letters!';
        $valid = false;
    }

    //religion validation
    if (empty($_POST['religion'])) {
        $_SESSION['religionInvalid'] = 'Religion is required!';
        $valid = false;
    } elseif (!checkLetters($_POST['religion'])) {
        $_SESSION['religionInvalid'] = 'Please enter a valid religion name!';
        $valid = false;
    }

    // city validation
    if (empty($_POST['city'])) {
        $_SESSION['cityInvalid'] = 'City is required!';
        $valid = false;
    } elseif (!isValidName($_POST['city'])) {
        $_SESSION['cityInvalid'] = 'Input a valid city name!';
        $valid = false;
    }

    // municipality validation
    if (empty($_POST['municipality_birth'])) {
        $_SESSION['municipalityInvalid'] = 'Municipality is required!';
        $valid = false;
    } elseif (!isValidName($_POST['municipality_birth'])) {
        $_SESSION['municipalityInvalid'] = 'Invalid municipality name!';
        $valid = false;
    }

    // province validation
    if (empty($_POST['province_birth'])) {
        $_SESSION['provinceInvalid'] = 'Province is required!';
        $valid = false;
    } elseif (!isValidName($_POST['province_birth'])) {
        $_SESSION['provinceInvalid'] = 'Invalid province name.';
        $valid = false;
    }

    //unit validation
    if (empty($_POST['unit'])) {
        $_SESSION['unitInvalid'] = 'Unit is required!';
        $valid = false;
    } elseif (!isValidName($_POST['unit'])) {
        $_SESSION['unitInvalid'] = 'Invalid unit name!';
        $valid = false;
    }

    //houseNo validaitin
    if (empty($_POST['houseNo'])) {
        $_SESSION['houseNoInvalid'] = 'This field is required!';
        $valid = false;
    } elseif (!isValidName($_POST['houseNo'])) {
        $_SESSION['houseNoInvalid'] = 'Invalid house number. Please enter a valid number!';
    }

    //street validation
    if (empty($_POST['street'])) {
        $_SESSION['streetInvalid'] = 'Streen name is required!';
        $valid = false;
    } elseif (!checkLetters($_POST['street'])) {
        $_SESSION['streetInvalid'] = 'Invalid street name. Please enter a valid street name!';
    }

    //subdivisio validtion
    if (empty($_POST['subdivision'])) {
        $_SESSION['subdivisionInvalid'] = 'Subdivison name is required!';
        $valid = false;
    } elseif (!checkLetters($_POST['subdivision'])) {
        $_SESSION['subdivisionInvalid'] = 'Subdivison name must be a proper name!';
    }

    //barranggay validation
    if (empty($_POST['baranggay'])) {
        $_SESSION['baranggayInvalid'] = 'Baranggay name is required!';
        $valid = false;
    } elseif (!checkLetters(($_POST['baranggay']))) {
        $_SESSION['baranggayInvalid'] = 'Invalid barrangay name! Please make sure it starts with capital letter!';
    }

    //citymunicipality validion
    if (empty($_POST['cityMunicipality'])) {
        $_SESSION['cityMunicipalityInvalid'] = 'This field is required!';
        $valid = false;
    } elseif (!checkLetters($_POST['cityMunicipality'])) {
        $_SESSION['cityMunicipalityInvalid'] = 'Invalid municipality name!';
    }

    //province home validatin
    if (empty($_POST['province_home'])) {
        $_SESSION['province_homeInvalid'] = 'This field is required!';
        $valid = false;
    } elseif (!checkLetters($_POST['province_home'])) {
        $_SESSION['province_homeInvalid'] = 'Invalid province name!';
    }

    //country validation
    if (empty($_POST['country'])) {
        $_SESSION['countryInvalid'] = 'This field is required!';
        $valid = false;
    } elseif (!checkLetters($_POST['country'])) {
        $_SESSION['countryInvalid'] = 'Invalid province name!';
    }

    //zip code validation
    if (empty($_POST['zip'])) {
        $_SESSION['zipInvalid'] = 'This field is required!';
        $valid = false;
    } elseif (!isNumber($_POST['zip'])) {
        $_SESSION['zipInvalid'] = 'Zip code must be numeric!';
    }

    // Mobile validation
    if (empty($_POST['mobile'])) {
        $_SESSION['mobileInvalid'] = 'Mobile number is required!';
        $valid = false;
    } elseif (!isNumber($_POST['mobile'])) {
        $_SESSION['mobileInvalid'] = 'Mobile number must be numeric!';
        $valid = false;
    }

    // Email validation
    if (empty($_POST['email'])) {
        $_SESSION['emailInvalid'] = 'Email is required!';
        $valid = false;
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['emailInvalid'] = 'Email is not valid!';
        $valid = false;
    }

    // Telephone validation
    if (empty($_POST['telephone'])) {
        $_SESSION['telephoneInvalid'] = 'Telephone number is required!';
        $valid = false;
    } elseif (!isNumber($_POST['telephone'])) {
        $_SESSION['telephoneInvalid'] = 'Telephone number must be numeric!';
        $valid = false;
    }


    // father last name validation
    if (empty($_POST['lastnameFather'])) {
        $_SESSION['lastnameFatherInvalid'] = 'Father\'s last name is required!';
        $valid = false;
    } elseif (!checkLetters($_POST['lastnameFather'])) {
        $_SESSION['lastnameFatherInvalid'] = 'Father\'s last name must start with a capital letter and contain only letters!';
        $valid = false;
    }

    // father first name validation
    if (empty($_POST['firstnameFather'])) {
        $_SESSION['firstnameFatherInvalid'] = 'Father\'s first name is required!';
        $valid = false;
    } elseif (!checkLetters($_POST['firstnameFather'])) {
        $_SESSION['firstnameFatherInvalid'] = 'Father\'s first name must start with a capital letter and contain only letters!';
        $valid = false;
    }

    // father middle initial validation
    if (empty($_POST['middleinitialFather'])) {
        $_SESSION['middleinitialFatherInvalid'] = 'Father\'s middle initial is required';
        $valid = false;
    } elseif (!preg_match("/^[A-Z]$|^[A-Z]\.$/", $_POST['middleinitialFather'])) {
        $_SESSION['middleinitialFatherInvalid'] = 'Father\'s middle initial should be a single uppercase letter, optionally followed by a period.';
        $valid = false;
    }

    // mother last name validation
    if (empty($_POST['lastnameMother'])) {
        $_SESSION['lastnameMotherInvalid'] = 'Mother\'s last name is required!';
        $valid = false;
    } elseif (!checkLetters($_POST['lastnameMother'])) {
        $_SESSION['lastnameMotherInvalid'] = 'Mother\'s last name must start with a capital letter and contain only letters!';
        $valid = false;
    }

    // mother first name validation
    if (empty($_POST['firstnameMother'])) {
        $_SESSION['firstnameMotherInvalid'] = 'Mother\'s first name is required!';
        $valid = false;
    } elseif (!checkLetters($_POST['firstnameMother'])) {
        $_SESSION['firstnameMotherInvalid'] = 'Mother\'s first name must start with a capital letter and contain only letters!';
        $valid = false;
    }

    // mother middle initial validation
    if (empty($_POST['middleinitialMother'])) {
        $_SESSION['middleinitialMotherInvalid'] = 'Mother\'s middle initial is required';
        $valid = false;
    } elseif (!preg_match("/^[A-Z]$|^[A-Z]\.$/", $_POST['middleinitialMother'])) {
        $_SESSION['middleinitialMotherInvalid'] = 'Mother\'s middle initial should be a single uppercase letter, optionally followed by a period.';
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
} else {
    echo 'Form has not been submitted yet!';
}
