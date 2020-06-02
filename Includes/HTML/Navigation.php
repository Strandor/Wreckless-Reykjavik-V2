<div class="navigation">
    <div class="navigation-left">
        <a href="/"><img src="/assets/logo.svg" alt="Wreckless Reykjavík logo"/></a>
        <div class="navigation-links">
            <a><?php echo $lang->JSON["navigation"]["men"] ?></a>
            <a><?php echo $lang->JSON["navigation"]["women"] ?></a>
        </div>
    </div>
    <div class="navigation-right">
        <div class="navigation-search">
            <img src="/assets/icons/navigation/search_fill_black.svg" alt="menu-search" id="navigation-search"/>
            <input type="text" spellcheck="false" placeholder="<?php echo $lang->JSON["navigation"]["search"] ?>" id="navigation-search-input" style="display: none"/>
            <div class="navigation-search-results" id="search-results"></div>
        </div>
        <a href="/cart.php">
            <div class="navigation-cart">
                <img src="/assets/icons/navigation/cart_fill_black.svg" alt="menu-cart"/>
                <div class="navigation-cart-quantity">
                    <p>1</p>
                </div>
            </div>
        </a>
        <div class="navigation-burger" id="navigation-burger">
            <div class="navigation-burger-line"></div>
            <div class="navigation-burger-line"></div>
            <div class="navigation-burger-line"></div>
        </div>
        <div class="navigation-language" id="navigation-language">
            <img src="/assets/icons/navigation/translate_fill_black.svg"/>
            <p><?php echo $lang->language_native?></p>
            <img src="/assets/icons/navigation/arrow_fill_black.svg"/>
        </div>
        <div class="navigation-language-selector" id="navigation-language-selector" style="display: none">
            <div class="navigation-language-selector-arrow"></div>
            <div class="navigation-language-selector-values" id="navigation-language-selector-values">
                <?php
                foreach ($languages as $value) {
                    echo '<p value="' . $value->language_short . '">' . $value->language_native .'</p>';
                }
                ?>
            </div>
        </div>
        <div class="navigation-burger-menu">
            <div class="navigation-burger-menu-wrapper">
                <div class="navigation-burger-menu-link">
                    <a><?php echo $lang->JSON["navigation"]["men"] ?></a>
                </div>
                <div class="navigation-burger-menu-link">
                    <a><?php echo $lang->JSON["navigation"]["women"] ?></a>
                </div>
                <div class="navigation-burger-menu-link">
                  <div class="navigation-burger-menu-link-collapse">
                    <img src="/assets/icons/navigation/translate_fill_black.svg"/>
                    <a><?php echo $lang->language_native ?></a>
                    <img src="/assets/icons/navigation/arrow_fill_black.svg" class="navigation-burger-menu-link-arrow"/>
                  </div>
                  <div class="navigation-burger-menu-link-sub" id="navigation-burger-menu-link-sub" style="max-height: 0px;">
                        <?php
                        foreach ($languages as $value) {
                            echo '<p value="' . $value->language_short . '">' . $value->language_native .'</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
