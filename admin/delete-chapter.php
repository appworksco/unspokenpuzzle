<?php

  include('../db/connector.php');
  include('../models/chapter-facade.php');
  include('../layout/dashboard-header.php');

  $chapterFacade = new ChapterFacade;

	if (isset($_GET["book_id"]) && isset($_GET["chapter"])) {
		$bookId = $_GET["book_id"];
		$chapter = $_GET["chapter"];
		$deleteChapter = $chapterFacade->deleteChapter($bookId, $chapter);
		if ($deleteChapter) {
			header("Location: chapters.php?msg=Chapter has been deleted successfully!");
		}
	}

?>