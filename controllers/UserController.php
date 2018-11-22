<?php

/**
* UserController 
*/

class UserController {
   /**
     * @var string $id
     */
    protected $id;
    /**	
   /**
     * @var string $username
     */
    protected $username;
    /**
     * @var string $email
     */
    protected $email;
    /**
     * @var string $firstName
     */
    protected $firstName;
    /**
     * @var string $lastName
     */
    protected $lastName;
    /**
     * @var string $gender
     */
    protected $gender;
    /**
     * @var string $dateOfBirth
     */
    protected $dateOfBirth;
    /**
     * @var string $dateOfEntry
     */
    protected $dateOfEntry;
   /**
     * @var string $addressLine1
     */
    protected $addressLine1;
    /** 
   /**
     * @var string $addressLine2
     */
    protected $addressLine2;
    /**
     * @var string $city
     */
    protected $city;
    /**
     * @var string $phoneNumber
     */
    protected $phoneNumber;
    /**
     * @var string $familyType
     */
    protected $familyType;
    /**
     * @var string $categoryId
     */
    protected $categoryId;
    /**
     * @var string $password
     */
    protected $password;
    /**
     * @var string $confirmPassword
     */
    protected $confirmPassword;
     /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
     /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = trim($username);
    }
    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }
    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }
    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }
    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }
    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }
    /**
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }
    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }
    /**
     * @param string $dateOfBirth
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }
    /**
     * @return string
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }
    /**
     * @param string $dateOfEntry
     */
    public function setDateOfEntry($dateOfEntry)
    {
        $this->dateOfEntry = $dateOfEntry;
    }
    /**
     * @return string
     */
    public function getDateOfEntry()
    {
        return $this->dateOfEntry;
    }
    /**
     * @param string $addressLine1
     */
    public function setAddressLine1($addressLine1)
    {
        $this->addressLine1 = $addressLine1;
    }
    /**
     * @return string
     */
    public function getAddressLine1()
    {
        return $this->addressLine1;
    }
    /**
     * @param string $addressLine2
     */
    public function setAddressLine2($addressLine2)
    {
        $this->addressLine2 = $addressLine2;
    }
    /**
     * @return string
     */
    public function getAddressLine2()
    {
        return $this->addressLine2;
    }
    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }
    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }
    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }
    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }
    /**
     * @param string $familyType
     */
    public function setFamilyType($familyType)
    {
        $this->familyType = $familyType;
    }
    /**
     * @return string
     */
    public function getFamilyType()
    {
        return $this->familyType;
    }
    /**
     * @param string $categoryId
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }
    /**
     * @return string
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }
    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = password_hash(trim($password), PASSWORD_DEFAULT);
    }
    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * @param string $confirmPassword
     */
    public function setConfirmPassword($confirmPassword)
    {
        $this->confirmPassword = trim($confirmPassword);
    }
    /**
     * @return string
     */
    public function getConfirmPassword()
    {
        return $this->confirmPassword;
    }

    public function checkForExistenceByUsername(){
        $db = new DatabaseController();
        $exist = $db->single("SELECT id FROM users WHERE username = :username", array('username' => $this->username));
        $db->closeConnection();
        return $exist;
    }

    public function checkForExistenceByEmail(){
        $db = new DatabaseController();
        $exist = $db->single("SELECT id FROM users WHERE email = :email", array('email' => $this->email));
        $db->closeConnection();
        return $exist;
    }

    public function matchPasswords($password, $hashedPassword){
        return password_verify($password, $hashedPassword);
    }

    public function matchConfirmPassword(){
        return $this->matchPasswords($this->confirmPassword, $this->password);
    }

    public function create(){
        $db = new DatabaseController();

        $insertUserQuery = "INSERT INTO users SET ";
        $insertUserParams = array();

        if($this->firstName){
           $insertUserQuery.="firstName=:firstName, ";
           $insertUserParams['firstName'] = $this->firstName;
        } 
        if($this->lastName){
           $insertUserQuery.="lastName=:lastName, ";
           $insertUserParams['lastName'] = $this->lastName;
        }
        if($this->gender){
           $insertUserQuery.="gender=:gender, ";
           $insertUserParams['gender'] = $this->gender;
        }  
        if($this->dateOfBirth){
           $insertUserQuery.="dateOfBirth=:dateOfBirth, ";
           $insertUserParams['dateOfBirth'] = $this->dateOfBirth;
        } 
        if($this->dateOfEntry){
           $insertUserQuery.="dateOfEntry=:dateOfEntry, ";
           $insertUserParams['dateOfEntry'] = $this->dateOfEntry;
        }
        if($this->addressLine1){
           $insertUserQuery.="addressLine1=:addressLine1, ";
           $insertUserParams['addressLine1'] = $this->addressLine1;
        } 
        if($this->addressLine2){
           $insertUserQuery.="addressLine2=:addressLine2, ";
           $insertUserParams['addressLine2'] = $this->addressLine2;
        } 
        if($this->city){
           $insertUserQuery.="city=:city, ";
           $insertUserParams['city'] = $this->city;
        } 
        if($this->phoneNumber){
           $insertUserQuery.="phoneNumber=:phoneNumber, ";
           $insertUserParams['phoneNumber'] = $this->phoneNumber;
        } 
        if($this->familyType){
           $insertUserQuery.="familyType=:familyType, ";
           $insertUserParams['familyType'] = $this->familyType;
        } 

        $insertUserQuery.="username=:username, ";
        $insertUserParams['username'] = $this->username;

        $insertUserQuery.="password=:password,";
        $insertUserParams['password'] = $this->password;  

        $insertUserQuery.="email=:email ";
        $insertUserParams['email'] = $this->email;

        $id = $db->query($insertUserQuery, $insertUserParams);

        $id = $db->lastInsertId();

        if($id && $this->categoryId){
            $db->query("INSERT INTO permissions (userId, categoryId) VALUES(:id,:categoryId) ON DUPLICATE KEY UPDATE categoryId=:categoryId", array('id' => $id, 'categoryId' => $this->categoryId));
        }


        $db->closeConnection();
        return $id;
    }

    public function update(){
        $db = new DatabaseController();

        $updateUserQuery = "UPDATE users SET ";
        $updateUserParams = array();

        if($this->password){
           $updateUserQuery.="password=:password, ";
           $updateUserParams['password'] = $this->password;
        }  
        if($this->firstName){
           $updateUserQuery.="firstName=:firstName, ";
           $updateUserParams['firstName'] = $this->firstName;
        } 
        if($this->lastName){
           $updateUserQuery.="lastName=:lastName, ";
           $updateUserParams['lastName'] = $this->lastName;
        }
        if($this->gender){
           $updateUserQuery.="gender=:gender, ";
           $updateUserParams['gender'] = $this->gender;
        }  
        if($this->dateOfBirth){
           $updateUserQuery.="dateOfBirth=:dateOfBirth, ";
           $updateUserParams['dateOfBirth'] = $this->dateOfBirth;
        } 
        if($this->dateOfEntry){
           $updateUserQuery.="dateOfEntry=:dateOfEntry, ";
           $updateUserParams['dateOfEntry'] = $this->dateOfEntry;
        }
        if($this->email){
           $updateUserQuery.="email=:email, ";
           $updateUserParams['email'] = $this->email;
        } 
        if($this->addressLine1){
           $updateUserQuery.="addressLine1=:addressLine1, ";
           $updateUserParams['addressLine1'] = $this->addressLine1;
        } 
        if($this->addressLine2){
           $updateUserQuery.="addressLine2=:addressLine2, ";
           $updateUserParams['addressLine2'] = $this->addressLine2;
        } 
        if($this->city){
           $updateUserQuery.="city=:city, ";
           $updateUserParams['city'] = $this->city;
        } 
        if($this->phoneNumber){
           $updateUserQuery.="phoneNumber=:phoneNumber, ";
           $updateUserParams['phoneNumber'] = $this->phoneNumber;
        } 
        if($this->familyType){
           $updateUserQuery.="familyType=:familyType, ";
           $updateUserParams['familyType'] = $this->familyType;
        } 

        $updateUserQuery.="username=:username ";
        $updateUserParams['username'] = $this->username;
        
        $updateUserQuery.="WHERE id=:id";
        $updateUserParams['id'] = $this->id;

        $db->query($updateUserQuery, $updateUserParams);

        if($this->categoryId){
            $db->query("INSERT INTO permissions (userId, categoryId) VALUES(:id,:categoryId) ON DUPLICATE KEY UPDATE categoryId=:categoryId", array('id' => $this->id, 'categoryId' => $this->categoryId));
        }
        $db->closeConnection();
        return true;
        
    }

    public function delete(){
        $db = new DatabaseController();
        $removed = $db->query("DELETE FROM users WHERE id=:id", array('id' => $this->id));
        $db->closeConnection();
        return $removed;
    }

    public function get(){
        if($this->id){
          $db = new DatabaseController();
          $user = $db->query("SELECT u.id, u.username, u.password, u.email, u.firstName, u.lastName, u.gender, u.dateOfBirth, u.dateOfEntry, u.addressLine1, u.addressLine2, u.city, u.phoneNumber, u.familyType, uc.name permission, p.categoryId FROM users u LEFT JOIN permissions p ON u.id = p.userId LEFT JOIN userCategories uc ON p.categoryId=uc.id WHERE u.id=:id;", array('id' => $this->id));
          $db->closeConnection();
          return $user[0];
        } elseif($this->username){
          $db = new DatabaseController();
          $user = $db->query("SELECT u.id, u.username, u.password, u.email, u.firstName, u.lastName, u.gender, u.dateOfBirth, u.dateOfEntry, u.addressLine1, u.addressLine2, u.city, u.phoneNumber, u.familyType, uc.name permission, p.categoryId FROM users u LEFT JOIN permissions p ON u.id = p.userId LEFT JOIN userCategories uc ON p.categoryId=uc.id WHERE u.username=:username;", array('username' => $this->username));
          $db->closeConnection();
          return $user[0];
        } else{
          $db = new DatabaseController();
          $users = $db->query("SELECT u.id, u.username, u.password, u.email, u.firstName, u.lastName, u.gender, u.dateOfBirth, u.dateOfEntry, u.addressLine1, u.addressLine2, u.city, u.phoneNumber, u.familyType, uc.name permission, p.categoryId FROM users u LEFT JOIN permissions p ON u.id = p.userId LEFT JOIN userCategories uc ON p.categoryId=uc.id;");
          $db->closeConnection();
          return $users;
        }
    }
}