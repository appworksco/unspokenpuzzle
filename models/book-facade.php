<?php

  class BookFacade extends DBConnection {

    public function fetchBooks() {
      $sql = $this->connect()->prepare("SELECT * FROM books");
      $sql->execute();
      return $sql;
    }

    public function fetchNumberOfBooks() {
      $sql = $this->connect()->prepare("SELECT * FROM books");
      $sql->execute();
      $count = $sql->rowCount();
      return $count;
    } 

    public function fetchNewRelease() {
      $sql = $this->connect()->prepare("SELECT * FROM books ORDER BY RAND() LIMIT 1");
      $sql->execute();
      return $sql;
    }

    public function fetchBookById($bookId) {
      $sql = $this->connect()->prepare("SELECT * FROM books WHERE id = ?");
      $sql->execute([$bookId]);
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

    public function updateBook($bookId, $bookImage, $bookName, $description, $price) {
      $sql = $this->connect()->prepare("UPDATE books SET book_image = '$bookImage', book_name = '$bookName', description = '$description', price = '$price' WHERE id = $bookId");
      $sql->execute();
      return $sql;
    }

    public function fetchParallaxOne() {
      $sql = $this->connect()->prepare("SELECT * FROM parallax_1 LIMIT 1");
      $sql->execute();
      return $sql;
    }

    public function fetchParallaxTwo() {
      $sql = $this->connect()->prepare("SELECT * FROM parallax_2 LIMIT 1");
      $sql->execute();
      return $sql;
    }

    public function fetchParallaxThree() {
      $sql = $this->connect()->prepare("SELECT * FROM parallax_3 LIMIT 1");
      $sql->execute();
      return $sql;
    }

    public function updateParallaxOne($bookId) {
      $sql = $this->connect()->prepare("UPDATE parallax_1 SET book_id = '$bookId' WHERE id = 1");
      $sql->execute();
      return $sql;
    }

    public function updateParallaxTwo($bookId) {
      $sql = $this->connect()->prepare("UPDATE parallax_2 SET book_id = '$bookId' WHERE id = 1");
      $sql->execute();
      return $sql;
    }

    public function updateParallaxThree($bookId) {
      $sql = $this->connect()->prepare("UPDATE parallax_3 SET book_id = '$bookId' WHERE id = 1");
      $sql->execute();
      return $sql;
    }

  }

?>