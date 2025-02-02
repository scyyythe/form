<?php
session_start();

//validations
$lastnameInvalid = isset($_SESSION['lastnameInvalid']) ? $_SESSION['lastnameInvalid'] : '';
$firstnameInvalid = isset($_SESSION['firstnameInvalid']) ? $_SESSION['firstnameInvalid'] : '';
$middleInvalid = isset($_SESSION['middleInvalid']) ? $_SESSION['middleInvalid'] : '';
$dateInvalid = isset($_SESSION['dateInvalid']) ? $_SESSION['dateInvalid'] : '';
$sexInvalid = isset($_SESSION['sexInvalid']) ? $_SESSION['sexInvalid'] : '';
$civilStatusInvalid = isset($_SESSION['civilStatusInvalid']) ? $_SESSION['civilStatusInvalid'] : '';
$otherStatusInvalid = isset($_SESSION['otherStatusInvalid']) ? $_SESSION['otherStatusInvalid'] : '';
$taxInvalid = isset($_SESSION['taxInvalid']) ? $_SESSION['taxInvalid'] : '';
$nationalityInvalid = isset($_SESSION['nationalityInvalid']) ? $_SESSION['nationalityInvalid'] : '';
$religionInvalid = isset($_SESSION['religionInvalid']) ? $_SESSION['religionInvalid'] : '';
$cityInvalid = isset($_SESSION['cityInvalid']) ? $_SESSION['cityInvalid'] : '';
$municipalityInvalid = isset($_SESSION['municipalityInvalid']) ? $_SESSION['municipalityInvalid'] : '';
$provinceInvalid = isset($_SESSION['provinceInvalid']) ? $_SESSION['provinceInvalid'] : '';

//stored data
$lastname = htmlspecialchars($_SESSION['lastname']);
$firstname = htmlspecialchars($_SESSION['firstname']);
$middle = htmlspecialchars($_SESSION['middle']);
$date = htmlspecialchars($_SESSION['date']);
$sex = htmlspecialchars($_SESSION['sex']);
$civilStatus = htmlspecialchars($_SESSION['civilStatus']);
$otherStatus = htmlspecialchars($_SESSION['otherStatus']);
$tax = htmlspecialchars($_SESSION['tax']);
$nationality = htmlspecialchars($_SESSION['nationality']);
$religion = htmlspecialchars($_SESSION['religion']);
$city = htmlspecialchars($_SESSION['city']);
$municipality = htmlspecialchars($_SESSION['municipality_birth']);
$province = htmlspecialchars($_SESSION['province_birth']);
