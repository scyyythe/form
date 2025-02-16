<?php

include 'controller/session_data.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="image/icons8-male-user-30.png" />
  <link rel="stylesheet" href="css/style.css" />
  <title>Personal Information</title>
</head>

<body style="background-color: rgba(200, 228, 255, 0.13)">
  <header>
    <div class="header-success">
      <h3>Dashboard</h3>
      <h3>Personal Settings</h3>
    </div>
  </header>
  <div class="wrapper">
    <section>
      <div class="left-card">
        <div class="profile">
          <div class="img">
            <img src="image/profile.png" alt="profile picture" />
          </div>
          <h5>Profile</h5>
        </div>

        <div class="card-info">
          <label for="name">Name</label><br />
          <input type="text" value="<?php echo $firstname . ' ' . strtoupper(substr($middle, 0, 1)) . '. ' . $lastname; ?>" readonly />
        </div>

        <?php
        $formattedDate = date('F j, Y', strtotime($date));
        $birthDate = new DateTime($date);
        $today = new DateTime('today');
        $age = $birthDate->diff($today)->y;
        ?>

        <div class="card-info">
          <br /><label for="date">Date of Birth</label><br />
          <input type="text" value="<?php echo $formattedDate; ?>" readonly />
        </div>

        <div class="card-info">
          <br /><label for="age">Age</label><br />
          <input type="text" value="<?php echo $age . ' years old'; ?>" readonly />
        </div>

        <div class="card-info">
          <br /><label for="status">Civil Status</label><br />
          <input type="text"
            value="<?php
                    if ($civilStatus === 'others' && !empty($otherStatus)) {
                      echo $otherStatus;
                    } else {
                      echo $civilStatus;
                    }
                    ?>"
            readonly />
        </div>


        <div class="info-icon">
          <img src="image/info.png" alt="information" />
        </div>
      </div>
    </section>

    <section>
      <div class="board2">
        <div class="card-info">
          <label for="sex">Gender</label><br />
          <input type="text" value="<?php echo $sex ?>" readonly />
        </div>

        <div class="card-info">
          <label for="nationality">Nationality</label><br />
          <input type="text" value="<?php echo $nationality ?>" readonly />
        </div>

        <div class="card-info">
          <label for="religion">Religion</label><br />
          <input type="text" value="<?php echo $religion ?>" readonly />
        </div>

        <div class="card-info">
          <label for="tax">Tax Identification Number</label><br />
          <input type="text" value="<?php echo $tax; ?>" readonly />
        </div>
      </div>

      <!-- <div class="infos">
  <p>RM/FLR/Unit No. & House/Lot & Blk. No., Street Name, Barangay/District/Locality, City/Municipality, Province</p>
</div>
 -->
      <div class="home-add-card">
        <div class="head-home-add">
          <h5>Home Address</h5>
        </div>

        <div class="infos">
          <img src="image/home.png" alt="home" />
          <small><?php echo $houseNo . ', ' . $street . ', ' . $baranggay . ', ' . $cityMunicipality . ', ' . $province_home; ?></small>
        </div>
        <br />
        <div class="infos2">
          <div class="card-info2">
            <label for="subdivision">Subdivision</label><br />
            <input type="text" value="<?php echo $subdivision; ?>" readonly />
          </div>
          <div class="card-info2">
            <label for="country">Country</label><br />
            <input type="text" value="<?php echo $country; ?>" readonly />
          </div>
          <div class="card-info2">
            <label for="zip">Zip Code</label><br />
            <input type="text" value="<?php echo $zip; ?>" readonly />
          </div>
        </div>

        <div class="birthplace-card">
          <h5>Place of Birth</h5>
          <div class="birth">
            <img src="image/home.png" alt="home" />
            <small>Born in <?php echo $municipality_birth . ', ' . $province_birth . ', ' . $city; ?></small>
          </div>
        </div>
      </div>
      <div class="guardians-display">
        <h5>Parent's Information</h5>
        <div class="guardian-info">
          <div class="mother-info-display">
            <div class="card-info2">
              <label for="mother">Mother's Name</label><br />
              <input type="text" value="Lorecris Dular Ibalarrosa" readonly />
            </div>
          </div>
          <div class="father-info-display">
            <div class="card-info2">
              <label for="father">Father's Name</label><br />
              <input type="text" value="Armando Zafra Canete" readonly />
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="contactinfo">
      <div class="board3">
        <div class="head-board3">
          <img src="image/contact.png" alt="contactr image" />
          <h5>Contact Information</h5>
        </div>

        <div class="card-info">
          <label for="cellphone">Cellphone</label><br />
          <input type="text" value="<?php echo $mobile; ?>" readonly />
        </div>
        <div class="card-info">
          <br /><label for="email">Email Address</label><br />
          <input type="text" value="<?php echo $email; ?>" readonly />
        </div>
        <div class="card-info">
          <br /><label for="telephone">Telephone</label><br />
          <input type="text" value="<?php echo $telephone; ?>" readonly />
        </div>
      </div>

      <div class="btn2">
        <button onclick="window.location.href='return.php'">Return</button>
        <button>Update Information</button>
      </div>
    </section>



  </div>

</body>

</html>