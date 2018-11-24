<?php

/**
* GuardianController 
*/

class GuardianController {
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
     * @var string $familyType
     */
    protected $familyType;

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
     * @return string
     */
    public function create(){
        $db = new DatabaseController();

        $insertGuardianQuery = "INSERT INTO guardians SET ";
        $insertGuardianParams = array();

        if($this->addressLine1){
           $insertGuardianQuery.="addressLine1=:addressLine1, ";
           $insertGuardianParams['addressLine1'] = $this->addressLine1;
        }  
        if($this->addressLine2){
           $insertGuardianQuery.="addressLine2=:addressLine2, ";
           $insertGuardianParams['addressLine2'] = $this->addressLine2;
        } 
        if($this->phoneNumber){
           $insertGuardianQuery.="phoneNumber=:phoneNumber, ";
           $insertGuardianParams['phoneNumber'] = $this->phoneNumber;
        }         
        if($this->familyType){
           $insertGuardianQuery.="familyType=:familyType, ";
           $insertGuardianParams['familyType'] = $this->familyType;
        } 
        
        $insertGuardianQuery.="firstName=:firstName, ";
        $insertGuardianParams['firstName'] = $this->firstName;

        $insertGuardianQuery.="lastName=:lastName";
        $insertGuardianParams['lastName'] = $this->lastName;  

        $db->query($insertGuardianQuery, $insertGuardianParams);

        $id = $db->lastInsertId();
        $db->closeConnection();
        return $id;
    }
	/**
     * @return boolean
     */
    public function update(){
        $db = new DatabaseController();

        $updateGuardianQuery = "UPDATE guardians SET ";
        $updateGuardianParams = array();

        $updateGuardianQuery.="addressLine1=:addressLine1, ";
        $updateGuardianParams['addressLine1'] = $this->addressLine1;
        
        $updateGuardianQuery.="addressLine2=:addressLine2, ";
        $updateGuardianParams['addressLine2'] = $this->addressLine2;
        
        $updateGuardianQuery.="phoneNumber=:phoneNumber, ";
        $updateGuardianParams['phoneNumber'] = $this->phoneNumber;
        
        $updateGuardianQuery.="familyType=:familyType, ";
        $updateGuardianParams['familyType'] = $this->familyType;
        
        $updateGuardianQuery.="firstName=:firstName, ";
        $updateGuardianParams['firstName'] = $this->firstName;

        $updateGuardianQuery.="lastName=:lastName ";
        $updateGuardianParams['lastName'] = $this->lastName; 

        $updateGuardianQuery.="WHERE id=:id";
        $updateGuardianParams['id'] = $this->id;  

        $db->query($updateGuardianQuery, $updateGuardianParams);

        $db->closeConnection();
        return true;
        
    }
	/**
     * @return boolean
     */
    public function delete(){
        $db = new DatabaseController();
        $removed = $db->query("DELETE FROM guardians WHERE id=:id", array('id' => $this->id));
        $db->closeConnection();
        return $removed;
    }

    public function get(){
        if($this->id){
          $db = new DatabaseController();
          $guardian = $db->query("SELECT * FROM guardians WHERE id=:id;", array('id' => $this->id));
          $db->closeConnection();
          return $guardian[0];
        } else{
          $db = new DatabaseController();
          $guardians = $db->query("SELECT * FROM guardians");
          $db->closeConnection();
          return $guardians;
        }
    }
}