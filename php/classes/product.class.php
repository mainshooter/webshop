<?php
  require_once 'webshop.class.php';
  require_once 'databasehandler.class.php';
  require_once 'security.class.php';

  class Product extends webshop {
    var $id;
    var $name;
    var $discription;
    var $price;
    // Properties

    public function add($newProductArray) {
      // Add a product to database
      // Parameter is send as a array
      $s = new Security();
      $db = new db();
      $sql = "INSERT INTO Product (`naam`, `prijs`, `beschrijving`, `Categorie_idCategorie`, 'EAN') VALUES (:naam, :prijs, :beschrijving, :Categorie_idCategorie, :EAN)";
      $input = array(
        // "Fabrikant_idFabrikant" => $s->checkInput($newProductArray['fabrikantID']),
        "naam" => $s->checkInput($newProductArray['naam']),
        "prijs" => $s->checkInput($newProductArray['prijs']),
        "beschrijving" => $s->checkInput($newProductArray['beschrijving']),
        "Categorie_idCategorie" => $s->checkInput($newProductArray['catagorieID']),
        "EAN" => $s->checkInput($newProductArray['EAN']);
      );
      return($db->CreateData($sql, $input));
    }

    public function remove($productID) {
      // Removes product
      $s = new Security();
      $db = new db();
      $sql = "DELETE FROM `Product` WHERE idProduct=:productID";
      $input = array(
        "productID" => $s->checkInput($productID)
      );
      return($db->DeleteData());
    }

    public function update($updateProductArray) {
      // Update product
      $s = new Security();
      $db = new db();
      $sql = "UPDATE `Product` SET `Fabrikant_idFabrikant`=:fabrikantID,`naam`=:naam,`prijs`=:prijs,`beschrijving`=:beschrijving,`Categorie_idCategorie`=:catagorieID WHERE idProduct=:productID";
      $input = array(
        "fabrikantID" => $s->checkInput($updateProductArray['fabrikantID']),
        "naam" => $s->checkInput($updateProductArray['naam']),
        "prijs" => $s->checkInput($updateProductArray['prijs']),
        "beschrijving" => $s->checkInput($updateProductArray['beschrijving']),
        "catagorieID" => $s->checkInput($updateProductArray['catagorieID']),
        "productID" => $s->checkInput($updateProductArray['productID'])
      );
      return($db->UpdateData($sql, $input));
    }

    public function details($id) {
      // This function gets the detailed page
      $s = new Security();
      $page = $s->checkInput($id);

      $db = new db();
      $sql = "SELECT * FROM `Product` JOIN files_has_Product on files_has_Product.Product_idProduct=`idProduct` JOIN files ON files_has_Product.files_idfiles=files.idfiles WHERE idProduct=:productID";
      $input = array(
        "productID" => $s->checkInput($id)
      );
      return($db->readData($sql, $input));
    }
    public function productSpec($productID) {
      // This function get the products specs from a product
      // It expexts as a parameter a productID
      // Returns array
      $db = new db();
      $s = new Security();

      $sql = "SELECT * FROM Specificatie WHERE Product_idProduct=:productID";
      $input = array(
        "productID" => $s->checkInput($productID)
      );
      return($db->readData($sql, $input));
    }

    public function productIDs() {
      // Get all ID's from all products and returns it
      $db = new db();
      $sql = "SELECT idProduct FROM Product";
      $input = array();

      return($db->readData($sql, $input));
    }

    public function countAllProducts() {
      // This function counts all products
      // And returns the number of products we have
      $db = new db();
      $sql = "SELECT idProduct FROM Product";
      $input = array();

      return($db->countRows($sql, $input));
    }

    public function display($page) {
      // This function gets all products for a page
      // And returns it
      $s = new Security();
      $page = $s->checkInput($page);

      $db = new db();
      $sql = "SELECT * FROM `Product` JOIN files_has_Product on files_has_Product.Product_idProduct=`idProduct` JOIN files ON files_has_Product.files_idfiles=files.idfiles LIMIT :page, 10";
      $input = array(
        "page" => $s->checkInput($page)
      );
      // First number is how mutch we want to show
      // Seconds is where we start
      return($db->readData($sql, $input));
    }

    public function productPrice($productID) {
      // Gets the price of one product
      // And returns it as a number or string
      $db = new db();
      $s = new Security();

      $sql = "SELECT prijs FROM Product WHERE idProduct=:productID LIMIT 1";
      $input = array(
        "productID" => $s->checkInput($productID)
      );
      $result = $db->readData($sql, $input);

      foreach ($result as $row) {
        return(intval($row['prijs']));
      }
    }

    public function getCatagories() {
      // This function get all the catagories and returns it as a array
      $db = new db();
      $sql = "SELECT * FROM catagories";
      $input = array();

      return($db->readData($sql, $input));
    }

    public function getProductsFromCatagories() {
      // This function gets all products form a catagorie and returns it as a array
    }
  }


?>
