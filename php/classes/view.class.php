<?php

  class view {
    public function displayProducts($result) {
      // This function creates the view for all products and returns it
      $products = '';
      foreach ($result as $key) {
        $products .= '
        <div class="col-3 col-m-4 product">
          <a href="products.php?details=' . $key['idProduct'] . '">
            <img class="col-12" src="http://placehold.it/300x300" />
            <h2>' . $key['naam'] . '</h2>
          </a>
          <p>&euro;' . $key['prijs'] . '</p>
        </div>
        ';
      }
      return($products);
    }
    public function displayProductDetails($result) {
      // DIsplay product details
      $detail = '';
      foreach ($result as $key) {
        $detail .= '
          <div class="col-10 product_details">
            <h2>' . $key['naam'] . '</h2>
            <div class="col-12">' . $key['beschrijving'] . '</div>

            <p>&euro;' . $key['prijs'] . '</p>
          </div>
        ';
      }
      return($detail);
    }
  }


?>
