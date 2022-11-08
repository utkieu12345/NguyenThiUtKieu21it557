<?php
require "vendor/autoload.php";
$dbname = 'dct';
try {
  $m = new MongoDB\Client("mongodb+srv://Nhathv:h5zOLcDb13blWLR@cluster0.g3gvw.mongodb.net/myFirstDatabase?retryWrites=true&w=majority");
  // $db = $m->$dbname;
  // $db = $m->selectDB($dbname);
  echo "<p>Connected thành công ! <p>";
} catch (Exception $ex) {
  print $ex;
  header("location:../error.html");
}