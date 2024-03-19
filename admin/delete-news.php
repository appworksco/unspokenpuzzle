<?php

include('../db/connector.php');
include('../models/news-facade.php');
include('../layout/dashboard-header.php');

$newsFacade = new NewsFacade;

if (isset($_GET["news_id"])) {
    $newsId = $_GET["news_id"];
    $deleteNews = $newsFacade->deleteNews($newsId);
    if ($deleteNews) {
        header("Location: news.php?msg=News has been deleted successfully!");
    }
}

?>