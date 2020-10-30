//--------------------------------------------------------------
// SLICK SLIDER
// https://kenwheeler.github.io/slick/
//--------------------------------------------------------------

import 'slick-carousel';

$('.slick-slider').slick({
  dots: true,
  infinite: true,
  autoplay: false,
  speed: 1000,
  autoplaySpeed: 1000,
  slidesToShow: 1,
  slidesToScroll: 1,
  pauseOnHover: false,
  fade: true,
  arrows: false,
});

// Filter slider buttons.
function filterSliderButtons() {
  const isTextNode = (_, el) => el.nodeType === Node.TEXT_NODE;

  $('.slick-slider .slick-prev')
    .append('<span class="fas fa-arrow-left"></span>')
    .addClass('button')
    .contents()
    .filter(isTextNode)
    .remove();
  $('.slick-slider .slick-next')
    .append('<span class="fas fa-arrow-right"></span>')
    .addClass('button')
    .contents()
    .filter(isTextNode)
    .remove();
}

// filterSliderButtons();
