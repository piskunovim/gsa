<?php

/**
* InvoiceController 
*/

class InvoiceController {
   /**
     * @var string $id
     */
    protected $id;
    /**
     * @var string $years
     */
    protected $years;
    /**
     * @var string $paymentTerm1
     */
    protected $paymentTerm1;
    /**
     * @var string $paymentTerm2
     */
    protected $paymentTerm2;
     /**
     * @var string $paymentTerm3
     */
    protected $paymentTerm3;
    /**
     * @var string $statusTerm1
     */
    protected $statusTerm1;
    /**
     * @var string $statusTerm2
     */
    protected $statusTerm2;
     /**
     * @var string $statusTerm3
     */
    protected $statusTerm3;
    /**
     * @var string $statusTextTerm1
     */
    protected $statusTextTerm1;
    /**
     * @var string $statusTextTerm2
     */
    protected $statusTextTerm2;
     /**
     * @var string $statusTextTerm3
     */
    protected $statusTextTerm3;
    /**
     * @var string $invoiceLinkTerm1
     */
    protected $invoiceLinkTerm1;
    /**
     * @var string $invoiceLinkTerm2
     */
    protected $invoiceLinkTerm2;
     /**
     * @var string $invoiceLinkTerm3
     */
    protected $invoiceLinkTerm3;
     /**
     * @var string $childId
     */
    protected $childId;
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
     * @param string $childId
     */
    public function setChildId($childId)
    {
        $this->childId = $childId;
    }
    /**
     * @return string
     */
    public function getChildId()
    {
        return $this->childId;
    }
    /**
     * @param string $paymentTerm1
     */
    public function setPaymentTerm1($paymentTerm1)
    {
        $this->paymentTerm1 = $paymentTerm1;
    }
    /**
     * @return string
     */
    public function getPaymentTerm1()
    {
        return $this->paymentTerm1;
    }
    /**
     * @param string $paymentTerm2
     */
    public function setPaymentTerm2($paymentTerm2)
    {
        $this->paymentTerm2 = $paymentTerm2;
    }
    /**
     * @return string
     */
    public function getPaymentTerm2()
    {
        return $this->paymentTerm2;
    }
    /**
     * @param string $paymentTerm3
     */
    public function setPaymentTerm3($paymentTerm3)
    {
        $this->paymentTerm3 = $paymentTerm3;
    }
    /**
     * @return string
     */
    public function getPaymentTerm3()
    {
        return $this->paymentTerm3;
    }
    /**
     * @param string $statusTerm1
     */
    public function setStatusTerm1($statusTerm1)
    {
        $this->statusTerm1 = $statusTerm1;
    }
    /**
     * @return string
     */
    public function getStatusTerm1()
    {
        return $this->statusTerm1;
    }
    /**
     * @param string $statusTerm2
     */
    public function setStatusTerm2($statusTerm2)
    {
        $this->statusTerm2 = $statusTerm2;
    }
    /**
     * @return string
     */
    public function getStatusTerm2()
    {
        return $this->statusTerm2;
    }
    /**
     * @param string $statusTerm3
     */
    public function setStatusTerm3($statusTerm3)
    {
        $this->statusTerm3 = $statusTerm3;
    }
    /**
     * @return string
     */
    public function getStatusTerm3()
    {
        return $this->statusTerm3;
    }
    /**
     * @param string $statusTextTerm1
     */
    public function setStatusTextTerm1($statusTextTerm1)
    {
        $this->statusTextTerm1 = $statusTextTerm1;
    }
    /**
     * @return string
     */
    public function getStatusTextTerm1()
    {
        return $this->statusTextTerm1;
    }
    /**
     * @param string $statusTextTerm2
     */
    public function setStatusTextTerm2($statusTextTerm2)
    {
        $this->statusTextTerm2 = $statusTextTerm2;
    }
    /**
     * @return string
     */
    public function getStatusTextTerm2()
    {
        return $this->statusTextTerm2;
    }
    /**
     * @param string $statusTextTerm3
     */
    public function setStatusTextTerm3($statusTextTerm3)
    {
        $this->statusTextTerm3 = $statusTextTerm3;
    }
    /**
     * @return string
     */
    public function getStatusTextTerm3()
    {
        return $this->statusTextTerm3;
    }
    /**
     * @param string $invoiceLinkTerm1
     */
    public function setInvoiceLinkTerm1($invoiceLinkTerm1)
    {
        $this->invoiceLinkTerm1 = $invoiceLinkTerm1;
    }
    /**
     * @return string
     */
    public function getInvoiceLinkTerm1()
    {
        return $this->invoiceLinkTerm1;
    }
    /**
     * @param string $invoiceLinkTerm2
     */
    public function setInvoiceLinkTerm2($invoiceLinkTerm2)
    {
        $this->invoiceLinkTerm2 = $invoiceLinkTerm2;
    }
    /**
     * @return string
     */
    public function getInvoiceLinkTerm2()
    {
        return $this->invoiceLinkTerm2;
    }
    /**
     * @param string $invoiceLinkTerm3
     */
    public function setInvoiceLinkTerm3($invoiceLinkTerm3)
    {
        $this->invoiceLinkTerm3 = $invoiceLinkTerm3;
    }
    /**
     * @return string
     */
    public function getInvoiceLinkTerm3()
    {
        return $this->invoiceLinkTerm3;
    }
    /**
     * @param string $years
     */
    public function setYears($years)
    {
        $this->years = $years;
    }
    /**
     * @return string
     */
    public function getYears()
    {
        return $this->years;
    }
    
  

