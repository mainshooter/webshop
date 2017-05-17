<?php
  require 'webshop.class.php';
  require 'databasehandler.class.php';
  require 'security.class.php';

  class product extends webshop {
    var $id;
    var $name;
    var $discription;
    var $price;
    // Properties

    public function add() {

    }
    public function remove() {

    }
    public function update() {

    }
    public function details($id) {
      // This function gets the detailed page
      $security = new security();
      $page = $security->checkInput($id);

      $db = new db();
      $sql = "SELECT * FROM product WHERE idProduct=:productID";
      $input = array(
        "productID" => $security->checkInput($id)
      );
      return($db->readData($sql, $input));
    }

    public function display($page) {
      // This function gets all products for a page
      // And returns it
      $security = new security();
      $page = $security->checkInput($page);

      $db = new db();
      $sql = "SELECT * FROM `Product` JOIN files_has_Product on files_has_Product.Product_idProduct=`idProduct` JOIN files on files_has_Product.files_idfiles=files_has_Product.idfiles_has_Product LIMIT :page, 4";
      $input = array(
        "page" => $page
      );
      // First number is how mutch we want to show
      // Seconds is where we start
      return($db->readData($sql, $input));
    }
  }


?>
