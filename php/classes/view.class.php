<?php

  class View {
    public function displayProducts($result) {
      // This function creates the view for all products and returns it
      $products = '';
      foreach ($result as $key) {
        $products .= '
        <div class="col-3 col-m-4 product">
          <a href="products.php?details=' . $key['idProduct'] . '">
            <img class="col-12" src="' . $key['pad'] . $key['filenaam'] . '" />
            <h2>' . $key['naam'] . '</h2>
          </a>
          <p>&euro;' . $key['prijs'] . '</p>
          <i class="fa fa-cart-arrow-down" aria-hidden="true" onclick="shoppingcard.add(' . $key['idProduct'] . ');"></i>
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
            <h2 class="col-12">' . $key['naam'] . '</h2>
            <img class="col-3" src="' . $key['pad'] . $key['filenaam'] . '" />
            <div class="col-9">' . $key['beschrijving'] . '</div>

            <p class="col-1">&euro;' . $key['prijs'] . '</p>
            <i class="fa fa-cart-plus col-5" aria-hidden="true"></i>
          </div>
        ';
      }
      return($detail);
    }

    public function displayShoppingCard($result, $amount) {
      $view = '';
      foreach ($result as $key) {
        $view .= '
        <div class="col-12 product">
          <h2 class="col-12 left-text">' . $key['naam'] . '</h2>
          <img class="col-2" src="' . $key['pad'] . $key['filenaam'] . '">
          <p class="col-3 left-text winkelmandje-height-center">' . $key['prijs'] . '</p>';

            $this->generateOptionNumber($key['idProduct'], $amount);

          $view .= '<i class="fa fa-trash-o col-3 winkelmandje-height-center" aria-hidden="true" onclick="shoppingcard.remove(' . $key['idProduct'] . ')"></i>
        </div>
        ';
      }
      return($view);
    }

    public function generateOptionNumbers($productID, $amount) {
      // Generates a select input field.
      // When the option is the same to the number we got for the option input
      // We set that as selected
      $selectField = '<select onchange="shoppingcard.update(' . $productID . ', this.value);" class="col-2 winkelmandje-height-center">';
      for ($i=0; $i < 10; $i++) {
        if ($amount === $i) {
          $selectField .= '<option value="' . $i .' selected>' . $i . '"</option>';
        }
        else {
          $selectField .= '<option value="' . $i .'">' . $i . '</option>';
        }
      }
      $selectField .= '</select>';
      return($selectField);
    }

  }


?>
