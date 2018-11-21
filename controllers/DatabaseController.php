<?php

/**
* DatabaseController 
*/

class DatabaseController {
    // @object PDO connection object 
    private $dbc;
    // @object, PDO statement object
    private $sQuery;
    // @bool,  Connection status
	private $statusConnected = false;
	// @array, The parameters of the SQL query
	private $parameters;


    /* function __construct
     * Opens the database connection
     */
    public function __construct() {
        $this->getConnection();
        $this->parameters = array();
    }
    /* Function getConnection
     * Get a connection to the database using PDO.
     */
    private function getConnection() {
        // Check if the connection is already established
        if ($this->dbc == NULL) {
            // Create the connection
            try {
                $this->dbc=new PDO("mysql:host=" . DB_HOST . ";port=".DB_PORT.";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
                // Set the PDO error mode to exception
			    $this->dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			    // If connected set status connection to true
			    $this->statusConnected = true;
			} catch(PDOException $e){
                echo __FILE__." ".__LINE__.$e->getMessage();
            }
        }
    }
    /* Function closeConnection
     * Closes the database connection
     */
    public function closeConnection() {
		$this->dbc = NULL;
	}

    /**
	*	Every method which needs to execute a SQL query uses this method.
	*	
	*	1. If not connected, connect to the database.
	*	2. Prepare Query.
	*	3. Parameterize Query.
	*	4. Execute Query.	
	*	5. On exception : Write Exception into the log + SQL query.
	*	6. Reset the Parameters.
	*/	
		private function initialize($query,$parameters = "")
		{
		# Connect to database
		if(!$this->statusConnected) { $this->getConnection(); }
		try {
				# Prepare query
				$this->sQuery = $this->dbc->prepare($query);
				
				# Add parameters to the parameter array	
				$this->bindMultiple($parameters);
				# Bind parameters
				if(!empty($this->parameters)) {
					foreach($this->parameters as $param)
					{
						$parameters = explode("\x7F",$param);
						$this->sQuery->bindParam($parameters[0],$parameters[1]);
					}		
				}
				# Execute SQL 
				$this->success = $this->sQuery->execute();		
			}
			catch(PDOException $e)
			{
					echo __FILE__." ".__LINE__.$e->getMessage();
			}
			# Reset the parameters
			$this->parameters = array();
		}

    /**
	*   If the SQL query  contains a SELECT or SHOW statement it returns an array containing all of the result set row
	*	If the SQL statement is a DELETE, INSERT, or UPDATE statement it returns the number of affected rows
	*
	*   @param  string $query
	*	@param  array  $params
	*	@param  int    $fetchmode
	*	@return mixed
	*/			
	public function query($query,$params = null, $fetchmode = PDO::FETCH_ASSOC) {
		$query = trim($query);
		$this->initialize($query,$params);
		$rawStatement = explode(" ", $query);
		
		# Which SQL statement is used 
		$statement = strtolower($rawStatement[0]);
		
		if ($statement === 'select' || $statement === 'show') {
			return $this->sQuery->fetchAll($fetchmode);
		}
		elseif ( $statement === 'insert' ||  $statement === 'update' || $statement === 'delete' ) {
			return $this->sQuery->rowCount();	
		}	
		else {
			return NULL;
		}
	}

	/**
	*	@void 
	*
	*	Add the parameter to the parameter array
	*	@param string $param  
	*	@param string $value 
	*/	
		public function bind($param, $value)
		{	
			$this->parameters[sizeof($this->parameters)] = ":" . $param . "\x7F" . utf8_encode($value);
		}
       /**
	*	@void
	*	
	*	Add more parameters to the parameter array
	*	@param array $params
	*/	
		public function bindMultiple($params)
		{
			if(empty($this->parameters) && is_array($params)) {
				$columns = array_keys($params);
				foreach($columns as $i => &$column)	{
					$this->bind($column, $params[$column]);
				}
			}
		}

       /**
	*	Returns the value of one single field/column
	*
	*	@param  string $query
	*	@param  array  $params
	*	@return string
	*/	
		public function single($query,$params = null)
		{
			$this->initialize($query,$params);
			return $this->sQuery->fetchColumn();
		}

}

?>