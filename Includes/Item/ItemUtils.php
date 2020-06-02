<?php
require_once ($_SERVER["DOCUMENT_ROOT"] . "/Includes/Main.php");

$colors = array(
  "black" => "080409",
  "dark_gray" => "5B5858",
  "white" => "F0F6F4",
  "red" => "EB5757",
  "blue" => "2F80ED"
);

function getHex($name) {
  global $colors;
  return $colors[$name];
}
