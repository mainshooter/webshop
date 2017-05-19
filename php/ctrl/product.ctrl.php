<?php

  if (ISSET($_REQUEST['product'])) {
    // Product controller
    require '../classes/product.class.php';
    require '../classes/view.class.php';
    require '../classes/security.class.php';
    $s = new security();

    if ($s->isLogedIn() == false) {
      // Not loged in product controller
      switch ($_GET['product']) {
        // Ctrl for non admin users
        case 'details':
          // Details of a product
          $productArray = $product->details($_REQUEST['details']);

          $view = new View();
          echo $view->displayProductDetails($productArray);
          break;
        case 'page':
          // Display a certent page
          $productArray = $product->display($_REQUEST['pageNumber']);

          $view = new View();
          echo $view->displayProducts($productArray);
        default:
            // Displays the first page by default
            $productArray = $product->display('0');

            $view = new View();
            echo $view->displayProducts($productArray);
          break;
      }
    }
    else if ($s->isLogedIn == true) {
      // Product admin controller
    }
  }


?>
