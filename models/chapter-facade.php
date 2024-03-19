<?php

  class ChapterFacade extends DBConnection {

    public function fetchChapters() {
      $sql = $this->connect()->prepare("SELECT * FROM chapters");
      $sql->execute();
      return $sql;
    }

    public function fetchChapterByBookId($bookId) {
      $sql = $this->connect()->prepare("SELECT * FROM chapters WHERE book_id = ?");
      $sql->execute([$bookId]);
      return $sql;
    }

    public function verifyChapterById($bookId, $chapter) {
      $sql = $this->connect()->prepare("SELECT * FROM chapters WHERE book_id = ? AND chapter = ?");
      $sql->execute([$bookId, $chapter]);
      $count = $sql->rowCount();
      return $count;
    }

    public function fetchNumberOfChapterByBookId($bookId) {
      $sql = $this->connect()->prepare("SELECT chapter FROM chapters WHERE book_id = ?");
      $sql->execute([$bookId]);
      $count = $sql->rowCount();
      return $count;
    }

    public function fetchChapterById($bookId, $chapter) {
      $sql = $this->connect()->prepare("SELECT * FROM chapters WHERE book_id = ? AND chapter = ?");
      $sql->execute([$bookId, $chapter]);
      return $sql;
    }

    public function addChapter($bookId, $chapter, $content) {
      $sql = $this->connect()->prepare("INSERT INTO chapters(book_id, chapter, content) VALUES (?, ?, ?)");
      $sql->execute([$bookId, $chapter, $content]);
      return $sql;
    }

    public function deleteChapter($bookId, $chapter) {
      $sql = $this->connect()->prepare("DELETE FROM chapters WHERE book_id = $bookId AND chapter = $chapter");
      $sql->execute();
      return $sql;
    }

    public function updateChapter($bookId, $chapter, $content) {
      $sql = $this->connect()->prepare("UPDATE chapters SET chapter = '$chapter', content = '$content' WHERE book_id = $bookId AND chapter = $chapter");
      $sql->execute();
      return $sql;
    }

  }

?>