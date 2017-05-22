<?php
  require_once '../php/classes/product.class.php';
  require_once '../php/classes/view.class.php';

  if(ISSET($_REQUEST['product'])) {
    switch ($_REQUEST['product']) {
      case 'updateList':
        $product = new product();
        $product_details = $product->details($_REQUEST['productID']);

        $view = new view();
        echo $view->updateProductForm($product_details);
        break;
      case 'update':

        $product = new product();
        $updateProductArray['naam'] = $_REQUEST['productName'];
        $updateProductArray['prijs'] = $_REQUEST['productPrice'];
        $updateProductArray['beschrijving'] = $_REQUEST['discription'];
        $updateProductArray['EAN'] = $_REQUEST['ean-code'];
        $updateProductArray['productID'] = $_REQUEST['productID'];

        $product->update($updateProductArray);

        header("Location: updateproduct.php");
        break;

      default:
        # code...
        break;
    }
  }
  $product = new Product();
  $productListID = $product->productIDs();

  $view = new View();

  foreach ($productListID as $key) {
    $products = $product->details($key['idProduct']);

    echo $view->listOfUpdateableProducts($products);
}


?>
