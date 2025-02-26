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
    this.searchField = $('#search-term');
    this.events();
    this.isOverlayOpen = false;
    this.typingTimer; 


  }
  // 2. events
  // on this.head feels cold, wearsHat
  // on this.brain feels hot, goingSwimming
  events(){
    this.openButton.on('click', this.openOverlay.bind(this));
    this.closeButton.on('click', this.closeOverlay.bind(this));
    $(document).on("keydown", this.keyPressDispatcher.bind(this));
    this.searchField.on("keydown", this.typingLogic.bind(this));
  }

  // 3.methods (function, action ...)
  // goingSwimming(){}
  // wearsHat(){}
  openOverlay(){
    this.searchOverlay.addClass("search-overlay--active");
    $("body").addClass("body-no-scroll");
    this.isOverlayOpen = true;
  }
  closeOverlay(){
    this.searchOverlay.removeClass("search-overlay--active");
    $("body").removeClass("body-no-scroll");
    this.isOverlayOpen = false;
  }
  keyPressDispatcher(e){
    // console.log(e);
    // console.log(e.keyCode);
    if(e.keyCode === 83 && !this.isOverlayOpen ){
      this.openOverlay();
      console.log('open');
    }
    if(e.keyCode === 27 && this.isOverlayOpen ){
      this.closeOverlay();
      console.log('close');
    }
  }
  typingLogic(){
    clearTimeout(this.typingTimer);
   this.typingTimer= setTimeout(() => {
 console.log("lsdjflsdjfljlsjlsd")
    }, 2000);
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
//     this.isOverlayOpen = false;

//   }
//   // 2. events
//   // on this.head feels cold, wearsHat
//   // on this.brain feels hot, goingSwimming
//   events(){
//     this.openButton.addEventListener('click', ()=>this.openOverlay());
//     this.closeButton.addEventListener('click', ()=>this.closeOverlay());
//     document.addEventListener('keydown', ()=>this.keyPressDispatcher());
//   }

//   // 3.methods (function, action ...)
//   // goingSwimming(){}
//   // wearsHat(){}
//   openOverlay(){
  //     this.searchOverlay.classList.add("search-overlay--active");
  //     document.querySelector("body").classList.add("search-overlay--active");
  // this.isOverlayOpen = true;
  //   }
  //   closeOverlay(){
    //     this.searchOverlay.classList.remove("search-overlay--active");
    //     document.querySelector("body").classList.remove("search-overlay--active");
    // this.isOverlayOpen = false;

//   }
//   keyPressDispatcher(){
// console.log(e);
    // console.log(e.keyCode);
    // if(e.keyCode === 83 && !this.isOverlayOpen ){
    //   this.openOverlay();
    //   console.log('open');
    // }
    // if(e.keyCode === 27 && this.isOverlayOpen ){
    //   this.closeOverlay();
    //   console.log('close');
    // }

//   }
// }

export default Search;