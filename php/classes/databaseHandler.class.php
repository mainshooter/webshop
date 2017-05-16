<?php

  class db {
    // To use our database

    // To use this class following:
    // $db = new db();
    // $sql = "SELECT * FROM product WHERE idproduct=:productid";
    // $input = array(
    //   "productid" => 7
    // );
    // $db->readData($sql, $input);
    // This is called prepared statements


    var $conn;
    var $databaseName;
    var $username;
    var $password;
    // Properties for the database

    function __construct() {
      // Starts when the class is called
      try {
        $conn = new PDO("mysql:host=$this->serverIP;dbname=$this->databaseName", $this->username, $this->password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->conn = $conn;
        return("Succes");
      }
      catch (Exception $e) {
        return ("Connection failed: " . $e->getMessage());
      }
    }
    // SQL -> sql string prepared
    // input = array contains the input for the prepared statements
    function CreateData($sql, $input) {
      // Create some data

      // Used prepared statements

      try {
        $conn = $this->conn;

        $query = $conn->prepare($sql);
        $query->execute($input);

        $result = $query->rowCount();
        return("Succesfully created");
      } catch (Exception $e) {
        return ("Couldn't create data: " . $e->getMessage());
      }
    }

    // SQL -> sql string prepared
    // input = array contains the input for the prepared statements
    function readData($sql, $input) {
      try {
        $conn = $this->conn;
        $query = $conn->prepare($sql);

        $query->execute($input);

        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        return($row);
      } catch (Exception $e) {
          return ("Couldn't read data: " . $e->getMessage());
      }
    }
    // SQL -> sql string prepared
    // input = array contains the input for the prepared statements
    function UpdateData($sql, $input) {
      try {
        $conn = $this->conn;
        $query = $conn->prepare($sql);

        $query->execute($input);

        $row = $query->rowCount(PDO::FETCH_ASSOC);
        return("Succesfully updated");
      } catch (Exception $e) {
          return ("Couldn't update data: " . $e->getMessage());
      }
    }
    // SQL -> sql string prepared
    // input = array contains the input for the prepared statements
    function DeleteData($sql, $input) {
      try {
        $conn = $this->conn;

        $query = $conn->prepare($sql);
        $query->execute($input);

        $result = $query->rowCount();
        return("Succesfully");
      } catch (Exception $e) {
        return ("Couldn't delete data: " . $e->getMessage());
      }
    }
  }
?>
