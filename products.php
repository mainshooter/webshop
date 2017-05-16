<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <title>Multiversum - VR-brillen - Producten</title>

  <link rel="stylesheet" href="style/grid.css" type="text/css">
  <link rel="stylesheet" href="style/style.css" type="text/css">

  <script src="js/main.js"></script>

  </head>
  <body>
    <div class="wrapper">
      <div class="row">
        <nav>
          <a href="index.php">
            <img class="col-1" src="file/site/logo.png">
          </a>
          <div id="nav" class="col-10">
              <ul id="width-ul">
                  <li><a href="index.php">Home</a></li>
                  <li><a href="products.php">Producten</a></li>
                  <li><a href="contact.php">Contact</a></li>
              </ul>
          </div>
          <img class="col-1" src="file/site/shopping-card.png"/>
        </nav>

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
              // Display product details
              require 'php/classes/product.class.php';
              require 'php/classes/view.class.php';

              if (ISSET($_REQUEST['details'])) {
                // Want to display product details
                $products = new product();
                $productArray = $products->details($_REQUEST['details']);

                $view = new view();
                echo $view->displayProductDetails($productArray);
              }
              ?>
            </div>

          </content>

        <div class="footer col-12">
          &copy;Multiversum - webshop
        </div>
      </div>
    </div>

  </body>
</html>
