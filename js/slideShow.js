var slideIndex = 1;
var timer = setTimeout("carousel()", 1500);
showDivs(slideIndex);

function runShow() {
    carousel();
}

function stopShow() {
    clearTimeout(timer);
}

function plusDivs(n) {
    showDivs(slideIndex += n);
}

function currentDiv(n) {
    showDivs(slideIndex = n);
}

function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("demo");
    if (n > x.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = x.length
    }
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" slide-w3", "");
    }
    x[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " slide-w3";
}

function carousel() {
    var i;
    var dots = document.getElementsByClassName("demo");
    var x = document.getElementsByClassName("mySlides");

    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" slide-w3", "");
    }
    slideIndex++;
    if (slideIndex > x.length) {
        slideIndex = 1
    }
    x[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " slide-w3";
    // setTimeout(carousel, 2000); 
    timer = setTimeout("carousel()", 1500);
}
