<?php
include 'config/connection.php';

$query = "SELECT DISTINCT city_municipality FROM addresses ORDER BY city_municipality ASC";
$stmt = $conn->query($query);
$cities = $stmt->fetchAll();


$selectedCity = isset($_POST['city']) ? $_POST['city'] : null;
$places = [];

if (!empty($selectedCity)) {
    $query = "SELECT * FROM addresses WHERE city_municipality = :city";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":city", $selectedCity, PDO::PARAM_STR);
    $stmt->execute();
    $places = $stmt->fetchAll();
}
?>

<form method="POST">
    <label>Select City:</label>
    <select name="city" onchange="this.form.submit()">
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
</form>


<h2>Places in <?php echo $selectedCity; ?></h2>
<ul>
    <?php foreach ($places as $place) { ?>
        <li><?php echo $place['city_municipality'] . " - " . $place['baranggay'] . "-" . $place['unit']; ?></li>
    <?php } ?>
</ul>