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
    public function calculateAge($dob)
    {
        if (empty($dob)) {
            return null;
        }

        $dob = new DateTime($dob);
        $today = new DateTime();
        return $today->diff($dob)->y;
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
        $statement->execute();

        return true;
    }

    public function getAll()
    {
        $dataQuery = "SELECT users.user_id, users.firstname, users.lastname, users.middle, users.dob,users.age, users.sex, users.civil_status, users.other_status, users.tax, users.nationality, users.religion,
        
        ad.unit, ad.house_no, ad.street, ad.subdivision, ad.baranggay, ad.city_municipality, ad.province_home, ad.country, ad.zip, 
         
        birth.b_unit, birth.b_house, birth.b_subdivision, birth.b_baranggay, birth.municipality_birth, birth.province_birth, birth.b_country,  birth.b_zip, birth.b_street,
        
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
         
        birth.b_unit, birth.b_house, birth.b_subdivision, birth.b_baranggay, birth.municipality_birth, birth.province_birth, birth.b_country,  birth.b_zip, birth.b_street,
    
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

    public function update($user_id, $fields)
    {
        $fields['age'] = $this->calculateAge($fields['date']);
        $fields['dob'] = $fields['date'];
        unset($fields['date']);

        $fields['father_lastname'] = $fields['lastnameFather'];
        $fields['father_firstname'] = $fields['firstnameFather'];
        $fields['father_middleinitial'] = $fields['middleinitialFather'];
        $fields['mother_lastname'] = $fields['lastnameMother'];
        $fields['mother_firstname'] = $fields['firstnameMother'];
        $fields['mother_middleinitial'] = $fields['middleinitialMother'];


        $fields['user_id'] = $user_id;


        $userQuery = "UPDATE users 
                        SET firstname = :firstname, lastname = :lastname, middle = :middle, dob = :dob, 
                            age = :age, sex = :sex, civil_status = :civilStatus, other_status = :otherStatus, 
                            tax = :tax, nationality = :nationality, religion = :religion
                        WHERE user_id = :user_id";

        $statement = $this->conn->prepare($userQuery);
        $this->bindValues($statement, $fields);
        $statement->execute();

        // Update address
        $addressQuery = "UPDATE addresses 
                         SET unit = :unit, house_no = :houseNo, street = :street, subdivision = :subdivision, 
                             baranggay = :baranggay, city_municipality = :cityMunicipality, province_home = :province_home, 
                             country = :country, zip = :zip 
                         WHERE user_id = :user_id";

        $statement = $this->conn->prepare($addressQuery);
        $this->bindValues($statement, $fields);
        $statement->execute();

        // Update birth place
        $birthPlaceQuery = "UPDATE birth_place 
                        SET b_unit = :birth_unit, b_house = :birth_house, b_street = :birth_street, 
                            b_subdivision = :birth_subdivision, b_baranggay = :birth_baranggay, 
                            b_country = :birth_country, b_zip = :birth_zip, 
                            municipality_birth = :municipality_birth, province_birth = :province_birth
                        WHERE user_id = :user_id";

        $statement = $this->conn->prepare($birthPlaceQuery);
        $this->bindValues($statement, $fields);
        $statement->execute();

        // Update contacts
        $contactQuery = "UPDATE contacts 
                             SET mobile = :mobile, email = :email, telephone = :telephone 
                             WHERE user_id = :user_id";

        $statement = $this->conn->prepare($contactQuery);
        $this->bindValues($statement, $fields);
        $statement->execute();

        // Update parents
        $parentQuery = "UPDATE parents 
                            SET father_lastname = :father_lastname, father_firstname = :father_firstname, 
                                father_middleinitial = :father_middleinitial, mother_lastname = :mother_lastname, 
                                mother_firstname = :mother_firstname, mother_middleinitial = :mother_middleinitial 
                            WHERE user_id = :user_id";

        $statement = $this->conn->prepare($parentQuery);
        $this->bindValues($statement, $fields);
        $statement->execute();

        return true;
    }

    public function delete($user_id)
    {
        $deleteUser = "DELETE FROM users WHERE user_id = :user_id";
        $statement = $this->conn->prepare($deleteUser);
        $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        return $statement->execute();
    }
}
