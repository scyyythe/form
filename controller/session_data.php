<?php
session_start();

// Validations
$fields = [
    "lastnameInvalid",
    "firstnameInvalid",
    "middleInvalid",
    "dateInvalid",
    "sexInvalid",
    "civilStatusInvalid",
    "otherStatusInvalid",
    "taxInvalid",
    "nationalityInvalid",
    "religionInvalid",
    "cityInvalid",
    "municipalityInvalid",
    "provinceInvalid",

    "unitInvalid",
    "houseNoInvalid",
    "streetInvalid",
    "subdivisionInvalid",
    "baranggayInvalid",
    "cityMunicipalityInvalid",
    "province_homeInvalid",
    "countryInvalid",
    "zipInvalid",

    "mobileInvalid",
    "emailInvalid",
    "telephoneInvalid",
    "lastnameFatherInvalid",
    "firstnameFatherInvalid",
    "middleinitialFatherInvalid",
    "lastnameMotherInvalid",
    "firstnameMotherInvalid",
    "middleinitialMotherInvalid"
];

foreach ($fields as $field) {
    ${$field} = $_SESSION[$field] ?? "";
}

//store data

$fields = [
    "lastname",
    "firstname",
    "middle",
    "date",
    "sex",
    "civilStatus",
    "otherStatus",
    "tax",
    "nationality",
    "religion",
    "city",
    "municipality_birth",
    "province_birth",

    "unit",
    "houseNo",
    "street",
    "subdivision",
    "baranggay",
    "cityMunicipality",
    "province_home",
    "country",
    "zip",

    "mobile",
    "email",
    "telephone",
    "lastnameFather",
    "firstnameFather",
    "middleinitialFather",
    "lastnameMother",
    "firstnameMother",
    "middleinitialMother"
];

foreach ($fields as $field) {
    ${$field} = htmlspecialchars($_SESSION[$field] ?? '');
}
