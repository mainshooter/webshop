<?php

  class view {
    public function displayProducts($result) {
      // This function creates the view for all products and returns it
      $products = '';
      foreach ($result as $key) {
        $products .= '
        <div class="col-3 col-m-4 product">
          <img class="col-12" src="http://placehold.it/300x300" />
          <h2>' . $key['naam'] . '</h2>
          <p>&euro;' . $key['prijs'] . '</p>
        </div>
        ';
      }
      return($products);
    }
  }


?>
