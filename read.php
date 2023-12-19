<?php 

	include('db/connector.php');
	include('models/book-facade.php');
  include('models/chapter-facade.php');
	include('layout/header.php');

  $bookFacade = new BookFacade;
  $chapterFacade = new ChapterFacade;

  if (isset($_GET["book_id"])) {
    $bookId = $_GET["book_id"];
  }
	
?>

<div class="bg-black" style="height: 100vh;">
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <?php
        $books = $bookFacade->fetchBookById($bookId)->fetchAll();
        foreach($books as $book) { ?>
        <div class="mt-4">
          <h1 class="text-light"><?= $book['book_name'] ?></h1>
          <p class="text-light">Chapters</p>
        </div>
        
        <?php
        $chapters = $chapterFacade->fetchChapterByBookId($bookId)->fetchAll();
        foreach($chapters as $chapter) { ?>
          <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $chapter["chapter"]?>" aria-expanded="false" aria-controls="flush-collapseOne">
                  Chapter <?= $chapter["chapter"] ?>
                </button>
              </h2>
              <div id="flush-collapse<?= $chapter["chapter"]?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body"><?= $chapter["content"] ?></div>
              </div>
            </div>
          </div>
        <?php } ?>  
      </div>
      <div class="col-md-3">
          <div class="mt-4">
            <img src="<?= $book["book_image"] ?>" class="w-100" alt="">
            <h5 class="text-light mt-2"><?= $book['book_name'] ?></h5>
            <p class="text-light"><?= $book['description'] ?></p>
          </div>
          <?php } ?>
      </div>
    </div>
  </div>
</div>
  

<?php include('layout/footer.php'); ?>