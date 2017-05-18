<?php
  require 'webshop.class.php';
  require 'security.class.php';

  class shoppingcard extends webshop {

    public function create() {
      // Creates the shoppingcard
      $_SESSION['shoppingcard'] = array();
    }

    public function add($productID, $amount) {
      // Ads product to shoppingcard
      $s = new security();
      $_SESSION['shoppingcard'][$this->checkInput($productID)] = array('quantity' => $s->checkInput($amount));
    }
    public function delete($productID) {
      // Delete a shoppingcard product
      $s = new security();
      unset($_SESSION['shoppingcard'][$s->checkInput($productID]));
    }
    public function update($productID, $amount) {
      $s = new security();
      $_SESSION['shoppingcard'][$this->checkInput($productID)]['quantity'] = $this->checkInput($amount);
    }

  }


?>
