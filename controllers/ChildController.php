<?php

/**
* ChildController 
*/

class ChildController {
   /**
     * @var string $id
     */
    protected $id;
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
     * @var string $phoneNumber
     */
    protected $phoneNumber;
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

    public function create(){
        $db = new DatabaseController();

        $insertChildQuery = "INSERT INTO children SET ";
        $insertChildParams = array();

        if($this->gender){
           $insertChildQuery.="gender=:gender, ";
           $insertChildParams['gender'] = $this->gender;
        }  
        if($this->dateOfBirth){
           $insertChildQuery.="dateOfBirth=:dateOfBirth, ";
           $insertChildParams['dateOfBirth'] = $this->dateOfBirth;
        } 
        if($this->dateOfEntry){
           $insertChildQuery.="dateOfEntry=:dateOfEntry, ";
           $insertChildParams['dateOfEntry'] = $this->dateOfEntry;
        }
        if($this->phoneNumber){
           $insertChildQuery.="phoneNumber=:phoneNumber, ";
           $insertChildParams['phoneNumber'] = $this->phoneNumber;
        } 
        
        $insertChildQuery.="firstName=:firstName, ";
        $insertChildParams['firstName'] = $this->firstName;

        $insertChildQuery.="lastName=:lastName";
        $insertChildParams['lastName'] = $this->lastName;  

        $db->query($insertChildQuery, $insertChildParams);

        $id = $db->lastInsertId();
        $db->closeConnection();
        return $id;
    }

    public function update(){
        $db = new DatabaseController();

        $updateChildQuery = "UPDATE children SET ";
        $updateChildParams = array();

        if($this->gender){
           $updateChildQuery.="gender=:gender, ";
           $updateChildParams['gender'] = $this->gender;
        }  
        if($this->dateOfBirth){
           $updateChildQuery.="dateOfBirth=:dateOfBirth, ";
           $updateChildParams['dateOfBirth'] = $this->dateOfBirth;
        } 
        if($this->dateOfEntry){
           $updateChildQuery.="dateOfEntry=:dateOfEntry, ";
           $updateChildParams['dateOfEntry'] = $this->dateOfEntry;
        }
        
        $updateChildQuery.="phoneNumber=:phoneNumber, ";
        $updateChildParams['phoneNumber'] = $this->phoneNumber;
        
        $updateChildQuery.="firstName=:firstName, ";
        $updateChildParams['firstName'] = $this->firstName;

        $updateChildQuery.="lastName=:lastName ";
        $updateChildParams['lastName'] = $this->lastName;

        $updateChildQuery.="WHERE id=:id";
        $updateChildParams['id'] = $this->id;  

        $db->query($updateChildQuery, $updateChildParams);

        $db->closeConnection();
        return true;
    }

    public function delete(){
        $db = new DatabaseController();
        $removed = $db->query("DELETE FROM children WHERE id=:id", array('id' => $this->id));
        $db->closeConnection();
        return $removed;
    }

    public function get(){
        if($this->id){
          $db = new DatabaseController();
          $child = $db->query("SELECT * FROM children WHERE id=:id", array('id' => $this->id));
          $db->closeConnection();
          return $child[0];
        } else{
          $db = new DatabaseController();
          $users = $db->query("SELECT * FROM children");
          $db->closeConnection();
          return $users;
        }
    }
}