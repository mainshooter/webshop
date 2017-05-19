<?php
require_once 'webshop.class.php';
require_once 'security.class.php';
  class shoppingcard extends webshop {
    // Classe met hoofdletter
    // constructor public private or protected
    // Enters tussen method's


    public function add($productID, $amount) {
      // Ads product to shoppingcard
      $s = new security();
      $_SESSION['shoppingcard'][$s->checkInput($productID)] = array('quantity' => $s->checkInput($amount));
    }
    public function delete($productID) {
      // Delete a shoppingcard product
      $s = new security();
      // unset($_SESSION['shoppingcard'][$s->checkInput($productID])]);
      unset($_SESSION['shoppingcard'][$s->checkInput($productID)]);
    }
    public function update($productID, $amount) {
      $s = new security();
      $_SESSION['shoppingcard'][$this->checkInput($productID)]['quantity'] = $this->checkInput($amount);
    }
    public function get() {
      return($_SESSION['shoppingcard']);
    }

  }


?>
