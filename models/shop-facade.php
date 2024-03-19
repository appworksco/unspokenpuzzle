<?php

  class ShopFacade extends DBConnection {

    public function fetchProducts() {
      $sql = $this->connect()->prepare("SELECT * FROM shop");
      $sql->execute();
      return $sql;
    }

    public function fetchProductById($productId) {
      $sql = $this->connect()->prepare("SELECT * FROM shop WHERE id = ?");
      $sql->execute([$productId]);
      return $sql;
    }

    public function verifyProduct($name) {
      $sql = $this->connect()->prepare("SELECT name FROM shop WHERE name = ?");
      $sql->execute([$name]);
      $count = $sql->rowCount();
      return $count;
    }

    public function fetchNumberOfProducts() {
      $sql = $this->connect()->prepare("SELECT * FROM shop");
      $sql->execute();
      $count = $sql->rowCount();
      return $count;
    } 

    public function addProduct($image, $name, $price, $link) {
      $sql = $this->connect()->prepare("INSERT INTO shop(image, name, price, link) VALUES (?, ?, ?, ?)");
      $sql->execute([$image, $name, $price, $link]);
      return $sql;
    }

    public function updateProduct($productId, $productName, $productPrice, $productLink) {
      try {
          $sql = $this->connect()->prepare("UPDATE products SET name = ?, price = ?, link = ? WHERE id = ?");
          $sql->execute([$productName, $productPrice, $productLink, $productId]);
          return true;
      } catch (PDOException $e) {
          return false;
      }
    }

    public function deleteProduct($productId) {
      $sql = $this->connect()->prepare("DELETE FROM shop WHERE id = $productId");
      $sql->execute();
      return $sql;
    }

    public function login($username, $password) {
      $sql = $this->connect()->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
      $sql->execute([$username, $password]);
      return $sql;
    }

    public function getProductDetails($productId) {
      $sql = $this->connect()->prepare("SELECT * FROM shop WHERE id = ?");
      $sql->execute([$productId]);
      return $sql->fetch(PDO::FETCH_ASSOC);
    }

  }

?>