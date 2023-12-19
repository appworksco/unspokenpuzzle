<?php

  class BannerFacade extends DBConnection {

    public function fetchBanner() {
      $sql = $this->connect()->prepare("SELECT * FROM banner");
      $sql->execute();
      return $sql;
    }

    public function updateBanner($bannerImage) {
      $sql = $this->connect()->prepare("UPDATE banner SET banner_image = '$bannerImage' WHERE id = 1");
      $sql->execute();
      return $sql;
    }

  }

?>