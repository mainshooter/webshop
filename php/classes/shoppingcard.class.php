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
      $_SESSION['shoppingcard'][$s->checkInput($productID)] = array('quantity' => $s->checkInput($amount));
    }

    public function delete($productID) {
      // Delete a shoppingcard product
      $s = new Security();
      // unset($_SESSION['shoppingcard'][$s->checkInput($productID])]);
      unset($_SESSION['shoppingcard'][$s->checkInput($productID)]);
    }

    public function update($productID, $amount) {
      $s = new Security();
      $_SESSION['shoppingcard'][$this->checkInput($productID)]['quantity'] = $this->checkInput($amount);
    }
    
    public function get() {
      return($_SESSION['shoppingcard']);
    }

  }


?>
