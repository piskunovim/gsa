<?php

/**
* UserController 
*/

class UserController {
	
   /**
     * @var string $username
     */
    protected $username;
    /**
     * @var string $email
     */
    protected $email;
    /**
     * @var string $password
     */
    protected $password;
    /**
     * @var string $confirmPassword
     */
    protected $confirmPassword;
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
    
    public function authenticate(){
    	$db = new DatabaseController();
        $user = $db->query("SELECT id, username, password FROM users WHERE username = :username", array('username' => $this->username));
        $db->closeConnection();
        return $user[0];
    }

    public function checkForExistence(){
        $db = new DatabaseController();
        $exist = $db->single("SELECT id FROM users WHERE username = :username", array('username' => $this->username));
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
        $id = $db->query("INSERT INTO users (username, password) VALUES (:username, :password)", array('username' => $this->username, 'password' => $this->password));
        $db->closeConnection();
        return $id;
    }

    public function update(){
    }

    public function delete(){
    }
}