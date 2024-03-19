<?php

  class NewsFacade extends DBConnection {

    public function fetchNews() {
        $sql = $this->connect()->prepare("SELECT * FROM news ORDER BY created_at DESC");
        $sql->execute();
        return $sql;
    }

    
    public function fetchNewsSearch($search) {
        $sql = $this->connect()->prepare("SELECT * FROM news WHERE title LIKE '%$search%' OR description LIKE '%$search%'");
        $sql->execute();
        return $sql;
    }

    public function fetchNumberOfNews() {
      $sql = $this->connect()->prepare("SELECT * FROM news");
      $sql->execute();
      $count = $sql->rowCount();
      return $count;
    } 

    public function fetchNewsById($newsId) {
      $sql = $this->connect()->prepare("SELECT * FROM news WHERE id = ?");
      $sql->execute([$newsId]);
      return $sql;
    }

    public function addNews($title, $description) {
      $sql = $this->connect()->prepare("INSERT INTO news(title, description) VALUES (?, ?)");
      $sql->execute([$title, $description]);
      return $sql;
    }

    public function deleteNews($newsId) {
      $sql = $this->connect()->prepare("DELETE FROM news WHERE id = $newsId");
      $sql->execute();
      return $sql;
    }

    public function updateNews($newsId, $title, $description) {
        $sql = $this->connect()->prepare("UPDATE news SET title = :title, description = :description WHERE id = :newsId");
        $sql->bindParam(':title', $title);
        $sql->bindParam(':description', $description);
        $sql->bindParam(':newsId', $newsId);
        $sql->execute();
        return $sql;
    }

  }

?>