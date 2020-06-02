var sizeSelectedElement;
var selectedSize;

function sizeButtonAnimation(element) {
  if(sizeSelectedElement != null) {
    anime({
        targets: sizeSelectedElement.childNodes[1],
        color: '#000',
        duration: 300,
        easing: 'easeInOutCirc'
    });
    anime({
        targets: sizeSelectedElement.childNodes[0],
        width: 0,
        height: 0,
        borderRadius: '50%',
        duration: 300,
        easing: 'easeInOutCirc'
    });
  }

  sizeSelectedElement = element;
  selectedSize = element.getAttribute("size");

  anime({
      targets: element.childNodes[1],
      color: '#fff',
      duration: 300,
      easing: 'easeInOutCirc'
  });
  anime({
      targets: element.childNodes[0],
      width: '100%',
      height: '100%',
      borderRadius: 0,
      duration: 300,
      easing: 'easeInOutCirc'
  });
}

var colorSelectedElement;
function colorButtonAnimation(element) {
  if(colorSelectedElement != null) {
    anime({
        targets: colorSelectedElement.childNodes[0],
        height: '30px',
        width: '30px',
        duration: 300,
        easing: 'easeInOutCirc'
    });
  }

  colorSelectedElement = element;

  anime({
      targets: element.childNodes[0],
      height: '45px',
      width: '45px',
      duration: 300,
      easing: 'easeInOutCirc'
  });
}

var sizeButton = document.getElementsByClassName("item-value-size");
for (var i = 0; i < sizeButton.length; i++) {
    sizeButton[i].onclick = function() {
      sizeButtonAnimation(this);
    }
}

var colorButton = document.getElementsByClassName("item-value-color");
for (var i = 0; i < colorButton.length; i++) {
    colorButton[i].onclick = function() {
      colorButtonAnimation(this);
    }
}
