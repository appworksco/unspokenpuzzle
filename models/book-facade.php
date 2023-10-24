<?php

  class BookFacade extends DBConnection {

    public function fetchBooks() {
      $sql = $this->connect()->prepare("SELECT * FROM books");
      $sql->execute();
      return $sql;
    }

    public function fetchNewRelease() {
      $sql = $this->connect()->prepare("SELECT * FROM books ORDER BY id DESC LIMIT 1");
      $sql->execute();
      return $sql;
    }

    public function fetchBookById($bookId) {
      $sql = $this->connect()->prepare("SELECT * FROM books WHERE id = '$bookId'");
      $sql->execute();
      return $sql;
    }

    public function verifyBookFile($bookFile) {
      $sql = $this->connect()->prepare("SELECT book_file FROM books WHERE book_file = ?");
      $sql->execute([$bookFile]);
      $count = $sql->rowCount();
      return $count;
    }

    public function verifyBookName($bookName) {
      $sql = $this->connect()->prepare("SELECT book_name FROM books WHERE book_name = ?");
      $sql->execute([$bookName]);
      $count = $sql->rowCount();
      return $count;
    }

    public function addBook($bookImage, $bookName, $description, $price) {
      $sql = $this->connect()->prepare("INSERT INTO books(book_image, book_name, description, price) VALUES (?, ?, ?, ?)");
      $sql->execute([$bookImage, $bookName, $description, $price]);
      return $sql;
    }

    public function updateUser($updateUserId, $firstName, $lastName, $username, $password) {
      $sql = $this->connect()->prepare("UPDATE users SET first_name = '$firstName', last_name = '$lastName', username = '$username', password = '$password' WHERE id = $updateUserId");
      $sql->execute();
      return $sql;
    }

    public function deleteBook($bookId) {
      $sql = $this->connect()->prepare("DELETE FROM books WHERE id = $bookId");
      $sql->execute();
      return $sql;
    }

    public function updateDesc($bookId, $description) {
      $sql = $this->connect()->prepare("UPDATE books SET description = '$description' WHERE id = $bookId");
      $sql->execute();
      return $sql;
    }

    public function isLoggedOut($userId) {
      $sql = $this->connect()->prepare("UPDATE user SET is_logged_in = 0 WHERE id = $userId");
      $sql->execute();
      return $sql;
    }

    public function login($username, $password) {
      $sql = $this->connect()->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
      $sql->execute([$username, $password]);
      return $sql;
    }

    public function addPurchasedBookByUserId($userId, $bookId) {
      $sql = $this->connect()->prepare("INSERT INTO p(book_file, book_image, book_name, description, price) VALUES (?, ?, ?, ?, ?)");
      $sql->execute([$bookFile, $bookImage, $bookName, $description, $price]);
      return $sql;
    }

  }

?>