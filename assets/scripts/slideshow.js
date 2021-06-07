var slideIndexes = { // colocar todos os slideshows das páginas 
  "perfilSlide" : 1,
   "compareSlide" : 1,
   "desafiosSlide" : 1,
   "atlasSlide" : 1,
   "exploreSlide" : 1,
   "hometopSlide" : 1
};
console.log("slideIndexes", slideIndexes);
console.log("typeof", typeof(slideIndexes));
showSlides(1, "perfilSlide", "dot");
showSlides(1, "compareSlide" , "dot1");
showSlides(1, "desafiosSlide" , "dot2");
showSlides(1, "atlasSlide" , "dot3");
showSlides(1, "exploreSlide" , "dot4");
showSlides(1, "hometopSlide" , "dot5");

function plusSlides(n, slideClass, dotClass) {
  showSlides(slideIndexes[slideClass] += n, slideClass, dotClass);
}

function currentSlide(n, slideClass, dotClass) {
  showSlides(slideIndexes[slideClass] = n, slideClass, dotClass);
}

function showSlides(n, slideClass, dotClass) {
  var i;
  var slides = document.getElementsByClassName(slideClass);
  var dots = document.getElementsByClassName(dotClass);
  if (n > slides.length) {slideIndexes[slideClass] = 1}    
  if (n < 1) { slideIndexes[slideClass] = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndexes[slideClass]-1].style.display = "block";  
  dots[slideIndexes[slideClass]-1].className += " active";
}