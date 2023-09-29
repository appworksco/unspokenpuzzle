<?php

  class PurchasedBookFacade extends DBConnection {

    public function fetchBookById($userId) {
      $sql = $this->connect()->prepare("SELECT * FROM purchased_books WHERE user_id = '$userId'");
      $sql->execute();
      return $sql;
    }

    public function addPurchasedBookByUserId($userId, $bookId) {
      $sql = $this->connect()->prepare("INSERT INTO purchased_books(user_id, book_id) VALUES (?, ?)");
      $sql->execute([$userId, $bookId]);
      return $sql;
    }

  }

?>