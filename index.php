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

  </head>
  <body>
    <div class="wrapper">
      <div class="row">
        <?php require_once("assets/header.php"); ?>

          <img class="col-12 image_header" src="http://placehold.it/1080x150"/>

        <content>
          <div class="col-2 categories">
            <!-- Catagories -->
            <h3>categorieën</h3>
            <ul>
              <li>AR</li>
              <li>VR</li>
            </ul>
            <h3>Merken</h3>
            <ul>
              <li>HTC</li>
              <li>Oculus</li>
            </ul>
          </div>

          <div class="col-10">
            <?php
              require 'php/classes/product.class.php';
              require 'php/classes/view.class.php';

              $products = new Product();
              $productArray = $products->display('0');

              $view = new View();
              echo $view->displayProducts($productArray);
            ?>

          </div>

        </content>
        <?php require("assets/footer.php"); ?>
      </div>
    </div>
    <script src="js/main.js"></script>
  </body>
</html>
