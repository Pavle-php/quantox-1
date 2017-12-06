<?php

class User
{
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Get user data with data provided
     * @param string $email Email
     * @return Object User or FALSE
     */
    public function getUser($email){
        $query = "SELECT id, name, password, email FROM users WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    /**
     * Get user data with data provided
     * @param string $keyword keyword
     * @return Array of User objects
     */
    public function filterUsers($keyword){
        $query = "SELECT * FROM users WHERE name LIKE :keyword OR email LIKE :keyword";
        $stmt = $this->db->prepare($query);
        $stmt->execute(array(':keyword' => '%'.$keyword.'%'));
        $result = $stmt->fetchAll();
        return $result;
    }

    /**
     * Get all users
     * @return Array of User objects
     */
    public function getAllUsers(){
        $query = "SELECT * FROM users";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    /**
     * Check if email exist
     * @param string $email Email
     * @return TRUE or FALSE
     */
    public function emailExists($email){
        $query = "SELECT Count(id) as count FROM users WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $count = $stmt->fetch();
        return ($count->count === "1");
    }

    /**
     * Insert User
     * @param string $username Username
     * @param string $password Password
     * @return TRUE or FALSE
     */
    public function registerUser($name, $password, $email){
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (name, password, email) VALUES (:name, :password, :email)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":password", $pass_hash);
        $stmt->bindParam(":email", $email);
        return $stmt->execute();
    }

    
    
}