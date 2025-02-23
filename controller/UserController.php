
<?php

require '../functions/validation.php';
require_once '../config/connection.php';
require_once '../model/User.php';
require_once '../controller/session_data.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User($conn);

    $valid = true;

    if (isset($_POST['update_user'])) {
        $user_id = $_POST['update_user'];
        $data = $_POST;
        unset($data['update_user']);

        validateUserInput($valid);

        if ($valid) {
            if ($user->update($user_id, $data)) {
                header("Location: ../success.php?id=" . urlencode($user_id));
                exit();
            }
        } else {
            header("Location: ../views/updateView.php?id=" . urlencode($user_id));
            exit();
        }
    }

    validateUserInput($valid);

    if ($valid) {
        $dob = $_SESSION['date'] ?? '';
        $age = $user->calculateAge($dob);

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
            "b_street" => "birth_street",
            "b_subdivision" => "birth_subdivision",
            "b_baranggay" => "birth_baranggay",
            "municipality_birth" => "municipality_birth",
            "province_birth" => "province_birth",
            "b_country" => "birth_country",
            "b_zip" => "birth_zip",
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

        $result = $user->insert($data);

        if ($result !== true) {
            echo "Insert failed: " . $result;
            exit();
        }

        header("Location: ../views/dataView.php");
        exit();
    } else {
        header("Location: ../index.php");
        exit();
    }
} else {
    echo 'Form has not been submitted yet!';
}
