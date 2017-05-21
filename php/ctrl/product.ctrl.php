<?php
  if (ISSET($_REQUEST['product'])) {
    // Product controller
    require_once '../classes/product.class.php';
    require_once '../classes/view.class.php';
    require_once '../classes/security.class.php';
    require_once '../classes/filehandler.class.php';
    require_once '../classes/databasehandler.class.php';


    $s = new security();

    if ($s->isLogedIn() == false) {
      // Not loged in product controller
      switch ($_REQUEST['product']) {
        // Ctrl for non admin users
        case 'add':
            $product = new product();
            $filehandler = new filehandler();

            $filehandler->fileName = $_FILES['file_upload']['name'];
            $filehandler->filePath = '../../file/uploads/';
            if ($filehandler->checkFileExists() == true || $filehandler->checkFileExists() == false) {
              // If the file doen't exists
              $filehandler->uploadFile();
              // Handels the uploaded image

              $newProductArray['fabrikantID'] = NULL;
              $newProductArray['naam'] = $_REQUEST['productName'];
              $newProductArray['prijs'] = $_REQUEST['productPrice'];
              $newProductArray['beschrijving'] = $_REQUEST['discription'];
              $newProductArray['catagorieID'] = $_REQUEST['catagorie'];

              $createdProductID = $product->add($newProductArray);
              $db = new db();
              $sql = "INSERT INTO files (filenaam, pad) VALUES (:filenaam, :pad)";
              $input = array(
                "filenaam" => $s->checkInput($_FILES['file_upload']['name']),
                "pad" => 'file/uploads/'
              );
              $fileID = $db->CreateData($sql, $input);

              $sql = "INSERT INTO files_has_Product (files_idfiles, Product_idProduct) VALUES (:fileID, :productID)";
              $input = array(
                "fileID" => $fileID,
                "productID" => $createdProductID
              );
              $db->CreateData($sql, $input);
              echo "Done.";
            }
            else {
              echo "EXITST";
            }
          break;
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
