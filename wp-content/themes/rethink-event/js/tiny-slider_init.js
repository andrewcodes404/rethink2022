// import { tns } from '/tiny-slider.js';

const carouselsSpeakers = document.querySelector('.b-carousel--speakers')
const carouselsPartners = document.querySelector('.b-carousel--partners')
const carouselsSponsors = document.querySelector('.b-carousel--sponsors')
const carouselsAdvCom = document.querySelector('.b-carousel--adv-com')


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


// var index = +1
// var newClass = `b-carousel--all-in-one${index}`
// carousel.classList.add(newClass)

const carousel1 = document.querySelector('.b-carousel--all-in-one1')
const carousel2 = document.querySelector('.b-carousel--all-in-one2')
const carousel3 = document.querySelector('.b-carousel--all-in-one3')
const carousel4 = document.querySelector('.b-carousel--all-in-one4')
const carousel5 = document.querySelector('.b-carousel--all-in-one5')
const carousel6 = document.querySelector('.b-carousel--all-in-one6')
const carousel7 = document.querySelector('.b-carousel--all-in-one7')


if (carousel1) {
  var slider = tns({
    container: '.b-carousel--all-in-one1',
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



if (carousel2) {
  var slider = tns({
    container: '.b-carousel--all-in-one2',
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



if (carousel3) {
  var slider = tns({
    container: '.b-carousel--all-in-one3',
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



if (carousel4) {
  var slider = tns({
    container: '.b-carousel--all-in-one4',
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



if (carousel5) {
  var slider = tns({
    container: '.b-carousel--all-in-one5',
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



if (carousel6) {
  var slider = tns({
    container: '.b-carousel--all-in-one6',
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



if (carousel7) {
  var slider = tns({
    container: '.b-carousel--all-in-one7',
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
