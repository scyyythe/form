<?php
class User
{
    private $conn;

    public function __construct($db_conn)
    {
        $this->conn = $db_conn;
    }

    private function bindValues($statement, $data)
    {
        $placeholders = [];
        preg_match_all('/:([a-zA-Z0-9_]+)/', $statement->queryString, $placeholders);

        foreach ($placeholders[1] as $placeholder) {
            if (isset($data[$placeholder])) {
                $statement->bindValue(":$placeholder", $data[$placeholder]);
            }
        }
    }

    public function insert($data)
    {
        //user
        $userQuery = "INSERT INTO users (firstname, lastname, middle, dob, age, sex, civil_status, other_status, tax, nationality, religion) 
                      VALUES (:firstname, :lastname, :middle, :dob, :age, :sex, :civil_status, :other_status, :tax, :nationality, :religion)";
        $statement = $this->conn->prepare($userQuery);
        $this->bindValues($statement, $data);
        if (!$statement->execute()) {
            print_r($statement->errorInfo());
            exit();
        }

        $user_id = $this->conn->lastInsertId();
        if (!$user_id) {
            return "Failed to insert user.";
        }
        $data['user_id'] = $user_id;

        //address
        $addressQuery = "INSERT INTO addresses (user_id, unit, house_no, street, subdivision, baranggay, city_municipality, province_home, country, zip) 
                         VALUES (:user_id, :unit, :house_no, :street, :subdivision, :baranggay, :city_municipality, :province_home, :country, :zip)";
        $statement = $this->conn->prepare($addressQuery);
        $this->bindValues($statement, $data);
        $statement->execute();


        //birth
        $birthPlaceQuery = "INSERT INTO birth_place (user_id, city, municipality_birth, province_birth)
                            VALUES (:user_id, :city, :municipality_birth, :province_birth)";
        $statement = $this->conn->prepare($birthPlaceQuery);
        $this->bindValues($statement, $data);
        $statement->execute();

        //contancts
        $contactQuery = "INSERT INTO contacts (user_id, mobile, email, telephone) 
                         VALUES (:user_id, :mobile, :email, :telephone)";
        $statement = $this->conn->prepare($contactQuery);
        $this->bindValues($statement, $data);
        $statement->execute();

        //parents
        $parentQuery = "INSERT INTO parents (user_id, father_lastname, father_firstname, father_middleinitial, mother_lastname, mother_firstname, mother_middleinitial) 
                        VALUES (:user_id, :father_lastname, :father_firstname, :father_middleinitial, :mother_lastname, :mother_firstname, :mother_middleinitial)";
        $statement = $this->conn->prepare($parentQuery);
        $this->bindValues($statement, $data);
        $statement->execute();

        return true;
    }
}
