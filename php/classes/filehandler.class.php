<?php

  // File open modes
    // R read-only
    // W write and read
    // A On the end adds something

  // $theFile = fopen("fileOne.txt", "w");
  // // Opens the file with write acces
  //
  // fputs('fileOne.txt', "Line of text");
  // Wirtes data to the file the to bottom of the page

  // PHP_EOL
  // Used for a enter its like <br />

  class fileHandler {

    var $file;
    var $fileName;
    var $fileContent;
    var $fileExtension;
    var $fileSize;
    // File properties

    function __construct($fileName) {
      // Constructor set the filename
      // We only run the constructor if it has a value
      if (ISSET($fileName)) {
        if ($fileName > '') {
          $this->setFileName($fileName);
        }
      }
    }
    function __destruct() {
      // Clears the class
      $this->clearProperties();
    }
    function setFileName($fileName) {
      // Set the file name
      $fileName = $this->checkInput($fileName);
      $this->fileName = "file/".$fileName;
    }
    function readFile() {
      // Reads the file
      $fileExists = $this->checkFileExists();
      if ($fileExists) {
        $this->fileContent = file_get_contents($this->fileName);
        return($this->fileContent);
      }
      return("File doesn't exists");
    }
    function openFile($mode) {
      // Opens the file
      $fileExists = $this->checkFileExists();
      if ($fileExists) {
        $fileName = $this->fileName;
        $this->file = fopen($fileName, $mode);
      }
      else {
        return("File doesn't exists RUN create file");
      }
    }
    private function stringToArray() {
      // This function creates a array from a string
      $string = $this->fileName;
      $array = explode(",", $string);
      $arrayLenght = count($array);
      // Explode is seperating the , and creates a array
      for ($i=0; $i < $arrayLenght; $i++) {
        $this->fileName = $array[$i];
        $this->createFile();
      }
    }
    function createMultipleFiles() {
      $this->stringToArray();
    }
    private function createFile() {
      // Create a file
      $fileExists = $this->checkFileExists();
      if (!$fileExists) {
        $fileName = $this->fileName;
        $this->file = fopen($this->checkInput($fileName), 'w');
        $this->closeFile();
        echo "File created";
      }
      else {
        echo "File already exists";
      }
    }
    function closeFile() {
      // Closes a file
      fclose($this->file);
      // Clears the properties

      $this->clearProperties();

      return("File is closed");
    }
    private function checkFileExists() {
      // Check if the file exists
      $fileExists = file_exists($this->fileName);
      if ($fileExists) {
        return (true);
      }
      else {
        return(false);
      }
    }
    // function writeFile($fileContent) {
    //   // Write something to a file
    //   $fileExists = $this->checkFileExists();
    //   if ($fileExists) {
    //     $file = $this->file;
    //     fwrite($file, $fileContent);
    //   }
    //   return("Couldn't wirte something");
    // }
    function updateFile($data) {
      // Update a file
      $fileExists = $this->checkFileExists();
      if ($fileExists == true) {
          $this->openFile('w');
          $file = $this->file;
          fwrite($file, $this->checkInput($data));
          $this->closeFile();
          // First close the file to prefent on a refresh that the file becomes empty
          $this->openFile('r');
          return("Update");
      }
      else {
        return("Couldn't wirte something");
      }
    }
    private function checkInput($data) {
      // This funcion checks the input
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      $data = htmlentities($data);
      return ($data);
    }
    private function clearProperties() {
      // Clear the properties
      $this->file = "";
      $this->fileName = "";
      $this->fileContent = "";
      $this->fileExtension = "";
      $this->fileSize = "";
    }
    function deleteFile() {
      // Delete a file
      $file = $this->fileName;
      unlink($file);
      $this->clearProperties();
      return('delete');
    }
    function getFileSize() {
      // Get the file size from the file
      $fileExists = $this->checkFileExists();
      if ($fileExists) {
        $this->fileSize = filesize($this->fileName);
        return($this->fileSize . " Bytes");
      }
      else {
        return("Well i didn't got the file size, file doens't exists");
      }
    }
    function getFileExtentsion() {
      $fileExists = $this->checkFileExists();
      if ($fileExists) {
        $this->fileExtension = pathinfo($this->fileName, PATHINFO_EXTENSION);
        return($this->fileExtension);
      }
      else {
        return("Well the file don't exists");
      }
    }
    function getFileList() {
      // Scan the directory for files
      $directoryScan = scandir('file/');
      unset($directoryScan[0]);
      unset($directoryScan[1]);
      // We remove the first items because we don't want dot's in the array
      return($directoryScan);
    }
  }
?>
