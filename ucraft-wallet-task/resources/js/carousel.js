import Siema from 'siema';

const carousel = document.querySelector('.partners-carousel');
const next = document.querySelector('.next-partner');

const partnersCarousel = carousel ? new Siema({
  selector: '.partners-carousel',
  duration: 200,
  easing: 'ease-out',
  perPage: {
    320: 2,
    540: 3,
    800: 4, 
    990: 5,
  },
  startIndex: 0,
  draggable: true,
  multipleDrag: true,
  threshold: 20,
  loop: true,
  rtl: false,
  onInit: () => {},
  onChange: () => {},
}) : null;

if (next) {
  next.addEventListener('click', () => partnersCarousel.next(1));
}