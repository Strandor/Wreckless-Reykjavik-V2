<?php
class MetaClass {
  public $properties = array();
  public $lang;

  function getProperty($value) {
    return $this->properties[$value];
  }

  function getMetaPropertyString($meta, $meta_value, $value, $checkValue = true) {
    return ("<meta $meta=\"$meta_value\" content=\"" . ($checkValue ? $this->getProperty($value) : $value) . "\">");
  }

  function __construct($page_ID, $lang, $css = false) {
    $this->lang = $lang;
    $this->properties["page"] = $page_ID;
    $this->properties["title"] = $lang->JSON["general"]["brand_name"] . " - " . $lang->JSON["pages"][$page_ID];
    $this->properties["description"] = $lang->JSON["general"]["description"];
    $this->properties["url"] = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    $this->properties["image"] = "/assets/brand/meta_image.png";
    $this->properties["css"] = $css;
  }

  function printMetProperty() {
    echo "<title>" . $this->getProperty("title") . "</title>";
    echo $this->getMetaPropertyString("name", "title", "title");
    echo $this->getMetaPropertyString("name", "description", "description");
    echo "<link href=\"/style/main.css\" rel=\"stylesheet\">";

    echo $this->getMetaPropertyString("property", "og:type", "website", false);
    echo $this->getMetaPropertyString("property", "og:url", "url");
    echo $this->getMetaPropertyString("property", "og:title", "title");
    echo $this->getMetaPropertyString("property", "og:description", "description");
    echo $this->getMetaPropertyString("property", "og:image", "image");

    echo $this->getMetaPropertyString("property", "twitter:card", "summary_large_image", false);
    echo $this->getMetaPropertyString("property", "twitter:url", "url");
    echo $this->getMetaPropertyString("property", "twitter:title", "title");
    echo $this->getMetaPropertyString("property", "twitter:description", "description");
    echo $this->getMetaPropertyString("property", "twitter:image", "image");

    echo "<meta charset=\"UTF-8\">";
    echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no\">";
    echo "<script src=\"/js/anime.min.js\"></script>";
    echo "<script src=\"/js/main.js\"></script>";

    if($this->getProperty("css") == true) {
        echo "<link href=\"/style/" . $this->getProperty("page") .  ".css\" rel=\"stylesheet\">";
    }
  }
}
?>
