<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Main.php");
global $lang;

$request = array("error" => $lang->JSON["error"]["unknown"]);

if(!isset($_GET["lang"])) {
    $request = array("error" => $lang->JSON["error"]["unspecified_language"]);
} else {
    if(setLanguage($_GET["lang"]) == 1) {
        $request = array("success" => true);
    } else {
        $request = array("error" => $lang->JSON["error"]["language_does_not_exist"]);
    }
}



$request = json_encode($request);
echo $request;