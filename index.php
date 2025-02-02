<?php
require 'controller/session_data.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="icon" type="image/png" href="image/icons8-google-forms-48.png" />
  <title>Form Input</title>
</head>

<body>
  <header>
    <h1 class="">PERSONAL DATA</h1>
  </header>
  <div class="container">
    <form action="controller/submit.php" class="form" method="POST">
      <div class="tab active first">
        <p class="p1"><b>Fill up your personal information.</b></p>

        <div class="upper">
          <div class="input">
            <label for="lastname">Last Name</label><br />
            <input type="text" name="lastname" placeholder="Last Name" /><br>
            <span class="error"><?php echo $lastnameInvalid; ?></span>
          </div>

          <div class="input">
            <label for="firstname">First Name</label>
            <br />
            <input type="text" name="firstname" placeholder="First Name" /><br>
            <span class="error"><?php echo $firstnameInvalid; ?></span>
          </div>

          <div class="input">
            <label for="middle">Middle Initial</label>
            <br />
            <input type="text" name="middle" placeholder="e.g., I" /><br>
            <span class="error"><?php echo $middleInvalid; ?></span>
          </div>
        </div>

        <div class="center">
          <div class="input">
            <label for="date">Date of Birth</label><br />
            <input type="date" name="date" /><br />
            <span class="error"><?php echo $dateInvalid; ?></span>
          </div>

          <div class="input2">
            <label for="sex">Sex</label>
            <div class="radio-group">
              <div>
                <input type="radio" name="sex" id="male" value="Male" />
                <label for="male">Male</label>
              </div>
              <div>
                <input type="radio" name="sex" id="female" value="Female" />
                <label for="female">Female</label>
              </div>
            </div>
            <span class="error"><?php echo $sexInvalid; ?></span>
          </div>

          <div class="input">
            <label for="civilStatus">Civil Status</label><br />

            <div class="select">
              <select
                name="civilStatus"
                id="civilStatus"
                onchange="clickOthers()">
                <option value="" disabled selected>Select Civil Status</option>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Widowed">Widowed</option>
                <option value="Legally Separated">Legally Separated</option>
                <option value="others">Others</option>
              </select><br>
              <span class="error"><?php echo $_SESSION['civilStatusInvalid']; ?></span>
            </div>
            <input
              type="text"
              id="otherStatus"
              name="otherStatus"
              placeholder="Specify your status"
              style="display: none" />
            <span class="error"><?php echo $_SESSION['otherStatusInvalid']; ?></span>
          </div>
        </div>
        <div class="center2">
          <div class="input">
            <label for="tax">Tax Identification Number</label><br />
            <input
              type="text"
              name="tax"
              placeholder="e.g., 123-45-6789" /><br />
            <span class="error"><?php echo $_SESSION['taxInvalid']; ?></span>
          </div>
          <div class="input">
            <label for="nationality">Nationality</label><br />
            <input
              type="text"
              name="nationality"
              placeholder="Nationality" /><br />
            <span class="error"><?php echo $_SESSION['nationalityInvalid']; ?></span>
          </div>
          <div class="input">
            <label for="religion">Religion</label><br />
            <input type="text" name="religion" placeholder="Religion" /><br>
            <span class="error"><?php echo $_SESSION['religionInvalid']; ?></span>
          </div>
        </div>
        <div class="foot">
          <h3>Place of Birth</h3>

          <div class="foot1">
            <div class="input">
              <label for="city">City</label><br />
              <input type="text" name="city" placeholder="e.g., Cebu City" /><br>
              <span class="error"><?php echo $_SESSION['cityInvalid']; ?></span>
            </div>
            <div class="input">
              <label for="municipality">Municipality</label><br />
              <input
                type="text"
                name="municipality"
                placeholder="e.g., Minglanilla" /><br />
              <span class="error"><?php echo $_SESSION['municipalityInvalid']; ?></span>
            </div>
          </div>

          <div class="foot2">
            <div class="input">
              <label for="province">Province</label><br />
              <input
                type="text"
                name="province"
                placeholder="e.g., Cebu" /><br />
              <span class="error"><?php echo $_SESSION['provinceInvalid']; ?></span>
            </div>

            <div class="buttons">
              <button type="button" onclick="nextTab()">&#8594;</button>
            </div>
          </div>
        </div>
      </div>

      <div class="tab">
        <h3>Home Address</h3>
        <div class="container_home">
          <div class="left_home">
            <div class="input in_num">
              <label for="unit">RM/FLR/Unit No. & Bldg. Name</label><br />
              <input
                type="text"
                name="unit"
                placeholder="e.g., 1234 Unit Bldg." /><br />
            </div>
            <div class="input in_num">
              <label for="houseNo">House/Lot & Blk. No</label><br />
              <input
                type="text"
                name="houseNo"
                placeholder="e.g., 5678 Block 9" /><br />
            </div>

            <div class="input">
              <label for="street">Street Name</label><br />
              <input
                type="text"
                name="street"
                placeholder="e.g., Main Street" /><br />
            </div>
            <div class="input">
              <label for="subdivision">Subdivision</label><br />
              <input
                type="text"
                name="subdivision"
                placeholder="e.g., Sunshine Subdivision" /><br />
            </div>

            <div class="input">
              <label for="baranggay">Barangay/District/Locality</label><br />
              <input
                type="text"
                name="barangay"
                placeholder="e.g., Poblacion" /><br />
            </div>
          </div>

          <div class="right_home">
            <div class="input">
              <label for="cityMunicipality">City/Municipality</label><br />
              <input
                type="text"
                name="cityMunicipality"
                placeholder="e.g., Minglanilla" /><br />
            </div>
            <div class="input">
              <label for="province">Province</label><br />
              <input
                type="text"
                name="province"
                placeholder="e.g., Cebu" /><br />
            </div>
            <div class="input">
              <label for="country">Country</label><br />
              <input
                type="text"
                name="country"
                placeholder="e.g., Philippines" /><br />
            </div>
            <div class="input">
              <label for="zip">Zip Code</label><br />
              <input type="text" name="zip" placeholder="e.g., 6046" /><br />
            </div>

            <div class="buttons home_button">
              <button type="button" onclick="prevTab()">&#8592;</button>
              <button type="button" onclick="nextTab()">&#8594;</button>
            </div>
          </div>
        </div>
      </div>

      <div class="tab">
        <h3>Contact Information</h3>

        <div class="upper">
          <div class="input">
            <label for="mobile">Mobile/ Cellphone Number</label>
            <input
              type="text"
              name="mobile"
              placeholder="e.g., 09123456789" /><br />
          </div>
          <div class="input">
            <label for="email">Email Address</label><br />
            <input
              type="email"
              name="email"
              placeholder="Email Address" /><br />
          </div>
          <div class="input">
            <label for="telephone">Telephone</label><br />
            <input
              type="text"
              name="telephone"
              placeholder="e.g., (032) 123-4567" /><br />
          </div>
        </div>
        <h3>Guardian's Information</h3>
        <div class="guardian">
          <div class="father_info">
            <h5>Father's Name</h5>
            <label for="lastnameFather">Last Name</label><br />
            <input
              type="text"
              name="lastnameFather"
              placeholder="Father's Last Name" /><br />

            <label for="firstnameFather">First Name</label><br />
            <input
              type="text"
              name="firstnameFather"
              placeholder="Father's First Name" /><br />

            <label for="middleinitialFather">Middle Initial</label><br />
            <input
              type="text"
              name="middleinitialFather"
              placeholder="Father's Middle Initial" /><br />
          </div>

          <div class="mother_info">
            <h5>Mother's Maiden Name</h5>
            <label for="lastnameMother">Last Name</label><br />
            <input
              type="text"
              name="lastnameMother"
              placeholder="Mother's Last Name" /><br />

            <label for="firstnameMother">First Name</label><br />
            <input
              type="text"
              name="firstnameMother"
              placeholder="Mother's First Name" /><br />

            <label for="middleinitialMother">Middle Initial</label><br />
            <input
              type="text"
              name="middleinitialMother"
              placeholder="Mother's Middle Inital" /><br />
          </div>
        </div>

        <div class="buttons button2">
          <button type="button" onclick="prevTab()">&#8592;</button>
          <button type="submit">Submit</button>
        </div>
      </div>
    </form>
  </div>

  <script src="js/main.js"></script>
</body>

</html>