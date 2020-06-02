<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Main.php");

$search_string = "";
if(isset($_GET["s"])) {
    $search_string = $_GET["s"];
}

if($search_string == null) {
    die("[]");
}

$data = $database->select('items', [
    'id',
    'name',
    'prize',
], [
    'name[~]' => $search_string,
    'LIMIT' => 3
]);

echo json_encode($data);