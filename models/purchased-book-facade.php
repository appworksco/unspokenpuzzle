<?php

  class PurchasedBookFacade extends DBConnection {

    public function fetchNumberOfPurchasedBooks() {
      $sql = $this->connect()->prepare("SELECT * FROM purchased_books");
      $sql->execute();
      $count = $sql->rowCount();
      return $count;
    } 

    public function fetchBookById($userId) {
      $sql = $this->connect()->prepare("SELECT * FROM purchased_books WHERE user_id = '$userId'");
      $sql->execute();
      return $sql;
    }

    public function addPurchasedBookByUserId($userId, $bookId, $price) {
      $sql = $this->connect()->prepare("INSERT INTO purchased_books(user_id, book_id, price) VALUES (?, ?, ?)");
      $sql->execute([$userId, $bookId, $price]);
      return $sql;
    }

    public function totalSales() {
      $sql = $this->connect()->prepare("SELECT SUM(price) AS sales FROM purchased_books");
      $sql->execute();
      return $sql;
    }

    public function janProductSales($yearlyDate) {
      $sql = $this->connect()->prepare("SELECT SUM(price) as subtotal FROM purchased_books WHERE MONTH(date) = '01' AND YEAR(date) = '$yearlyDate'");
      $sql->execute();

      while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $result = $row["subtotal"];
        return $result;
      }
    }

    public function febProductSales($yearlyDate) {
      $sql = $this->connect()->prepare("SELECT SUM(price) as subtotal FROM purchased_books WHERE MONTH(date) = '02' AND YEAR(date) = '$yearlyDate'");
      $sql->execute();

      while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $result = $row["subtotal"];
        return $result;
      }
    }

    public function marProductSales($yearlyDate) {
      $sql = $this->connect()->prepare("SELECT SUM(price) as subtotal FROM purchased_books WHERE MONTH(date) = '03' AND YEAR(date) = '$yearlyDate'");
      $sql->execute();

      while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $result = $row["subtotal"];
        return $result;
      }
    }

    public function aprProductSales($yearlyDate) {
      $sql = $this->connect()->prepare("SELECT SUM(price) as subtotal FROM purchased_books WHERE MONTH(date) = '04' AND YEAR(date) = '$yearlyDate'");
      $sql->execute();

      while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $result = $row["subtotal"];
        return $result;
      }
    }

    public function mayProductSales($yearlyDate) {
      $sql = $this->connect()->prepare("SELECT SUM(price) as subtotal FROM purchased_books WHERE MONTH(date) = '05' AND YEAR(date) = '$yearlyDate'");
      $sql->execute();

      while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $result = $row["subtotal"];
        return $result;
      }
    }

    public function junProductSales($yearlyDate) {
      $sql = $this->connect()->prepare("SELECT SUM(price) as subtotal FROM purchased_books WHERE MONTH(date) = '06' AND YEAR(date) = '$yearlyDate'");
      $sql->execute();

      while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $result = $row["subtotal"];
        return $result;
      }
    }

    public function julProductSales($yearlyDate) {
      $sql = $this->connect()->prepare("SELECT SUM(price) as subtotal FROM purchased_books WHERE MONTH(date) = '07' AND YEAR(date) = '$yearlyDate'");
      $sql->execute();

      while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $result = $row["subtotal"];
        return $result;
      }
    }

    public function augProductSales($yearlyDate) {
      $sql = $this->connect()->prepare("SELECT SUM(price) as subtotal FROM purchased_books WHERE MONTH(date) = '08' AND YEAR(date) = '$yearlyDate'");
      $sql->execute();

      while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $result = $row["subtotal"];
        return $result;
      }
    }

    public function sepProductSales($yearlyDate) {
      $sql = $this->connect()->prepare("SELECT SUM(price) as subtotal FROM purchased_books WHERE MONTH(date) = '09' AND YEAR(date) = '$yearlyDate'");
      $sql->execute();

      while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $result = $row["subtotal"];
        return $result;
      }
    }

    public function octProductSales($yearlyDate) {
      $sql = $this->connect()->prepare("SELECT SUM(price) as subtotal FROM purchased_books WHERE MONTH(date) = '10' AND YEAR(date) = '$yearlyDate'");
      $sql->execute();

      while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $result = $row["subtotal"];
        return $result;
      }
    }

    public function novProductSales($yearlyDate) {
      $sql = $this->connect()->prepare("SELECT SUM(price) as subtotal FROM purchased_books WHERE MONTH(date) = '11' AND YEAR(date) = '$yearlyDate'");
      $sql->execute();

      while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $result = $row["subtotal"];
        return $result;
      }
    }

    public function decProductSales($yearlyDate) {
      $sql = $this->connect()->prepare("SELECT SUM(price) as subtotal FROM purchased_books WHERE MONTH(date) = '12' AND YEAR(date) = '$yearlyDate'");
      $sql->execute();

      while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $result = $row["subtotal"];
        return $result;
      }
    }

  }

?>