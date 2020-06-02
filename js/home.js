function changeLandingButton(button_number) {
    var currButtonFill = document.getElementsByClassName("landing-switcher-button")[button_number];;
    var prevButtonFill = document.getElementById("landing-switcher-fill");

    // Check if the user clicked already clicked button
    if(currButtonFill.hasChildNodes()) {
        return;
    }

    prevButtonFill.id = null;
    anime({
        targets: prevButtonFill,
        width: 0,
        height: 0,
        opacity: 0.5,
        duration: 300,
        easing: 'easeInOutCirc'
    }).complete = function() {
        prevButtonFill.remove();
    };

    currButtonFill.innerHTML = "<div id=\"landing-switcher-fill\" style=\"height: 0; width: 0\"></div>";

    anime({
        targets: '#landing-switcher-fill',
        width: '15px',
        height: '15px',
        duration: 300,
        easing: 'easeInOutCirc'
    });
}

var landingButton = document.getElementsByClassName('landing-switcher-button');
for (var i = 0; i < landingButton.length; i++) {
    landingButton[i].onclick = function() {
        changeLandingButton(this.getAttribute("value"));
    }
}