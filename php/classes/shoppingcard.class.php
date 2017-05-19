<?php
require_once 'webshop.class.php';
require_once 'security.class.php';
  class Shoppingcard extends webshop {
    // Classe met hoofdletter
    // constructor public private or protected
    // Enters tussen method's


    public function add($productID, $amount) {
      // Ads product to shoppingcard
      $s = new Security();
      $_SESSION['shoppingcard'][$s->checkInput($productID)] = array('amount' => $s->checkInput($amount));
    }

    public function delete($productID) {
      // Delete a shoppingcard product
      $s = new Security();
      // unset($_SESSION['shoppingcard'][$s->checkInput($productID])]);
      unset($_SESSION['shoppingcard'][$s->checkInput($productID)]);
    }

    public function update($productID, $amount) {
      $s = new Security();
      $_SESSION['shoppingcard'][$s->checkInput($productID)]['amount'] = $s->checkInput($amount);
    }
    public function getProductAmount($productID) {
      // Get the amount of a product in the shoppingcard
      // And returns it
      $s = new Security();
      return($_SESSION['shoppingcard'][$s->checkInput($productID)]['amount']);
    }

    public function get() {
      return($_SESSION['shoppingcard']);
    }
    public function checkIfIdExists($productID) {
      // This function checks if the product already exits in the shoppingcard
      // If it is return true
      // else false
      $s = new Security();
      var_dump($_SESSION['shoppingcard']);
      if ($_SESSION['shoppingcard'][$s->checkInput($productID)]['amount'] != 0) {
        return(true);
      }
      else {
        return(false);
      }
    }

    public function count() {
      // counts all product in the shoppingcard and returns it
      $counts = 0;
      foreach ($_SESSION['shoppingcard'] as $row) {
        foreach ($row as $key => $value) {
          if ($row[$key] != 1) {
            // If the id has more than 1 amounts
            $counts = $counts +  $value;
          }
          else {
            // If the ID has 1 item
            $counts = $counts + 1;
          }
        }
      }
      return($counts);
    }

  }


?>
