<?php
require 'controller/session_data.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="image/icons8-male-user-30.png" />
    <link rel="stylesheet" href="css/style.css">
    <title>Personal Information</title>
</head>

<body>
    <h1>Successful!</h1>

    <p>Last Name: <?php echo $lastname; ?></p>
    <p>First Name: <?php echo $firstname; ?></p>
    <p>Middle Name: <?php echo $middle; ?></p>
    <p>Date of Birth: <?php echo $date ?></p>
    <p>Sex: <?php echo $sex ?></p>
    <p>Civil Status: <?php echo $civilStatus; ?></p>
    <?php
    if ($civilStatus === 'others' && !empty($otherStatus)) {
        echo "<p>Specified Status: " . $otherStatus . "</p>";
    }
    ?>
    <p>Tax Number: <?php echo $tax ?></p>
    <p>Nationality: <?php echo $nationality ?></p>
    <p>Religion: <?php echo $religion ?></p>
    <p>City: <?php echo $city ?></p>
    <p>Municipality: <?php echo $municipality ?></p>
    <p>Province: <?php echo $province ?></p>

    <p>Unit: <?php echo $unit; ?></p>
    <p>House Number: <?php echo $houseNo; ?></p>
    <p>Street: <?php echo $street; ?></p>
    <p>Subdivision: <?php echo $subdivision; ?></p>
    <p>Barangay: <?php echo $baranggay; ?></p>
    <p>City/Municipality: <?php echo $cityMunicipality; ?></p>
    <p>Province: <?php echo $province_home; ?></p>
    <p>Country: <?php echo $country; ?></p>
    <p>Zip Code: <?php echo $zip; ?></p>

    <p>Mobile: <?php echo $mobile; ?></p>
    <p>Email: <?php echo $email; ?></p>
    <p>Telephone: <?php echo $telephone; ?></p>

    <p>Father's Last Name: <?php echo $lastnameFather; ?></p>
    <p>Father's First Name: <?php echo $firstnameFather; ?></p>
    <p>Father's Middle Initial: <?php echo $middleinitialFather; ?></p>

    <p>Mother's Last Name: <?php echo $lastnameMother; ?></p>
    <p>Mother's First Name: <?php echo $firstnameMother; ?></p>
    <p>Mother's Middle Initial: <?php echo $middleinitialMother; ?></p>

</body>

</html>