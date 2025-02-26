import $ from 'jquery';
class Search {
  // 1. describe and create/initiate our object
  constructor(){
    // this.name = "Jane";
    // this.eyeColor = "green";
    // this.head = {};
    // this.brain = {};
    this.openButton= $(".js-search-trigger");
    this.closeButton= $(".search-overlay__close");
    this.searchOverlay = $(".search-overlay");
    this.events();

  }
  // 2. events
  // on this.head feels cold, wearsHat
  // on this.brain feels hot, goingSwimming
  events(){
    this.openButton.on('click', this.openOverlay.bind(this));
    this.closeButton.on('click', this.closeOverlay.bind(this));
  }

  // 3.methods (function, action ...)
  // goingSwimming(){}
  // wearsHat(){}
  openOverlay(){
    this.searchOverlay.addClass("search-overlay--active");
    $("body").addClass("body-no-scroll");
  }
  closeOverlay(){
    this.searchOverlay.removeClass("search-overlay--active");
    $("body").removeClass("body-no-scroll");

  }
}

// class Search {
//   // 1. describe and create/initiate our object
//   constructor(){
//     // this.name = "Jane";
//     // this.eyeColor = "green";
//     // this.head = {};
//     // this.brain = {};
//     this.openButton= document.querySelector(".js-search-trigger");
//     this.closeButton= document.querySelector(".search-overlay__close");
//     this.searchOverlay = document.querySelector(".search-overlay");
//     this.events();

//   }
//   // 2. events
//   // on this.head feels cold, wearsHat
//   // on this.brain feels hot, goingSwimming
//   events(){
//     this.openButton.addEventListener('click', ()=>this.openOverlay());
//     this.closeButton.addEventListener('click', ()=>this.closeOverlay());
//   }

//   // 3.methods (function, action ...)
//   // goingSwimming(){}
//   // wearsHat(){}
//   openOverlay(){
//     this.searchOverlay.classList.add("search-overlay--active");
//     document.querySelector("body").classList.add("search-overlay--active");
//   }
//   closeOverlay(){
  //     this.searchOverlay.classList.remove("search-overlay--active");
  //     document.querySelector("body").classList.remove("search-overlay--active");

//   }
// }

export default Search;