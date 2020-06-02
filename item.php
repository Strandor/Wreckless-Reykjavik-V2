<?php
require_once ($_SERVER["DOCUMENT_ROOT"] . "/Includes/Main.php");
require_once ($_SERVER["DOCUMENT_ROOT"] . "/Includes/Item/Item.php");
require_once ($_SERVER["DOCUMENT_ROOT"] . "/Includes/Item/ItemUtils.php");
global $lang;

/*
 * Check if the user has provided which item he wishes to view.
 * If not display ERROR 404: Not found
 */
if(!isset($_GET["i"])) {
    http_response_code(404);
    die();
}

/*
 * Check if the item which the user wants to view exists
 * If not display ERROR 404: Not found
 */
$item = new Item($_GET["i"]);
if(!$item->doesExist()) {
    http_response_code(404);
    die();
}

$item = new Item($_GET["i"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    $Meta = new MetaClass('item', $lang, true);
    $Meta->printMetProperty();
    ?>
</head>
<body>
<?php
include_once ($_SERVER["DOCUMENT_ROOT"] . "/Includes/HTML/Navigation.php");
?>
<div class="content">
  <div class="item-desc-wrapper">
    <div class="item-desc">
      <p class="item-title"><?php echo $item->getName();?></p>
      <h1><?php echo $item->getPrize();?> ISK</h1>
      <div class="item-values">
        <p class="item-values-title"><?php echo $lang->JSON["item"]["sizes"]?></p><img src="/assets/icons/help_outline_gray.svg"/>
        <div class="item-value">
          <div class="item-value-size" size="M"><div></div><p>M</p></div>
          <div class="item-value-size" size="L"><div></div><p>L</p></div>
          <div class="item-value-size" size="XL"><div></div><p>XL</p></div>
        </div>
      </div>
      <div class="item-values">
        <p class="item-values-title"><?php echo $lang->JSON["item"]["colors"]?></p>
        <div class="item-value">
          <?php
          foreach ($item->getColors() as $color) {
            echo '<div class="item-value-color" color="' . $color . '"><div style="background-color: #' . getHex($color) . '"></div></div>';
          }
          ?>
        </div>
      </div>
      <div><button><?php echo $lang->JSON["item"]["add_to_cart"]?></button></div>
    </div>
  </div>
    <div class="item-image">
      <img src="/assets/items/1.png"/>
    </div>
</div>
<?php
include_once ($_SERVER["DOCUMENT_ROOT"] . "/Includes/HTML/Footer.php")
?>
<script src="/js/item.js"></script>
</body>
</html>
