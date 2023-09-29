<?php

  class UserFacade extends DBConnection {

    public function fetchUsers() {
      $sql = $this->connect()->prepare("SELECT * FROM users");
      $sql->execute();
      return $sql;
    }

    public function fetchUsersById($userId) {
      $sql = $this->connect()->prepare("SELECT * FROM users WHERE id = ?");
      $sql->execute([$userId]);
      return $sql;
    }

    public function verifyUsernameAndPassword($username, $password) {
      $sql = $this->connect()->prepare("SELECT username, password FROM users WHERE username = ? AND password = ?");
      $sql->execute([$username, $password]);
      $count = $sql->rowCount();
      return $count;
    }

    public function register($userType, $email, $fullName, $username, $password) {
      $sql = $this->connect()->prepare("INSERT INTO users(user_type, email, full_name, username, password) VALUES (?, ?, ?, ?, ?)");
      $sql->execute([$userType, $email, $fullName, $username, $password]);
      return $sql;
    }

    public function updateUser($updateUserId, $firstName, $lastName, $username, $password) {
      $sql = $this->connect()->prepare("UPDATE users SET first_name = '$firstName', last_name = '$lastName', username = '$username', password = '$password' WHERE id = $updateUserId");
      $sql->execute();
      return $sql;
    }

    public function deleteUser($userId) {
      $sql = $this->connect()->prepare("DELETE FROM users WHERE id = $userId");
      $sql->execute();
      return $sql;
    }

    public function login($username, $password) {
      $sql = $this->connect()->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
      $sql->execute([$username, $password]);
      return $sql;
    }

    public function updateWallet($userId, $amount) {
      $sql = $this->connect()->prepare("UPDATE users SET wallet = $amount WHERE id = $userId");
      $sql->execute();
      return $sql;
    }

  }

?>