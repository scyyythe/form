<?php
session_start();

// Validations
$lastnameInvalid = $_SESSION['lastnameInvalid'];
$firstnameInvalid = $_SESSION['firstnameInvalid'];
$middleInvalid = $_SESSION['middleInvalid'];
$dateInvalid = $_SESSION['dateInvalid'];
$sexInvalid = $_SESSION['sexInvalid'];
$civilStatusInvalid = $_SESSION['civilStatusInvalid'];
$otherStatusInvalid = $_SESSION['otherStatusInvalid'];
$taxInvalid = $_SESSION['taxInvalid'];
$nationalityInvalid = $_SESSION['nationalityInvalid'];
$religionInvalid = $_SESSION['religionInvalid'];
$cityInvalid = $_SESSION['cityInvalid'];
$municipalityInvalid = $_SESSION['municipalityInvalid'];
$provinceInvalid = $_SESSION['provinceInvalid'];

$unitInvalid = $_SESSION['unitInvalid'];
$houseNoInvalid = $_SESSION['houseNoInvalid'];
$streetInvalid = $_SESSION['streetInvalid'];
$subdivisionInvalid = $_SESSION['subdivisionInvalid'];
$baranggayInvalid = $_SESSION['baranggayInvalid'];
$cityMunicipalityInvalid = $_SESSION['cityMunicipalityInvalid'];
$province_homeInvalid = $_SESSION['province_homeInvalid'];
$countryInvalid = $_SESSION['countryInvalid'];
$zipInvalid = $_SESSION['zipInvalid'];

$mobileInvalid = $_SESSION['mobileInvalid'];
$emailInvalid = $_SESSION['emailInvalid'];
$telephoneInvalid = $_SESSION['telephoneInvalid'];

$lastnameFatherInvalid = $_SESSION['lastnameFatherInvalid'];
$firstnameFatherInvalid = $_SESSION['firstnameFatherInvalid'];
$middleinitialFatherInvalid = $_SESSION['middleinitialFatherInvalid'];

$lastnameMotherInvalid = $_SESSION['lastnameMotherInvalid'];
$firstnameMotherInvalid = $_SESSION['firstnameMotherInvalid'];
$middleinitialMotherInvalid = $_SESSION['middleinitialMotherInvalid'];

//store data
$lastname = htmlspecialchars($_SESSION['lastname'] ?? '');
$firstname = htmlspecialchars($_SESSION['firstname'] ?? '');
$middle = htmlspecialchars($_SESSION['middle'] ?? '');
$date = htmlspecialchars($_SESSION['date'] ?? '');
$sex = htmlspecialchars($_SESSION['sex'] ?? '');
$civilStatus = htmlspecialchars($_SESSION['civilStatus'] ?? '');
$otherStatus = htmlspecialchars($_SESSION['otherStatus'] ?? '');
$tax = htmlspecialchars($_SESSION['tax'] ?? '');
$nationality = htmlspecialchars($_SESSION['nationality'] ?? '');
$religion = htmlspecialchars($_SESSION['religion'] ?? '');
$city = htmlspecialchars($_SESSION['city'] ?? '');
$municipality = htmlspecialchars($_SESSION['municipality_birth'] ?? '');
$province = htmlspecialchars($_SESSION['province_birth'] ?? '');

$unit = htmlspecialchars($_SESSION['unit'] ?? '');
$houseNo = htmlspecialchars($_SESSION['houseNo'] ?? '');
$street = htmlspecialchars($_SESSION['street'] ?? '');
$subdivision = htmlspecialchars($_SESSION['subdivision'] ?? '');
$baranggay = htmlspecialchars($_SESSION['baranggay'] ?? '');
$cityMunicipality = htmlspecialchars($_SESSION['cityMunicipality'] ?? '');
$province_home = htmlspecialchars($_SESSION['province_home'] ?? '');
$country = htmlspecialchars($_SESSION['country'] ?? '');
$zip = htmlspecialchars($_SESSION['zip'] ?? '');

$mobile = htmlspecialchars($_SESSION['mobile'] ?? '');
$email = htmlspecialchars($_SESSION['email'] ?? '');
$telephone = htmlspecialchars($_SESSION['telephone'] ?? '');

$lastnameFather = htmlspecialchars($_SESSION['lastnameFather'] ?? '');
$firstnameFather = htmlspecialchars($_SESSION['firstnameFather'] ?? '');
$middleinitialFather = htmlspecialchars($_SESSION['middleinitialFather'] ?? '');

$lastnameMother = htmlspecialchars($_SESSION['lastnameMother'] ?? '');
$firstnameMother = htmlspecialchars($_SESSION['firstnameMother'] ?? '');
$middleinitialMother = htmlspecialchars($_SESSION['middleinitialMother'] ?? '');