    public function create(){
        $db = new DatabaseController();

        $insertInvoiceQuery = "INSERT INTO invoice SET ";
        $insertInvoiceQueryMiddle = array();

        $insertInvoiceParams = array();
        
        if($this->years){
           $insertInvoiceQueryMiddle[] = "years=:years";
           $insertInvoiceParams['years'] = $this->years;
        }  
        if($this->paymentTerm1){
           $insertInvoiceQueryMiddle[] = "paymentTerm1=:paymentTerm1";
           $insertInvoiceParams['paymentTerm1'] = $this->paymentTerm1;
        }  
        if($this->paymentTerm2){
           $insertInvoiceQueryMiddle[] = "paymentTerm2=:paymentTerm2";
           $insertInvoiceParams['paymentTerm2'] = $this->paymentTerm2;
        }  
        if($this->paymentTerm3){
           $insertInvoiceQueryMiddle[] = "paymentTerm3=:paymentTerm3";
           $insertInvoiceParams['paymentTerm3'] = $this->paymentTerm3;
        }  
        if($this->statusTerm1){
           $insertInvoiceQueryMiddle[] = "statusTerm1=:statusTerm1";
           $insertInvoiceParams['statusTerm1'] = $this->statusTerm1;
        }   
        if($this->statusTerm2){
           $insertInvoiceQueryMiddle[] = "statusTerm2=:statusTerm2";
           $insertInvoiceParams['statusTerm2'] = $this->statusTerm2;
        }   
        if($this->statusTerm3){
           $insertInvoiceQueryMiddle[] = "statusTerm3=:statusTerm3";
           $insertInvoiceParams['statusTerm3'] = $this->statusTerm3;
        } 
        if($this->statusTextTerm1){
           $insertInvoiceQueryMiddle[] = "statusTextTerm1=:statusTextTerm1";
           $insertInvoiceParams['statusTextTerm1'] = $this->statusTextTerm1;
        } 
        if($this->statusTextTerm2){
           $insertInvoiceQueryMiddle[] = "statusTextTerm2=:statusTextTerm2";
           $insertInvoiceParams['statusTextTerm2'] = $this->statusTextTerm2;
        } 
        if($this->statusTextTerm3){
           $insertInvoiceQueryMiddle[] = "statusTextTerm3=:statusTextTerm3";
           $insertInvoiceParams['statusTextTerm3'] = $this->statusTextTerm3;
        } 
        if($this->invoiceLinkTerm1){
           $insertInvoiceQueryMiddle[] = "invoiceLinkTerm1=:invoiceLinkTerm1";
           $insertInvoiceParams['invoiceLinkTerm1'] = $this->invoiceLinkTerm1;
        } 
        if($this->invoiceLinkTerm2){
           $insertInvoiceQueryMiddle[] = "invoiceLinkTerm2=:invoiceLinkTerm2";
           $insertInvoiceParams['invoiceLinkTerm2'] = $this->invoiceLinkTerm2;
        } 
        if($this->invoiceLinkTerm3){
           $insertInvoiceQueryMiddle[] = "invoiceLinkTerm3=:invoiceLinkTerm3";
           $insertInvoiceParams['invoiceLinkTerm3'] = $this->invoiceLinkTerm3;
        }
        if($this->childId){
           $insertInvoiceQueryMiddle[] = "childId=:childId";
           $insertInvoiceParams['childId'] = $this->childId;
        }

        $insertInvoiceQuery .= implode(', ', $insertInvoiceQueryMiddle);

        $db->query($insertInvoiceQuery, $insertInvoiceParams);

        $id = $db->lastInsertId();
        $db->closeConnection();
        return $id;
    }

