<?php

require '../functions/validation.php';
require_once '../config/connection.php';
require_once '../model/User.php';
require_once '../controller/session_data.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Handle update operation
    if (isset($_POST['update_user'])) {
        $user_id = $_POST['update_user'];
        $user = new User($conn);

        // Validation and data preparation (same as insert)
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

            "birth_unitInvalid",
            "birth_houseInvalid",
            "birth_streetInvalid",
            "birth_subdivisionInvalid",
            "birth_baranggayInvalid",
            "municipalityInvalid",
            "provinceInvalid",
            "birth_countryInvalid",
            "birth_zipInvalid",

            "unitInvalid",
            "houseNoInvalid",
            "streetInvalid",
            "subdivisionInvalid",
            "baranggayInvalid",
            "cityMunicipalityInvalid",
            "province_homeInvalid",
            "countryInvalid",
            "zipInvalid",

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

        $valid = true;

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

            "birth_unit",
            "birth_house",
            "birth_street",
            "birth_subdivision",
            "birth_baranggay",
            "municipality_birth",
            "province_birth",
            "birth_country",
            "birth_zip",

            "unit",
            "houseNo",
            "street",
            "subdivision",
            "baranggay",
            "cityMunicipality",
            "province_home",
            "country",
            "zip",

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

        foreach ($dataFields as $field) {
            $_SESSION[$field] = trim($_POST[$field]);
        }

        // Validation logic (same as insert)
        validateNameField('lastname', 'lastnameInvalid', 'Last name is required!', $valid);
        validateNameField('firstname', 'firstnameInvalid', 'First name is required!', $valid);
        validateMiddleInitial('middle', 'middleInvalid', $valid);

        validateNameField('lastnameFather', 'lastnameFatherInvalid', 'Father\'s last name is required!', $valid);
        validateNameField('firstnameFather', 'firstnameFatherInvalid', 'Father\'s first name is required!', $valid);
        validateNameField('middleinitialFather', 'middleinitialFatherInvalid', 'Father\'s middle name is required!', $valid);

        validateNameField('lastnameMother', 'lastnameMotherInvalid', 'Mother\'s last name is required!', $valid);
        validateNameField('firstnameMother', 'firstnameMotherInvalid', 'Mother\'s first name is required!', $valid);
        validateNameField('middleinitialMother', 'middleinitialMotherInvalid', 'Mother\'s middle name is required!', $valid);

        validateNameField('nationality', 'nationalityInvalid', 'Nationality is required!', $valid);
        validateNameField('religion', 'religionInvalid', 'Religion is required!', $valid);

        validateDateOfBirth('date', 'dateInvalid', $valid);

        validateRequiredField('sex', 'sexInvalid', 'Gender is required!', $valid);

        validateRequiredField('civilStatus', 'civilStatusInvalid', 'Civil status is required!', $valid);
        if ($_POST['civilStatus'] == 'others') {
            validateNameField('otherStatus', 'otherStatusInvalid', 'Please specify your civil status', $valid);
        }

        validateTax('tax', 'taxInvalid', $valid);

        validateNameField('province_birth', 'provinceInvalid', 'Province is required!', $valid);
        validateTextInput('birth_unit', 'birth_unitInvalid', 'Unit is required!', $valid);
        validateTextInput('birth_house', 'birth_houseInvalid', 'House number is required!', $valid);
        validateNameField('birth_street', 'birth_streetInvalid', 'Street name is required!', $valid);
        validateNameField('birth_subdivision', 'birth_subdivisionInvalid', 'Subdivision name is required!', $valid);
        validateNameField('birth_baranggay', 'birth_baranggayInvalid', 'Baranggay name is required!', $valid);
        validateNameField('municipality_birth', 'municipalityInvalid', 'City/Municipality is required!', $valid);
        validateNameField('province_birth', 'provinceInvalid', 'Province (home) is required!', $valid);
        validateNameField('birth_country', 'birth_countryInvalid', 'Country is required!', $valid);

        validateNameField('province_birth', 'provinceInvalid', 'Province is required!', $valid);
        validateTextInput('unit', 'unitInvalid', 'Unit is required!', $valid);
        validateTextInput('houseNo', 'houseNoInvalid', 'House number is required!', $valid);
        validateNameField('street', 'streetInvalid', 'Street name is required!', $valid);
        validateNameField('subdivision', 'subdivisionInvalid', 'Subdivision name is required!', $valid);
        validateNameField('baranggay', 'baranggayInvalid', 'Baranggay name is required!', $valid);
        validateNameField('cityMunicipality', 'cityMunicipalityInvalid', 'City/Municipality is required!', $valid);
        validateNameField('province_home', 'province_homeInvalid', 'Province (home) is required!', $valid);
        validateNameField('country', 'countryInvalid', 'Country is required!', $valid);

        validateNumeric('zip', 'zipInvalid', 'Zip code is required!', $valid);
        validateNumeric('birth_zip', 'birth_zipInvalid', 'Zip code is required!', $valid);
        validateNumeric('mobile', 'mobileInvalid', 'Mobile number is required!', $valid);
        validateEmail('email', 'emailInvalid', $valid);
        validateTelephone('telephone', 'telephoneInvalid', 'Telephone number is required!', $valid);

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

                "b_unit" => "birth_unit",
                "b_house" => "birth_house",
                "b_subdivision" => "birth_subdivision",
                "b_baranggay" => "birth_baranggay",
                "municipality_birth" => "municipality_birth",
                "province_birth" => "province_birth",
                "b_country" => "birth_country",
                "b_zip" => "birth_zip",
                "b_street" => "birth_street",

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

            // Update user
            if ($user->update($user_id, $data)) {
                header("Location: ../views/dataView.php?success=Updated successfully");
                exit();
            } else {
                header("Location: ../views/dataView.php?error=Failed to update user");
                exit();
            }
        } else {
            header("Location: ../index.php");
            exit();
        }
    }
} else {
    echo 'Form has not been submitted yet!';
}
