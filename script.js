var currentSlide = 0;
showSlides(0);

function showSlides(n) {
  var slides = document.getElementsByClassName('slide');
  if (n < 0) {
    n = slides.length - 1;
  }
  if (n == slides.length) {
    n = 0;
  }
  for (var i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slides[n].style.display = "flex";
  currentSlide = n;
}

function clickRight() {
  currentSlide++;
  showSlides(currentSlide);
}

function clickLeft() {
  currentSlide--;
  showSlides(currentSlide);
}

function showModal() {
  document.getElementById('modal').style.display = "flex";
}

function closeModal() {
  document.getElementById('modal').style.display = "none";
}