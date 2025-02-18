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


        //birth
        $birthPlaceQuery = "INSERT INTO birth_place (user_id, b_unit, b_house, b_street, b_subdivision, b_baranggay, b_country, b_zip, municipality_birth, province_birth)
          VALUES (:user_id, :b_unit, :b_house, :b_street, :b_subdivision, :b_baranggay, :b_country, :b_zip,:municipality_birth, :province_birth)";
        $statement = $this->conn->prepare($birthPlaceQuery);
        $this->bindValues($statement, $data);
        echo $birthPlaceQuery;
        print_r($data);  // Display the array of data being passed

        $statement->execute();

        return true;
    }

    public function getAll()
    {
        $dataQuery = "SELECT users.user_id, users.firstname, users.lastname, users.middle, users.dob,users.age, users.sex, users.civil_status, users.other_status, users.tax, users.nationality, users.religion,
        
        ad.unit, ad.house_no, ad.street, ad.subdivision, ad.baranggay, ad.city_municipality, ad.province_home, ad.country, ad.zip, 
         
         birth.municipality_birth, birth.province_birth,

        contacts.mobile, contacts.email, contacts.telephone,
        
        parents.father_lastname, parents.father_firstname, parents.father_middleinitial, parents.mother_lastname, parents.mother_firstname, parents.mother_middleinitial
        
        FROM users 
        LEFT JOIN addresses ad ON users.user_id = ad.user_id
        LEFT JOIN birth_place birth ON users.user_id = birth.user_id
        LEFT JOIN contacts ON users.user_id = contacts.user_id
        LEFT JOIN parents ON users.user_id = parents.user_id";

        $statement = $this->conn->prepare($dataQuery);
        if (!$statement->execute()) {
            print_r($statement->errorInfo());
            exit();
        }
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getUserDetails($user_id)
    {
        $query = "SELECT users.user_id, users.firstname, users.lastname, users.middle, users.dob, users.age, users.sex, users.civil_status, users.other_status, users.tax, users.nationality, users.religion,
        
        ad.unit, ad.house_no, ad.street, ad.subdivision, ad.baranggay, ad.city_municipality, ad.province_home, ad.country, ad.zip, 
         
        birth.city, birth.municipality_birth, birth.province_birth,
    
        contacts.mobile, contacts.email, contacts.telephone,
        
        parents.father_lastname, parents.father_firstname, parents.father_middleinitial, parents.mother_lastname, parents.mother_firstname, parents.mother_middleinitial
        
        FROM users 
        LEFT JOIN addresses ad ON users.user_id = ad.user_id
        LEFT JOIN birth_place birth ON users.user_id = birth.user_id
        LEFT JOIN contacts ON users.user_id = contacts.user_id
        LEFT JOIN parents ON users.user_id = parents.user_id
        WHERE users.user_id = :user_id";

        $statement = $this->conn->prepare($query);
        $statement->bindParam(':user_id', $user_id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
