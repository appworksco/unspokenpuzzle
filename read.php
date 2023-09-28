<?php 

	include('db/connector.php');
	include('models/book-facade.php');
	include('layout/header.php');

  $bookFacade = new BookFacade;

  if (isset($_GET["book_id"])) {
    $bookId = $_GET["book_id"];
  }

	function read($file) {
		$bookFile = fopen($file, 'r') or die("Unable to open file");
		$fileContent = fread($bookFile, filesize($file));
		fclose($bookFile);
		return $fileContent;
	}

	
	
?>

  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <?php
         $books = $bookFacade->fetchBookById($bookId)->fetchAll();
         foreach($books as $book) { ?>
          <div class="mt-4">
            <h1><?= $book['book_name'] ?></h1>
            <p><?= nl2br(read($book['book_file'])) ?></p>
          </div>
       
      </div>
      <div class="col-md-3">
          <div class="mt-4">
            <img src="<?= $book["book_image"] ?>" class="w-100" alt="">
            <h5 class="mt-2"><?= $book['book_name'] ?></h5>
            <p><?= $book['description'] ?></p>
          </div>
          <?php } ?>
      </div>
    </div>
  </div>

<?php include('layout/footer.php'); ?>
<script>
      document.addEventListener("contextmenu", (event) => {
         event.preventDefault();
      });
   </script>