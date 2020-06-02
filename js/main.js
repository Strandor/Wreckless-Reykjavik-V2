var inputSearch;
var previousJSON;

var searchMenuAnimationPlaying = false;
var searchInputOpen = false;
var playSearchInputAnimationAgain = false; // Check if the animation should be played again
function playSearchInputAnimation() {
    searchMenuAnimationPlaying = true;

    inputSearch.style.display = "block"; //Unhide the element

    if(!searchInputOpen) {
        inputSearch.focus();
        previousJSON = null;
    }

    anime({
        targets: '.navigation-search input',
        width: searchInputOpen ? 0 : '150px',
        paddingLeft: searchInputOpen ? 0 : '20px',
        paddingRight: searchInputOpen ? 0 : '20px',
        easing: searchInputOpen ? 'easeOutQuad' : 'easeOutExpo',
        duration: searchInputOpen ? 400 : 700
    }).complete = function () {
        searchInputOpen = !searchInputOpen;
        if(!searchInputOpen) {
            inputSearch.style.display = "none";
            inputSearch.value = "";
        }
        searchMenuAnimationPlaying = false;

        if(playSearchInputAnimationAgain) {
            playSearchInputAnimation();
            playSearchInputAnimationAgain = false;
        }
    };
}

function clearSearchResult() {
    document.getElementById("search-results").innerHTML = "";
}

/*
Function to check if animation is already playing.
If so play the animation again when the other animation is over
*/
function searchInputAnimationCheck(e) {
    if(!searchMenuAnimationPlaying) {
        playSearchInputAnimation();
        clearSearchResult();
    } else {
        playSearchInputAnimationAgain = true;
    }
}

var languageMenuOpen = false;
function playLanguageAnimation() {
    document.getElementsByClassName("navigation-language-selector")[0].style.display = languageMenuOpen ? "none" : "block";

    anime({
        targets: '.navigation-language-selector',
        opacity: languageMenuOpen ? 0 : 1,
        duration: 150,
        easing: 'easeInOutCirc'
    });

    anime({
        targets: '.navigation-language img:last-of-type',
        rotate: languageMenuOpen ? 0 : 180,
        duration: 700
    });

    languageMenuOpen = !languageMenuOpen;
}

var burgerMenuOpen = false;
function playBurgerMenuAnimation() {
  // Reset opacity
  if(!burgerMenuOpen) {
    anime({
        targets: '.navigation-burger-menu-link',
        opacity: 0,
        duration: 0,
    });
  }

    anime({
        targets: '.navigation-burger-line:first-child',
        rotate: burgerMenuOpen ? 0 : 45,
        width: burgerMenuOpen ? '20px' : '25px',
        translateY: burgerMenuOpen ? 0: 2,
        translateX: burgerMenuOpen ? 0 : 7,
        duration: 300,
        easing: 'easeInOutCirc'
    });

    anime({
        targets: '.navigation-burger-line:nth-child(2)',
        width: burgerMenuOpen ?  '15px' : 0,
        translateX: burgerMenuOpen ? 0 : -13,
        duration: 300,
        easing: 'easeInOutCirc'
    });

    anime({
        targets: '.navigation-burger-line:last-child',
        rotate: burgerMenuOpen ? 0 : -45,
        width: burgerMenuOpen ? '20px' : '25px',
        translateY: burgerMenuOpen ? 0 : -2,
        translateX: burgerMenuOpen ? 0 : 7,
        duration: 300,
        easing: 'easeInOutCirc'
    });

    anime({
        targets: '.navigation-burger-menu',
        maxHeight: burgerMenuOpen ? 0 : '2000px',
        duration: 300,
        easing: 'easeInOutCirc'
    }). complete = function() {
      if(!burgerMenuOpen) {
        closeAllBurgerMenuCollapse();
      }
    };

    anime({
        targets: '.navigation-burger-menu-link',
        opacity: 1,
        duration: 300,
        easing: 'easeInOutCirc',
        delay: anime.stagger(100, {direction: 'normal'})
    });

    burgerMenuOpen = !burgerMenuOpen;
}

function errorMessage(message) {
    var errorDiv = document.createElement("div");
    errorDiv.className = "info-message-box"
    errorDiv.innerHTML = "<img src=\"/assets/icons/error-outline.svg\"/><p>" + message  + "</p>"
    document.body.appendChild(errorDiv);

    anime({
        targets: errorDiv,
        keyframes: [
            {bottom: '20px'},
            {bottom: '-50px', delay: 5000},
        ],
        duration: 300,
        easing: 'easeOutCubic'
    }).complete = function() {
        errorDiv.remove();
    };
}

window.addEventListener('click', function(e){
    /*
     Check if the user clicked outside the box while the language menu is open.
     Also make sure he did not click on the language button to prevent the animation playing twice.
    */
    if ((!document.getElementById('navigation-language-selector').contains(e.target) && !document.getElementById('navigation-language').contains(e.target)) && languageMenuOpen){
        playLanguageAnimation();
    }
});

