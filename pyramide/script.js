window.onscroll = function() {hideHeader()};

function myFunction() {
    alert("Hello!");
}

function changeMouse(returnid) {
  document.getElementById(returnid).style.cursor="pointer";
}

var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}

function initializeHeader(title) {
  document.getElementById(title).classList.add("activeTab");
}

function hideHeader() {
  if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
    document.getElementById("KategorieHeader").className = "hideHeader";
  } else {
    document.getElementById("KategorieHeader").className = "";
  }
}
    