    public function update(){
        $db = new DatabaseController();

        $updateInvoiceQuery = "UPDATE invoice SET ";
        $updateInvoiceQueryMiddle = array();

        $updateInvoiceParams = array();

        if($this->years){
           $updateInvoiceQueryMiddle[] = "years=:years";
           $updateInvoiceParams['years'] = $this->years;
        }  
        if($this->paymentTerm1){
           $updateInvoiceQueryMiddle[] = "paymentTerm1=:paymentTerm1";
           $updateInvoiceParams['paymentTerm1'] = $this->paymentTerm1;
        }  
        if($this->paymentTerm2){
           $updateInvoiceQueryMiddle[] = "paymentTerm2=:paymentTerm2";
           $updateInvoiceParams['paymentTerm2'] = $this->paymentTerm2;
        }  
        if($this->paymentTerm3){
           $updateInvoiceQueryMiddle[] = "paymentTerm3=:paymentTerm3";
           $updateInvoiceParams['paymentTerm3'] = $this->paymentTerm3;
        }  
        if($this->statusTerm1){
           $updateInvoiceQueryMiddle[] = "statusTerm1=:statusTerm1";
           $updateInvoiceParams['statusTerm1'] = $this->statusTerm1;
        }   
        if($this->statusTerm2){
           $updateInvoiceQueryMiddle[] = "statusTerm2=:statusTerm2";
           $updateInvoiceParams['statusTerm2'] = $this->statusTerm2;
        }   
        if($this->statusTerm3){
           $updateInvoiceQueryMiddle[] = "statusTerm3=:statusTerm3";
           $updateInvoiceParams['statusTerm3'] = $this->statusTerm3;
        } 
        if($this->statusTextTerm1){
           $updateInvoiceQueryMiddle[] = "statusTextTerm1=:statusTextTerm1";
           $updateInvoiceParams['statusTextTerm1'] = $this->statusTextTerm1;
        } 
        if($this->statusTextTerm2){
           $updateInvoiceQueryMiddle[] = "statusTextTerm2=:statusTextTerm2";
           $updateInvoiceParams['statusTextTerm2'] = $this->statusTextTerm2;
        } 
        if($this->statusTextTerm3){
           $updateInvoiceQueryMiddle[] = "statusTextTerm3=:statusTextTerm3";
           $updateInvoiceParams['statusTextTerm3'] = $this->statusTextTerm3;
        } 
        if($this->invoiceLinkTerm1){
           $updateInvoiceQueryMiddle[] = "invoiceLinkTerm1=:invoiceLinkTerm1";
           $updateInvoiceParams['invoiceLinkTerm1'] = $this->invoiceLinkTerm1;
        } 
        if($this->invoiceLinkTerm2){
           $updateInvoiceQueryMiddle[] = "invoiceLinkTerm2=:invoiceLinkTerm2";
           $updateInvoiceParams['invoiceLinkTerm2'] = $this->invoiceLinkTerm2;
        } 
        if($this->invoiceLinkTerm3){
           $updateInvoiceQueryMiddle[] = "invoiceLinkTerm3=:invoiceLinkTerm3";
           $updateInvoiceParams['invoiceLinkTerm3'] = $this->invoiceLinkTerm3;
        }
        if($this->childId){
           $updateInvoiceQueryMiddle[] = "childId=:childId";
           $updateInvoiceParams['childId'] = $this->childId;
        }

        $updateInvoiceQuery .= implode(', ', $updateInvoiceQueryMiddle)." WHERE id=:id";
        $updateInvoiceParams['id'] = $this->id;  

        $db->query($updateInvoiceQuery, $updateInvoiceParams);

        $db->closeConnection();
        return true;
    }

    public function delete(){
        $db = new DatabaseController();
        $removed = $db->query("DELETE FROM invoice WHERE id=:id", array('id' => $this->id));
        $db->closeConnection();
        return $removed;
    }

    public function get(){
        if($this->childId){
          $db = new DatabaseController();
          $invoice = $db->query("SELECT * FROM invoice WHERE childId=:childId ORDER BY years DESC", array('childId' => $this->childId));
          $db->closeConnection();
          $invoiceResponse = (count($invoice)) ? $invoice : null;
          return $invoiceResponse;
        } else{
          $db = new DatabaseController();
          $invoice = $db->query("SELECT * FROM invoice");
          $db->closeConnection();
          return $invoice;
        }
    }
}