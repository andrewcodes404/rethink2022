// Navigation --- Navigation --- Navigation --- 
// Navigation --- Navigation --- Navigation --- 
// Navigation --- Navigation --- Navigation --- 


const hamburger = document.querySelector('#hamburger')
const closeBtn = document.querySelector('#closeBtn')
const menu = document.querySelector('#nav__menu-mobile')
const mobMenuUl = menu.querySelector('ul')
const mobMenuUlLength = mobMenuUl.scrollHeight + "px"

hamburger.addEventListener('click', () => {

  menu.classList.remove('nav__menu-mobile--hide')
  menu.classList.add('nav__menu-mobile--show')
  mobMenuUl.style.maxHeight = mobMenuUlLength
  hamburger.classList.remove('nav__button--show')
  hamburger.classList.add('nav__button--hide')
  closeBtn.classList.remove('nav__button--hide')
  closeBtn.classList.add('nav__button--show')


})


closeBtn.addEventListener('click', () => {
  menu.classList.remove('nav__menu-mobile--show')
  menu.classList.add('nav__menu-mobile--hide')
  // mobMenuUl.style.maxHeight = "0px";
  closeBtn.classList.remove('nav__button--show')
  closeBtn.classList.add('nav__button--hide')
  hamburger.classList.remove('nav__button--hide')
  hamburger.classList.add('nav__button--show')
})


// desktop dropdown --- desktop dropdown --- desktop dropdown --- 
// desktop dropdown --- desktop dropdown --- desktop dropdown --- 
// desktop dropdown --- desktop dropdown --- desktop dropdown --- 


const navDesktop = document.querySelector('#nav__menu-desktop')

const menusWithSubMenu = navDesktop.querySelectorAll('.menu-item-has-children')

menusWithSubMenu.forEach(menuWithSubMenu => {
  menuWithSubMenu.addEventListener('mouseover', function () {
    const link = this.firstElementChild
    const submenu = this.querySelector("ul")
    const submenuHeight = submenu.scrollHeight + "px"
    link.style.backgroundColor = "green"
    submenu.style.maxHeight = submenuHeight;
  })


  menuWithSubMenu.addEventListener('mouseout', function () {
    const link = this.firstElementChild
    const submenu = this.querySelector("ul")
    submenu.style.maxHeight = "0";
    link.style.backgroundColor = "transparent"
  })

});



// aos --- aos --- aos --- aos --- aos --- 
// aos --- aos --- aos --- aos --- aos --- 
// aos --- aos --- aos --- aos --- aos --- 

const h2s = document.querySelectorAll('h2')

if (h2s) {
  h2s.forEach(h2 => {

    h2.classList.add('b-h2')
    h2.setAttribute("data-aos", "h2-heading");

  });
}


// old modals --- old modals --- old modals --- old modals --- 
// old modals --- old modals --- old modals --- old modals --- 
// old modals --- old modals --- old modals --- old modals --- 

const logos = document.querySelectorAll('.s-card__logo')

logos.forEach(logo => {
  logo.addEventListener('click', function () {
    this.nextElementSibling.classList.add("s-modal-wrapper--show")
  })
});


const modalWrappers = document.querySelectorAll('.s-modal-wrapper')


modalWrappers.forEach(modalWrapper => {
  modalWrapper.addEventListener('click', function (event) {
    event.stopPropagation();
    this.classList.remove("s-modal-wrapper--show")
  })
});

const modals = document.querySelectorAll('.s-modal')

modals.forEach(modal => {
  modal.addEventListener('click', function (event) {
    event.stopPropagation();
    // this.classList.remove("s-modal-wrapper--show")
  })
});


const modalCloseBtns = document.querySelectorAll('.s-modal__close-btn')

modalCloseBtns.forEach(modalCloseBtn => {
  modalCloseBtn.addEventListener('click', function (event) {
    event.stopPropagation();
    this.parentElement.parentElement.classList.remove("s-modal-wrapper--show")
  })
});


// modals --- modals --- modals --- modals --- 
// modals --- modals --- modals --- modals --- 
// modals --- modals --- modals --- modals --- 

const modalParents = document.querySelectorAll('.t-modal-parent')

modalParents.forEach(modalParent => {
  modalParent.addEventListener('click', function () {
    this.nextElementSibling.classList.add("t-modal-wrapper--show")
  })
});


const tmodalWrappers = document.querySelectorAll('.t-modal-wrapper')


tmodalWrappers.forEach(tmodalWrapper => {
  tmodalWrapper.addEventListener('click', function (event) {
    event.stopPropagation();
    this.classList.remove("t-modal-wrapper--show")
  })
});

const tmodals = document.querySelectorAll('.t-modal')

tmodals.forEach(tmodal => {
  tmodal.addEventListener('click', function (event) {
    event.stopPropagation();
    // this.classList.remove("s-modal-wrapper--show")
  })
});


