<?php
session_start();

$lastname = htmlspecialchars($_SESSION['lastname']);
$firstname = htmlspecialchars($_SESSION['firstname']);
$middle = htmlspecialchars($_SESSION['middle']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Personal Information</title>
</head>

<body>
    <h1>Successful!</h1>

    <p><strong>Last Name:</strong> <?php echo $lastname; ?></p>
    <p><strong>First Name:</strong> <?php echo $firstname; ?></p>
    <p><strong>Middle Name:</strong> <?php echo $middle; ?></p>

</body>

</html>