function onLanguageClick(value) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          var json = JSON.parse(this.responseText);
          if(json["error"] != null) {
              errorMessage(json["error"]);
          } else {
              location.reload();
          }
      }
  };
  xmlhttp.open("GET", "/API/SetLanguage.php?lang=" + value, true);
  xmlhttp.send();
}

function registerLanguageClick() {
    var el1 = document.getElementById('navigation-language-selector-values').children;
    for (var i = 0; i < el1.length; i++) {
        el1[i].onclick = function () {
          onLanguageClick(this.getAttribute("value"));
        }
    }

    var el2 = document.getElementById('navigation-burger-menu-link-sub').children;
    for (var i = 0; i < el2.length; i++) {
        el2[i].onclick = function () {
          onLanguageClick(this.getAttribute("value"));
        }
    }
}

function playBurgerMenuCollapse(el1, el2, open) {
  // TODO FIX
  anime({
      targets: el1,
      maxHeight: open ? "1000px" : 0,
      duration: 300,
      easing: 'easeInOutCirc'
  });

  anime({
      targets: el2,
      rotate: open ? 180 : 0,
      duration: 300,
      easing: 'easeInOutCirc'
  });
}

function closeAllBurgerMenuCollapse() {
  var el = document.getElementsByClassName("navigation-burger-menu-link-collapse");
  for (var i = 0; i < el.length; i++) {
    el[i].parentElement.getElementsByClassName("navigation-burger-menu-link-sub")[0].style.maxHeight = "0px";
    el[i].parentElement.getElementsByClassName("navigation-burger-menu-link-arrow")[0].style = "rotate(0deg)";
  }
}

function registerBurgerMenuClick() {
  var el = document.getElementsByClassName("navigation-burger-menu-link-collapse");
  for (var i = 0; i < el.length; i++) {
      el[i].onclick = function () {
        var pa = this.parentElement;
        playBurgerMenuCollapse(pa.getElementsByClassName("navigation-burger-menu-link-sub")[0], pa.getElementsByClassName("navigation-burger-menu-link-arrow")[0], pa.getElementsByClassName("navigation-burger-menu-link-sub")[0].style.maxHeight ==  "0px");
      }
    }
}

function addItemToSearchResult(id, name, prize) {
    var searchResult = document.getElementById("search-results");

    var searchResultLink = document.createElement("a");
    searchResultLink.href = "/item.php?i=" + id;

    var searchResultItem = document.createElement("div");
    searchResultItem.className = "navigation-search-results-item";;
    searchResultLink.appendChild(searchResultItem);

    var searchResultImg = document.createElement("img");
    searchResultImg.src = "/assets/items/1.PNG";
    searchResultItem.appendChild(searchResultImg);

    searchResultItem.innerHTML += "<div class='navigation-search-results-item-desc'><div class='navigation-search-results-item-desc-wrapper'><p>" + name + "</p>" + "<h3>" + prize + " ISK</h3></div></div>";

    searchResult.appendChild(searchResultLink);
}


function getSearchResults() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var json = JSON.parse(this.responseText);
            if(previousJSON == null || JSON.stringify(previousJSON) != JSON.stringify(json)) {
                clearSearchResult();
                if(json.length > 0) {
                    for(var i = 0; i < json.length; i++) {
                        addItemToSearchResult(json[i]["id"], json[i]["name"], json[i]["prize"]);
                    }
                }
                previousJSON = json;
            }
        }
    };
    xmlhttp.open("GET", "/API/Search.php?s=" + this.value, true);
    xmlhttp.send();
}

window.onload = function() {
    inputSearch = document.getElementById("navigation-search-input");

    inputSearch.addEventListener("focusout", function(e) {
      //setTimeout fixes issue with href click
      setTimeout(searchInputAnimationCheck, 50);
    });
    // Prevent that the search box animation plays twice while the window is not active
    window.addEventListener("focusout", function() {
        inputSearch.blur();
    });
    document.getElementById("navigation-language").onclick = playLanguageAnimation;
    document.getElementById("navigation-burger").onclick = playBurgerMenuAnimation;
    document.getElementById("navigation-search-input").addEventListener('input', getSearchResults);
    document.getElementById("navigation-search").onclick = function(e) {
      if(!searchInputOpen) {
          searchInputAnimationCheck();
      }
    };

    registerLanguageClick();
    registerBurgerMenuClick();
};

window.addEventListener("scroll", function() {
    if(this.scrollY <= 20) {
        anime({
            targets: '.navigation',
            boxShadow: '0 0 10px 0 rgba(0,0,0,0)',
            duration: 100,
            easing: 'easeInOutCirc'
        });
    } else {
        anime({
            targets: '.navigation',
            boxShadow: '0 0 10px 0 rgba(0,0,0,0.1)',
            duration: 100,
            easing: 'easeInOutCirc'
        });
    }
});
