<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <title>Multiversum - VR-brillen</title>

  <link rel="stylesheet" href="style/grid.css" type="text/css">
  <link rel="stylesheet" href="style/style.css" type="text/css">

  <link href="https://fonts.googleapis.com/css?family=Quicksand:300" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script src="js/main.js"></script>

  </head>
  <body onload="shoppingcard.count();">
    <div class="wrapper">
      <div class="row">
        <?php require("assets/header.php"); ?>

          <img class="col-12 image_header" src="http://placehold.it/1080x150"/>
          <content id="content">
          <?php

            require_once 'php/classes/shoppingcard.class.php';
            require_once 'php/classes/product.class.php';
            require_once 'php/classes/view.class.php';

            $view = new View();
            $shoppingcard = new Shoppingcard();
            $product = new product();

            $shoppingcardArray = $shoppingcard->get();
            // Gets the shoppingcard array

            foreach ($shoppingcardArray as $key) {
              // Loops trough every item of the shoppingcard
              $product_details = $product->details($key['productID']);
              // Get the details of a product

              $amount = $shoppingcardArray[$key['productID']]['amount'];
              // Get how mutch we have of one product

              $productTotal = $shoppingcard->productTotalPriceInShoppingCard($key['productID']);
              // Total cost of one product with multiple items

              echo $view->displayShoppingCard($product_details, $amount, $productTotal);
              // Display
            }

          ?>
        </content>
        <?php require("assets/footer.php"); ?>
      </div>
    </div>

  </body>
</html>
