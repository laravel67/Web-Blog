const swiper = new Swiper('.mySwiper', {
  slidesPerView: 1.5,
  spaceBetween: 20,
  centeredSlides: true,
  loop: true,
  loopedSlides: 3,
  initialSlide: 1,
  autoplay: {
    delay: 3000, // Ganti delay sesuai kebutuhan (3000ms = 3 detik)
    disableOnInteraction: false, // Tetap autoplay meskipun user interaksi
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
      spaceBetween: 10,
    },
    768: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
  },
  on: {
    beforeInit: function () {
      const swiperContainer = document.querySelector('.mySwiper .swiper-wrapper');
      const slides = swiperContainer.querySelectorAll('.swiper-slide');

      // Duplikat slide secara manual
      if (slides.length === 3) {
        slides.forEach((slide) => {
          const clone = slide.cloneNode(true);
          swiperContainer.appendChild(clone);
        });
      }
    },
  },
});
