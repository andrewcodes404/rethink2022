// import { tns } from '/tiny-slider.js';

const carouselsSpeakers = document.querySelector('.b-carousel--speakers')
const carouselsPartners = document.querySelector('.b-carousel--partners')
const carouselsSponsors = document.querySelector('.b-carousel--sponsors')
const carouselsAdvCom = document.querySelector('.b-carousel--adv-com')

const carousel_all_in_one = document.querySelector('.b-carousel--all-in-one')

if (carouselsSpeakers) {

  var slider = tns({
    container: '.b-carousel--speakers',
    items: 1,
    swipeAngle: false,
    speed: 600,

    nav: false,
    controls: true,
    controlsPosition: "top",
    controlsText: ["&lt;", "&gt;"],
    arrowKeys: true,

    autoplay: true,
    autoplayButtonOutput: false,
    autoplayTimeout: 1500,

    loop: true,
    rewind: false,


    responsive: {

      500: {
        items: 2
      },
      700: {
        items: 3
      },
      900: {
        items: 4
      },

    }

  });

}

if (carouselsPartners) {

  var slider = tns({
    container: '.b-carousel--partners',
    items: 1,
    // swipeAngle: false,
    speed: 600,
    slideBy: 1,
    nav: false,
    controls: true,
    controlsPosition: "top",
    controlsText: ["&lt;", "&gt;"],
    arrowKeys: true,

    autoplay: true,
    autoplayButtonOutput: false,
    autoplayTimeout: 1500,

    loop: true,
    rewind: false,

    responsive: {

      500: {
        items: 2
      },
      700: {
        items: 3
      },
      900: {
        items: 4
      },

    }

  });

}

if (carouselsSponsors) {

  var slider = tns({
    container: '.b-carousel--sponsors',
    items: 1,
    swipeAngle: false,
    speed: 600,

    nav: false,
    controls: true,
    controlsPosition: "top",
    controlsText: ["&lt;", "&gt;"],
    arrowKeys: true,

    autoplay: true,
    autoplayButtonOutput: false,
    autoplayTimeout: 1500,

    loop: true,
    rewind: false,


    responsive: {

      500: {
        items: 2
      },
      700: {
        items: 3
      },
      900: {
        items: 4
      },

    }

  });

}

if (carouselsAdvCom) {

  var slider = tns({
    container: '.b-carousel--adv-com',
    items: 1,
    swipeAngle: false,
    speed: 600,
    nav: false,
    controls: true,
    controlsPosition: "top",
    controlsText: ["&lt;", "&gt;"],
    arrowKeys: true,
    autoplay: true,
    autoplayButtonOutput: false,
    autoplayTimeout: 1500,
    loop: true,
    rewind: false,
    responsive: {

      500: {
        items: 2
      },
      700: {
        items: 3
      },
      900: {
        items: 4
      },

    }

  });

}


if (carousel_all_in_one) {

  var slider = tns({
    container: '.b-carousel--all-in-one',
    items: 1,
    swipeAngle: false,
    speed: 600,

    nav: false,
    controls: true,
    controlsPosition: "top",
    controlsText: ["&lt;", "&gt;"],
    arrowKeys: true,

    autoplay: true,
    autoplayButtonOutput: false,
    autoplayTimeout: 1500,

    loop: true,
    rewind: false,


    responsive: {

      500: {
        items: 2
      },
      700: {
        items: 3
      },
      900: {
        items: 4
      },

    }

  });

}
