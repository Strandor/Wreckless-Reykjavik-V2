<?php
require_once ($_SERVER["DOCUMENT_ROOT"] . "/Includes/Main.php");
require_once ($_SERVER["DOCUMENT_ROOT"] . "/Includes/Item/Item.php");
global $lang;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    $Meta = new MetaClass('home', $lang, true);
    $Meta->printMetProperty();
    ?>
</head>
<body>
<?php
include_once ($_SERVER["DOCUMENT_ROOT"] . "/Includes/HTML/Navigation.php");
?>
<div class="content">
    <div class="landing-switcher">
        <div class="landing-switcher-button" value="0"><div id="landing-switcher-fill"></div></div>
        <div class="landing-switcher-smalldot"></div>
        <div class="landing-switcher-smalldot"></div>
        <div class="landing-switcher-smalldot"></div>
        <div class="landing-switcher-button" value="1"></div>
        <div class="landing-switcher-smalldot"></div>
        <div class="landing-switcher-smalldot"></div>
        <div class="landing-switcher-smalldot"></div>
        <div class="landing-switcher-button" value="2"></div>
    </div>
    <div class="landing-content">
        <div class="landing-items">
            <div class="landing-items-item">
                <div class="landing-items-item-desc">
                  <?php
                  $item = new Item(2);
                  echo '<p>' . $item->getName() . '</p>';
                  echo '<h3>' . $item->getPrize() . ' ISK</h3>';
                  echo '<a href="/item.php?i=' . $item->getID() . '"><button>' . $lang->JSON["item"]["view_item"] . '</button></a>'
                  ?>
                </div>
                <img src="/assets/items/1.png" alt="Item"/>
            </div>
        </div>
    </div>
</div>
<?php
include_once ($_SERVER["DOCUMENT_ROOT"] . "/Includes/HTML/Footer.php")
?>
<script src="/js/home.js"></script>
</body>
</html>
