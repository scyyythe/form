<?php
include 'config/connection.php';

$query = "SELECT DISTINCT city_municipality FROM addresses";
$statement = $conn->query($query);
$cities = $statement->fetchAll();

$selectedCity = isset($_POST['city']) ? $_POST['city'] : null;
$places = [];

if (!empty($selectedCity)) {
    $query = "SELECT addresses.*, users.firstname 
    FROM addresses 
    INNER JOIN users ON addresses.user_id = users.user_id
    WHERE addresses.city_municipality = :city";
    $statement = $conn->prepare($query);
    $statement->bindValue(":city", $selectedCity);
    $statement->execute();
    $places = $statement->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="POST">

        <label for="">Select Municipality</label>
        <select name="city" onchange="this.form.submit()"><br>
            <option value="">Select City</option>
            <?php
            foreach ($cities as $city) {
                $cityName = $city['city_municipality'];

                if ($selectedCity == $cityName) {
                    $isSelected = 'selected';
                } else {
                    $isSelected = '';
                }

                echo "<option value='$cityName' $isSelected>$cityName</option>";
            }
            ?>

        </select>

        <h2>Display Places of <?php echo $selectedCity ?></h2>
        <ul>
            <?php
            foreach ($places as $place) {
                echo $place['firstname'] . "<br>";
            }
            ?>
        </ul>
    </form>
</body>

</html>