<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/leerjaar2/webshop/style/grid.css">
<link rel="stylesheet" href="/leerjaar2/webshop/style/style.css">

<div class="row">
<?php

  require_once '../php/classes/view.class.php';
  require_once '../php/classes/product.class.php';
  require_once '../php/classes/filehandler.class.php';

  $product = new Product();
  $view = new View();
  $filehandler = new filehandler();

  if (ISSET($_REQUEST['product'])) {
    switch ($_REQUEST['product']) {
      case 'addProductForm':
        // Creates the form that you can add a new product
        echo $view->createForm();
        break;
      case 'add':
        // Add a product
        $filehandler->fileName = $_FILES['file_upload']['name'];
        $filehandler->filePath = '../file/uploads/';
        if ($filehandler->checkFileExists() == false) {
          // If the file doen't exists
          $filehandler->uploadFile();
          $fileID = $filehandler->saveFileLocation($_FILES['file_upload']['name'], '../file/uploads/');
          // Handels the uploaded image

          $newProductArray['fabrikantID'] = NULL;
          $newProductArray['naam'] = $_REQUEST['productName'];
          $newProductArray['prijs'] = $_REQUEST['productPrice'];
          $newProductArray['beschrijving'] = $_REQUEST['discription'];
          $newProductArray['catagorieID'] = $_REQUEST['catagorie'];
          $newProductArray['EAN'] = $_REQUEST['ean-code'];

          $productID = $product->add($newProductArray);
          $db = new db();
          $sql = "INSERT INTO files_has_Product (files_idfiles, Product_idProduct) VALUES (:fileID, :productID)";
          $input = array(
            "fileID" => $fileID,
            "productID" => $productID
          );
          $db->CreateData($sql, $input);
          echo "Done.";
          header("Location: crud.php");
        }
        else {
          echo "Didn't work";
        }
        break;
      case 'delete':
        $product = new product();
        $product->delete($_REQUEST['productID']);
        header("Location: crud.php");
        break;
      case 'updateForm':
        $product_details = $product->details($_REQUEST['productID']);

        $view = new view();
        echo $view->updateProductForm($product_details);
        break;
      case 'update':
        $updateProductArray['naam'] = $_REQUEST['productName'];
        $updateProductArray['prijs'] = $_REQUEST['productPrice'];
        $updateProductArray['beschrijving'] = $_REQUEST['discription'];
        $updateProductArray['EAN'] = $_REQUEST['ean-code'];
        $updateProductArray['productID'] = $_REQUEST['productID'];

        $product->update($updateProductArray);
        header("Location: crud.php");
        break;

      default:
        // DIsplay every product
        $productID = $product->productIDs();

        $table = '
          <table>
            <tr>
              <th>Product foto</th>
              <th>Product naam</th>
              <th>Product prijs</th>
              <th>EAN code</th>
              <th></th>
            </tr>
        ';
        foreach ($productID as $key) {
          $productView = $product->details($key['idProduct']);
          $table .= $view->displayProductTable($productView);
        }
        $table .= '</table>';
        echo $table;
        break;
    }
  }
  else {
    echo "<button type='button'><a href='?product=addProductForm'>Toevoegen</a></button>";
    $productID = $product->productIDs();

    $table = '
      <table>
        <tr>
          <th>Product foto</th>
          <th>Product naam</th>
          <th>Product prijs</th>
          <th>EAN code</th>
          <th></th>
        </tr>
    ';
    foreach ($productID as $key) {
      $productView = $product->details($key['idProduct']);
      $table .= $view->displayProductTable($productView);
    }
    $table .= '</table>';
    echo $table;
  }

?>
</div>
