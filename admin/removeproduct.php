<?php
  // Get the products that you can remove
  // And displays them
  if (ISSET($_REQUEST['product'])) {
    require_once '../php/classes/product.class.php';
    switch ($_REQUEST['product']) {
      case 'delete':
        $product = new product();
        $product->delete($_REQUEST['productID']);
        header("Location: removeproduct.php");
        break;
    }
  }

  require_once '../php/classes/product.class.php';
  require_once '../php/classes/view.class.php';

  $product = new product();
  $view = new view();

  $productListID = $product->productIDs();

  foreach ($productListID as $row) {
    $products = $product->details($row['idProduct']);

    echo $view->createRemoveAbleProducts($products);
  }
?>
