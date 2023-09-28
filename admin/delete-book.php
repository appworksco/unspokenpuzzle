<?php

  include('../db/connector.php');
  include('../models/book-facade.php');
  include('../layout/header.php');

  $bookFacade = new BookFacade;

	if (isset($_GET["book_id"]) && isset($_GET["book_image"])) {
		$bookId = $_GET["book_id"];
		$bookFile = '../' . $_GET["book_file"];
		$bookImage = '../' . $_GET["book_image"];
		$deleteBook = $bookFacade->deleteBook($bookId);
		if ($deleteBook) {
			unlink($bookFile);
			unlink($bookImage);
			header("Location: books.php?msg=Book has been deleted successfully!");
		}
	}

?>