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
      // No foreach needed
      // It is done in the previouse method
      $spec = '<table class="col-10 productSpec">';
          $spec .= '
            <tr>
              <th>' . $result['Specificatie_naam'] . '</th>
              <td>' . $result['Specificatie_waarde'] . '</td>
            </tr>
          ';
      $spec .= '</table>';
      return($spec);
    }

    public function displayProductTable($row) {
      // Create a table for a spesific row
      $table = '';
      foreach ($row as $key) {
        $table = '
          <tr>
            <td class="col-3"><img class="col-4" src="/leerjaar2/webshop/' . $key['pad'] . $key['filenaam'] .  '"></td>
            <td class="col-3">' . $key['naam'] . '</td>
            <td class="col-3">' . $key['prijs'] . '</td>
            <td class="col-3">' . $key['EAN'] . '</td>
            <td class="col-3">
              <a href="?product=updateForm&productID=' . $key['idProduct'] . '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
              <a href="?product=delete&productID=' . $key['idProduct'] . '"><i class="fa fa-trash-o" aria-hidden="true"></i>
            </td>
          </tr>
        ';
      }
      return($table);
    }


    public function createRemoveAbleProducts($result) {
      $view = '<table>';
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
      $view .= '<\table>';
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
        <div class="col-3"></div>
        <form method="post" class="col-6">
          <h2 class="col-12">Product naam</h2>
          <input class="col-4" type="text" name="productName" value="' . $key['naam'] . '"/>
          <h2 class="col-12">Product Prijs</h2>
          <input class="col-4" type="number" step="0.01" name="productPrice" value="' . $key['prijs'] . '">
          <h2 class="col-12">Beschrijving</h2>
          <textarea class="col-8" name="discription">' . $key['beschrijving'] . '</textarea>
          <h2 class="col-12">EAN-code</h2>
          <input class="col-4" type="text" name="ean-code" value="' . $key['EAN'] . '"/>
          <div></div>
          <input class="col-2" type="submit" name="product" value="update">
        </form>
        <div class="col-3"></div>
        ';
      }
      return($view);
    }
    public function displayShoppingCard($result, $amount, $productTotal) {
      $view = '';
      foreach ($result as $key) {
        $view .= '
          <div class="col-2">&nbsp;</div>
          <div class="col-8 product winkelmandje-height-center">
            <img class="col-1" src="' . $key['pad'] . $key['filenaam'] . '">
            <h2 class="col-5 left-text">' . $key['naam'] . '</h2>
            <p class="col-1 left-text">&euro;' . $key['prijs'] . '</p>';
            $view .= $this->generateOptionNumbers($key['idProduct'], $amount);
            $view .= '<i class="fa fa-trash-o col-1" aria-hidden="true" style="margin-top: 0.5em;" onclick="shoppingcard.remove(' . $key['idProduct'] . ')"></i>
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
      $selectField = '<select style="margin-top: 2.1em;" onchange="shoppingcard.update(\'' . $productID . '\', this.value);" class="col-2">';
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

    public function createForm() {
      // This function creates the create from
      // To create a new product
      $form = '
        <form enctype="multipart/form-data" method="post">
          <div>Product naam</div>
          <input type="text" name="productName" />

          <div>Product Prijs</div>
          <input type="number" step="0.01" name="productPrice">

          <div>Beschrijving</div>
          <textarea name="discription"></textarea>

          <div>Product Image</div>
          <input type="file" name="file_upload"/>

          <div>Product catagorie</div>
          <select name="catagorie">
            <option value="1">VR</option>
          </select>

          <div>EAN-code</div>
          <input type="text" name="ean-code" />

          <div></div>
          <input type="submit" name="product" value="add">
        </form>
      ';
      return($form);
    }
  }
?>
