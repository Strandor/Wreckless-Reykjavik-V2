<?php
require_once ($_SERVER["DOCUMENT_ROOT"] . "/Includes/Main.php");

class Item
{
    private $ID;
    private $name;
    private $prize;
    private $colors;

    function getID() {
      return $this->ID;
    }

    function getName() {
        return $this->name;
    }

    function getPrize() {
        return $this->prize;
    }

    function getColors() {
      if(!isset($colors)) {
        global $database;
        $data = $database->select("items", [
            "colors"
        ], [
            "id" => $this->ID
        ]);

        if(count($data) > 0) {
          return json_decode($data[0]["colors"], TRUE);
        } else {
          return null;
        }
      } else {
        return $this->colors;
      }
    }

    function doesExist() {
        return ($this->ID != null);
    }

    function __construct($ID) {
        global $database;
        $this->ID = $ID;

        $data = $database->select("items", [
            "id",
            "name",
            "prize"
        ], [
            "id" => $ID
        ]);

        if(count($data) > 0) {
            $this->ID = $data[0]["id"];
            $this->name = $data[0]["name"];
            $this->prize = $data[0]["prize"];
        } else {
            $this->ID = null;
        }
    }
}
