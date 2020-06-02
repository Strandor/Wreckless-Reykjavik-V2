<?php

class Language
{
public $language;
public $language_native;
public $language_short;
public $JSONPath;
public $JSON;

    function loadJSON() {
        $str = file_get_contents( $_SERVER["DOCUMENT_ROOT"] . '/Includes/languages/JSON/' . $this->JSONPath);
        $json = json_decode($str, true);
        $this->JSON = $json;
    }

    function __construct($language, $language_native, $language_short, $JSONPath) {
        $this->language = $language;
        $this->language_native = $language_native;
        $this->JSONPath = $JSONPath;
        $this->language_short = $language_short;
    }
}

$languages = array(
    "en" => new Language("English", "English", "en", "EN.json"),
    "is" => new Language("Icelandic", "Íslenska","is", "IS.json")
);

$PreferredLanguage = "en";
$lang = $languages[$PreferredLanguage];

function setLanguage($value) {
    global $languages;
    if(array_key_exists($value, $languages)) {
        $_SESSION["lang"] = $value;
        return 1;
    } else {
        return 0;
    }
}

function checkBrowserLanguage() {
    $HTMLlang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    global $languages;
    return array_key_exists($HTMLlang, $languages)? $HTMLlang : 'en';
}

function getPreferredLanguage() {
    global $PreferredLanguage;
    global $languages;
    global $lang;

    if(!isset($_SESSION["lang"])) {
        $_SESSION["lang"] = checkBrowserLanguage();
        $PreferredLanguage = checkBrowserLanguage();
    } else {
        $PreferredLanguage = $_SESSION["lang"];
    }

    $lang = $languages[$PreferredLanguage];
    $lang->loadJSON();
}
