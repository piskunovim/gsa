<?php

/**
* ChildSheetController 
*/

class ChildSheetController {
   /**
     * @var string $id
     */
    protected $id;
    /**
     * @var string $date
     */
    protected $date;
    /**
     * @var string $period
     */
    protected $period;
    /**
     * @var string $presence
     */
    protected $presence;
     /**
     * @var string $userId
     */
    protected $userId;
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
     * @param string $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }
    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }
    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }
    /**
     * @param string $period
     */
    public function setPeriod($period)
    {
        $this->period = $period;
    }
    /**
     * @return string
     */
    public function getPeriod()
    {
        return $this->period;
    }
    /**
     * @param string $presence
     */
    public function setPresence($presence)
    {
        $this->presence = $presence;
    }
    /**
     * @return string
     */
    public function getPresence()
    {
        return $this->presence;
    }
  

    public function create(){
        $db = new DatabaseController();

        $insertChildSheetQuery = "INSERT INTO childSheet SET ";
        $insertChildSheetQueryMiddle = array();

        $insertChildSheetParams = array();

        if($this->date){
           $insertChildSheetQueryMiddle[] = "date=:date";
           $insertChildSheetParams['date'] = $this->date;
        }  
        if($this->period){
           $insertChildSheetQueryMiddle[] = "period=:period";
           $insertChildSheetParams['period'] = $this->period;
        } 
        if($this->presence){
           $insertChildSheetQueryMiddle[] = "presence=:presence";
           $insertChildSheetParams['presence'] = $this->presence;
        }
        if($this->userId){
           $insertChildSheetQueryMiddle[] = "userId=:userId";
           $insertChildSheetParams['userId'] = $this->userId;
        }

        $insertChildSheetQuery .= implode(', ', $insertChildSheetQueryMiddle);

        $db->query($insertChildSheetQuery, $insertChildSheetParams);

        $id = $db->lastInsertId();
        $db->closeConnection();
        return $id;
    }

    public function update(){
        $db = new DatabaseController();

        $updateChildQuery = "UPDATE childSheet SET ";
        $updateChildSheetQueryMiddle = array();

        $updateChildSheetParams = array();

        if($this->date){
           $updateChildSheetQueryMiddle[] = "date=:date";
           $updateChildSheetParams['date'] = $this->date;
        }  
        if($this->period){
           $updateChildSheetQueryMiddle[] = "period=:period";
           $updateChildSheetParams['period'] = $this->period;
        } 
        if($this->presence){
           $updateChildSheetQueryMiddle[] = "presence=:presence";
           $updateChildSheetParams['presence'] = $this->presence;
        }

        $updateChildQuery .= implode(', ', $insertChildSheetQueryMiddle)." WHERE id=:id";
        $updateChildSheetParams['id'] = $this->id;  

        $db->query($updateChildQuery, $updateChildSheetParams);

        $db->closeConnection();
        return true;
    }

    public function delete(){
        $db = new DatabaseController();
        $removed = $db->query("DELETE FROM childSheet WHERE id=:id", array('id' => $this->id));
        $db->closeConnection();
        return $removed;
    }

    public function get(){
        if($this->userId){
          $db = new DatabaseController();
          $childSheet = $db->query("SELECT * FROM childSheet WHERE userId=:userId", array('userId' => $this->userId));
          $db->closeConnection();
          $childSheetResponse = (count($childSheet)) ? $childSheet : null;
          return $childSheetResponse;
        } else{
          $db = new DatabaseController();
          $childSheet = $db->query("SELECT * FROM childSheet");
          $db->closeConnection();
          return $childSheet;
        }
    }
}