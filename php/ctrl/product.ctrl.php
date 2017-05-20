<?php
  if (ISSET($_REQUEST['product'])) {
    // Product controller
    require_once '../classes/product.class.php';
    require_once '../classes/view.class.php';
    require_once '../classes/security.class.php';
    $s = new security();

    if ($s->isLogedIn() == false) {
      // Not loged in product controller
      switch ($_GET['product']) {
        // Ctrl for non admin users
        case 'details':
          // Details of a product
          $product = new Product();
          $productArray = $product->details($_REQUEST['details']);

          $view = new View();
          echo $view->displayProductDetails($productArray);
          break;
        case 'page':
          // Display a certent page
          $product = new Product();
          $productArray = $product->display($_REQUEST['pageNumber']);

          $view = new View();
          echo $view->displayProducts($productArray);
        break;
        case 'pageNumbers':
          $product = new Product();
          $productsTotal = $product->countAllProducts();

          $pages = ceil($productsTotal / 10);
          echo $pages;
          $view = new View();
          echo $view->createPagenering($pages);
        break;
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
