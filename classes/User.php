<?php
require_once 'Model.php';

class User extends Model {
    
    public function login($email, $password) {
        $stmt = $this->executeQuery("SELECT * FROM user WHERE email = ?", [$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
            $_SESSION['user_type'] = $user['user_type'];
            return true;
        }
        return false;
    }

    public function register($name, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        try {
            $this->executeQuery(
                "INSERT INTO user (name, email, password, user_type) VALUES (?, ?, ?, 'USER')",
                [$name, $email, $hashedPassword]
            );
            return true;
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                throw new Exception("Email already exists");
            }
            throw new Exception("Registration failed");
        }
    }

    public function getUserById($id) {
        $stmt = $this->executeQuery("SELECT * FROM user WHERE id = ?", [$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers() {
        $stmt = $this->executeQuery(
            "SELECT id, first_name, last_name, email, phone_number, user_type 
             FROM user"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public function isAdmin() {
        return isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'ADMIN';
    }

    public function getUserData($email) {
        $stmt = $this->executeQuery("SELECT id, name FROM user WHERE email = ?", [$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteUser($userId) {
        try {
            $stmt = $this->executeQuery("DELETE FROM user WHERE id = ?", [$userId]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateUser($userId, $firstName, $lastName, $phone, $userType) {
        try {
            $stmt = $this->executeQuery(
                "UPDATE user 
                SET first_name = ?, last_name = ?, phone_number = ?, user_type = ? 
                WHERE id = ?",
                [$firstName, $lastName, $phone, $userType, $userId]
            );
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }
}
?> 