const tmodalCloseBtns = document.querySelectorAll('.t-modal__close-btn')

tmodalCloseBtns.forEach(tmodalCloseBtn => {
  tmodalCloseBtn.addEventListener('click', function (event) {
    event.stopPropagation();
    this.parentElement.parentElement.classList.remove("t-modal-wrapper--show")
  })
});




//home-page pop-up
//home-page pop-up
//home-page pop-up
//home-page pop-up

const popUpWrapper = document.querySelector('#odoo-pop-wrapper')

if (popUpWrapper) {

  if (localStorage.getItem('popState') != 'shown') {
    setTimeout(() => {
      popUpWrapper.classList.add('odoo-pop-wrapper__show')
    }, 20000);
  }

  popUpWrapper.addEventListener('click', (e) => {
    e.stopPropagation()
    popUpWrapper.classList.remove('odoo-pop-wrapper__show')
  })

}


// oddo-form
// oddo-form
// oddo-form
// oddo-form
// oddo-form

function resizeIframe(obj) {
  obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
}

const oddoForms = document.querySelectorAll('.odoo-form')
if (oddoForms) {
  oddoForms.forEach(oddoForm => {
    oddoForm.style.height = oddoForm.scrollHeight + 'px';
  });

}



// programme accordion 

const accordItemButtons = document.querySelectorAll('.b-programme__session__top-bar')
const chevron = document.querySelector('.s-accordion-item__title-chevron')


accordItemButtons.forEach(button => {


  button.addEventListener('click', function () {
    const content = this.nextElementSibling
    const contentHeight = content.scrollHeight + "px"
    const chevron = this.querySelector('.b-programme__session__top-bar__chevron')
    if (content.classList.contains('b-programme__session__content--show')) {
      this.nextElementSibling.style.maxHeight = "0px"
      this.nextElementSibling.classList.remove('b-programme__session__content--show')
      chevron.classList.remove('b-programme__session__top-bar__chevron--rotate')

    } else {
      this.nextElementSibling.style.maxHeight = contentHeight
      this.nextElementSibling.classList.add('b-programme__session__content--show')
      chevron.classList.add('b-programme__session__top-bar__chevron--rotate')
    }

  })
});




// SpeakersList --- SpeakersList --- SpeakersList --- SpeakersList --- 
// SpeakersList --- SpeakersList --- SpeakersList --- SpeakersList --- 
// SpeakersList --- SpeakersList --- SpeakersList --- SpeakersList --- 

const makeFilterActive = (filter) => {
  console.log('makeFilterActive FN running');
  const childrenParent = filter.parentElement
  const children = childrenParent.querySelectorAll('button')
  children.forEach(child => {
    child.classList.remove("filter-button--active")
  });
  filter.classList.add("filter-button--active")
}



const hideShowSpeakers = () => {

  const sessionUls = document.querySelectorAll(".sessionUl");
  const activeFilters = document.querySelectorAll('.filter-button--active')
  let sessionDay = "all"
  let sessionLocation = "all"

  // Run through the filters and set the day and ocation vars
  if (activeFilters) {
    activeFilters.forEach(activeFilter => {

      if (activeFilter.getAttribute('data-day')) {
        sessionDay = activeFilter.getAttribute('data-day');
      }

      if (activeFilter.getAttribute('data-location')) {
        sessionLocation = activeFilter.getAttribute('data-location')
      }
    });

    // match the vars to the li data of each speker
    if (sessionUls) {
      sessionUls.forEach(sessionUl => {
        const lis = sessionUl.querySelectorAll('li')
        let show = false;
        if (lis) {
          lis.forEach(li => {
            if (sessionDay === "all" && sessionLocation === "all") {
              show = true;
            }

            if (sessionDay === "all" && li.classList.contains(sessionLocation)) {
              show = true;
            }


            if (li.classList.contains(sessionDay) && sessionLocation === "all") {
              show = true;
            }


            if (li.classList.contains(sessionDay) && li.classList.contains(sessionLocation)) {
              show = true;
            }
          });
        }

        //Add hide class to speakers that don't match
        const wrapper = sessionUl.parentElement
        if (!show) {
          wrapper.classList.add('b-speakers-list__speaker--hide')
        } else {
          wrapper.classList.remove('b-speakers-list__speaker--hide')
        }

      });
    }
  }
}

const filterButtons = document.querySelectorAll('.filter-button')

if (filterButtons) {

  filterButtons.forEach(filterButton => {
    filterButton.addEventListener('click', () => {
      console.log('addEventListener Fn 🏃🏻‍♂️');
      console.log('👻filter button clicked is..', filterButton);

      //add active class to button remove active class from others in group
      makeFilterActive(filterButton);

      // find matching speakers in list  
      hideShowSpeakers()


    })
  });
}
