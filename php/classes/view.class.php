<?php

  class View {
    public function displayProducts($result) {
      // This function creates the view for all products and returns it
      $products = '';
      foreach ($result as $key) {
        $products .= '
        <div class="col-3 col-m-4 product">
          <a href="products.php?details=' . $key['idProduct'] . '">
            <div class="col-12 col-m-12">
              <img class="product_img" src="' . $key['pad'] . $key['filenaam'] . '" />
            </div>
            <h2>' . $key['naam'] . '</h2>
          </a>
          <p>&euro;' . $key['prijs'] . '</p>
          <i class="fa fa-cart-arrow-down" aria-hidden="true" onclick="shoppingcard.add(' . $key['idProduct'] . ');shoppingcard.goTo();"></i>
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
            <i class="fa fa-cart-plus col-5" aria-hidden="true" onclick="shoppingcard.add(' . $key['idProduct'] . ')"></i>

            <p class="col-12">EAN code: ' . $key['EAN'] . '</p>
          </div>
        ';
      }
      return($detail);
    }
    public function displayProductSpecs($result) {
      // var_dump($result);
      $spec = '<table class="col-10 productSpec">';
      foreach ($result as $key) {
        // var_dump($key);
        var_dump($value);
        foreach ($key as $row => $value) {
          $spec .= '
            <tr>
              <th>' . $value['Specificatie_naam'] . '</th>
              <td>' . $value['Specificatie_waarde'] . '</td>
            </tr>
          ';
        }
      }
      $spec = '</table>';
      echo $spec;
      return($spec);
    }

    public function createRemoveAbleProducts($result) {
      $view = '';
      foreach ($result as $key) {
        $view .= '
        <div class="col-3 col-m-4 product">
          <a href="products.php?details=' . $key['idProduct'] . '">
            <h2>' . $key['naam'] . '</h2>
          </a>
          <p>&euro;' . $key['prijs'] . '</p>
          <a href="?product=delete&productID=' . $key['idProduct'] . '">DELETE</a>
        </div>
        ';
      }
      return($view);
    }

    public function listOfUpdateableProducts($result) {
      $view = '';
      foreach ($result as $key) {
        $view .= '
        <div class="col-3 col-m-4 product">
            <h2>' . $key['naam'] . '</h2>
          <p>&euro;' . $key['prijs'] . '</p>
          <a href="?product=updateList&productID=' . $key['idProduct'] . '">UPDATE</a>
        </div>
        ';
      }
      return($view);
    }
    public function updateProductForm($result) {
      $view = '';
      foreach ($result as $key) {
        $view .= '
        <form method="post">
          <div>Product naam</div>
          <input type="text" name="productName" value="' . $key['naam'] . '"/>

          <div>Product Prijs</div>
          <input type="number" step="0.01" name="productPrice" value="' . $key['prijs'] . '">

          <div>Beschrijving</div>
          <textarea name="discription">' . $key['beschrijving'] . '</textarea>

          <div>EAN-code</div>
          <input type="text" name="ean-code" value="' . $key['EAN'] . '"/>

          <div></div>
          <input type="submit" name="product" value="update">
        </form>
        ';
      }
      return($view);
    }

    public function displayShoppingCard($result, $amount, $productTotal) {
      $view = '';
      foreach ($result as $key) {
        $view .= '
          <div class="col-12"></div>
          <div class="col-2">&nbsp;</div>
          <div class="col-8 product winkelmandje-height-center">
            <img class="col-1" src="' . $key['pad'] . $key['filenaam'] . '">
            <h2 class="col-6 left-text">' . $key['naam'] . '</h2>
            <p class="col-1 left-text">&euro;' . $key['prijs'] . '</p>';
            $view .= $this->generateOptionNumbers($key['idProduct'], $amount);

            $view .= '<i class="fa fa-trash-o col-1" aria-hidden="true" onclick="shoppingcard.remove(' . $key['idProduct'] . ')"></i>
            <p class="col-2">Totaal: &euro;' . $productTotal . '</p>
          </div>
          <div class="col-2">&nbsp;</div>
          <div class="col-12"></div>
        ';
      }
      return($view);
    }

    public function generateOptionNumbers($productID, $amount) {
      // Generates a select input field.
      // When the option is the same to the number we got for the option input
      // We set that as selected
      $selectField = '<select onchange="shoppingcard.update(\'' . $productID . '\', this.value);" class="col-1">';
      for ($i=0; $i < 10; $i++) {
        if ($amount == $i) {
          $selectField .= '<option value="' . $i .'" selected>' . $i . '</option>';
        }
        else {
          $selectField .= '<option value="' . $i .'">' . $i . '</option>';
        }
      }
      $selectField .= '</select>';
      return($selectField);
    }

    public function createPagenering($pages) {
      // Creates the pagenering
      $list = '';
      $list .= '<ul>';
      for ($i=0; $i < $pages; $i++) {
        $list .= '<li><a href="products.php?page=' . $i . '">' . $i . '</a></li>';
      }
      $list .= '</ul>';
      return($list);
    }

  }


?>
