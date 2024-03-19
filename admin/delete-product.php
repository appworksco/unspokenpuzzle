<?php

  include('../db/connector.php');
  include('../models/shop-facade.php');
  include('../layout/dashboard-header.php');

  $shopFacade = new ShopFacade;

	if (isset($_GET["product_id"]) && isset($_GET["image"])) {
		$productId = $_GET["product_id"];
		$image = '../' . $_GET["image"];
		$deleteProduct = $shopFacade->deleteProduct($productId);
		if ($deleteProduct) {
			unlink($image);
			header("Location: shop.php?msg=Product has been deleted successfully!");
		}
	}

?>