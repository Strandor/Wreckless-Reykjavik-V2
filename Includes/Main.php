<?php
require ($_SERVER["DOCUMENT_ROOT"] . '/Includes/library/Medoo.php');
use Medoo\Medoo;

session_start();
require_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/languages/Language.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Meta.php");

getPreferredLanguage();

$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => '66_wrecklessreykjavik',
    'server' => 'localhost',
    'username' => 'root',
    'password' => ''
]);
