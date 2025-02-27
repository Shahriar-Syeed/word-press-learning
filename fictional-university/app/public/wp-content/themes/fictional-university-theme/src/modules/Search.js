import $ from 'jquery';
class Search {
  // 1. describe and create/initiate our object
  constructor(){
    // this.name = "Jane";
    // this.eyeColor = "green";
    // this.head = {};
    // this.brain = {};
    this.addSearchHTML();
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
    setTimeout(() => 
      this.searchField.focus(), 301);
    this.isOverlayOpen = true;
  }
  closeOverlay(){
    this.searchOverlay.removeClass("search-overlay--active");
    $("body").removeClass("body-no-scroll");
    this.isOverlayOpen = false;
    this.searchField.val('');
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
       this.typingTimer= setTimeout(this.getResult.bind(this), 750);
      }else{
        this.resultDiv.html('');
        this.isSpinnerVisible = false;
      }
    }
   this.previousValue = this.searchField.val();
  }
  getResult() {

    $.when(
      $.getJSON(universityData.root_url + '/wp-json/wp/v2/posts?search='+ this.searchField.val()), 
      $.getJSON(universityData.root_url + '/wp-json/wp/v2/pages?search='+ this.searchField.val())
    ).then((posts, pages)=>{
       const combinedResult= posts[0].concat(pages[0]);
      this.resultDiv.html(`<h2 class="search-overlay__section-title">General Information</h2>
        <ul class="link-list min-list">
        ${combinedResult.length ? '<ul class="link-list min-list">':'<p>No general Information matches that search.</p>'}
        ${combinedResult.map(item=>`<li><a href='${item.link}'>${item.title.rendered}</li>`).join('')}       
        ${combinedResult.length ?'</ul>':''}`);
        this.isSpinnerVisible = false;
    })
    // this.resultDiv.html("Imagine real search result here....");
    // this.isSpinnerVisible = false;
    // $.getJSON(universityData.root_url + '/wp-json/wp/v2/posts?search='+ this.searchField.val(), (posts)=>{
      // // const testArray = ['red', 'blue']
      // this.resultDiv.html(`<h2 class="search-overlay__section-title">General Information</h2>
      //   <ul class="link-list min-list">
      //   ${posts.length ? '<ul class="link-list min-list">':'<p>No general Information matches that search.</p>'}
      //   ${posts.map(item=>`<li><a href='${item.link}'>${item.title.rendered}</li>`).join('')}       
      //   ${posts.length ?'</ul>':''}`);
      //   // alert(posts[0].title.rendered);
      // $.getJSON(universityData.root_url + '/wp-json/wp/v2/pages?search='+ this.searchField.val(), pages=>{
      //   const combinedResult= posts.concat(pages);
      // this.resultDiv.html(`<h2 class="search-overlay__section-title">General Information</h2>
      //   <ul class="link-list min-list">
      //   ${combinedResult.length ? '<ul class="link-list min-list">':'<p>No general Information matches that search.</p>'}
      //   ${combinedResult.map(item=>`<li><a href='${item.link}'>${item.title.rendered}</li>`).join('')}       
      //   ${combinedResult.length ?'</ul>':''}`);
      //   this.isSpinnerVisible = false;
      // });
      // });
  }
  addSearchHTML(){
    $("body").append(`
      <div class="search-overlay">
  <div class="search-overlay__top">
    <div class="container">
      <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
      <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term" autocomplete="off">
      <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
    </div>
  </div>
  <div class="container">
    <div id="search-overlay__result"></div>
  </div>
</div>`)
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