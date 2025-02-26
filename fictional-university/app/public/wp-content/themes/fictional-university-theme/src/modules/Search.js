import $ from 'jquery';
class Search {
  // 1. describe and create/initiate our object
  constructor(){
    // this.name = "Jane";
    // this.eyeColor = "green";
    // this.head = {};
    // this.brain = {};
    this.resultDiv = $("#search-overlay__result");
    this.openButton= $(".js-search-trigger");
    this.closeButton= $(".search-overlay__close");
    this.searchOverlay = $(".search-overlay");
    this.searchField = $('#search-term');
    this.events();
    this.isOverlayOpen = false;
    this.isSpinnerVisible = false;
    this.previousValue;
    this.typingTimer; 


  }
  // 2. events
  // on this.head feels cold, wearsHat
  // on this.brain feels hot, goingSwimming
  events(){
    this.openButton.on('click', this.openOverlay.bind(this));
    this.closeButton.on('click', this.closeOverlay.bind(this));
    $(document).on("keydown", this.keyPressDispatcher.bind(this));
    this.searchField.on("keyup", this.typingLogic.bind(this));
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
    if(e.keyCode === 83 && !this.isOverlayOpen && !$("input, textarea").is(':focus') ){
      this.openOverlay();
      console.log('open');
    }
    if(e.keyCode === 27 && this.isOverlayOpen ){
      this.closeOverlay();
      console.log('close');
    }
  }
  typingLogic(e){
    if(this.searchField.val() != this.previousValue){
      clearTimeout(this.typingTimer);    
      if(this.searchField.val()){

        if(!this.isSpinnerVisible){
          this.resultDiv.html('<div class="spinner-loader"></div>');
          this.isSpinnerVisible = true;
        }
       this.typingTimer= setTimeout(this.getResult.bind(this), 1500);
      }else{
        this.resultDiv.html('');
        this.isSpinnerVisible = false;
      }
    }
   this.previousValue = this.searchField.val();
  }
  getResult() {
    // this.resultDiv.html("Imagine real search result here....");
    // this.isSpinnerVisible = false;
    $.getJSON('http://fictional-university.local/wp-json/wp/v2/posts?search='+ this.searchField.val(), (posts)=>{
      alert(posts[0].title.rendered);
    })
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
// class Search {
//   // 1. Describe and create/initiate our object
//   constructor() {
//     // Select elements using vanilla JavaScript
//     this.resultDiv = document.getElementById("search-overlay__result");
//     this.openButton = document.querySelector(".js-search-trigger");
//     this.closeButton = document.querySelector(".search-overlay__close");
//     this.searchOverlay = document.querySelector(".search-overlay");
//     this.searchField = document.getElementById("search-term");

//     // Initialize properties
//     this.isOverlayOpen = false;
//     this.isSpinnerVisible = false;
//     this.previousValue = "";
//     this.typingTimer = null;

//     // Bind event listeners
//     this.events();
//   }

//   // 2. Events
//   events() {
//     // Add event listeners using vanilla JavaScript
//     this.openButton.addEventListener("click", () => this.openOverlay());
//     this.closeButton.addEventListener("click", () => this.closeOverlay());
//     document.addEventListener("keydown", (e) => this.keyPressDispatcher(e));
//     this.searchField.addEventListener("keyup", (e) => this.typingLogic(e));
//   }

//   // 3. Methods (functions, actions...)
//   openOverlay() {
//     this.searchOverlay.classList.add("search-overlay--active");
//     document.body.classList.add("body-no-scroll");
//     this.isOverlayOpen = true;
//   }

//   closeOverlay() {
//     this.searchOverlay.classList.remove("search-overlay--active");
//     document.body.classList.remove("body-no-scroll");
//     this.isOverlayOpen = false;
//   }

//   keyPressDispatcher(e) {
//     // Open overlay if 'S' key is pressed and no input/textarea is focused
//     if (e.keyCode === 83 && !this.isOverlayOpen && !document.activeElement.matches("input, textarea")) {
//       this.openOverlay();
//       console.log("open");
//     }

//     // Close overlay if 'Esc' key is pressed
//     if (e.keyCode === 27 && this.isOverlayOpen) {
//       this.closeOverlay();
//       console.log("close");
//     }
//   }

//   typingLogic(e) {
//     if (this.searchField.value !== this.previousValue) {
//       clearTimeout(this.typingTimer);

//       if (this.searchField.value) {
//         if (!this.isSpinnerVisible) {
//           this.resultDiv.innerHTML = '<div class="spinner-loader"></div>';
//           this.isSpinnerVisible = true;
//         }

//         this.typingTimer = setTimeout(() => this.getResult(), 1500);
//       } else {
//         this.resultDiv.innerHTML = "";
//         this.isSpinnerVisible = false;
//       }
//     }

//     this.previousValue = this.searchField.value;
//   }

//   getResult() {
//     this.resultDiv.innerHTML = "Imagine real search result here....";
//     this.isSpinnerVisible = false;
//   }
// }


export default Search;