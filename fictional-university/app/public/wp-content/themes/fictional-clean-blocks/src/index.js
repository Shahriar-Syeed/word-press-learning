import "../css/style.scss"

// Our modules / classes
import MobileMenu from "./modules/MobileMenu";
import HeroSlider from "./modules/HeroSlider";
import Search from "./modules/Search";
import MyNotes from "./modules/MyNotes";
import Like from "./modules/Like";

// Instantiate a new object using our modules/classes
if(document.querySelector(".site-header__menu")){
  const mobileMenu = new MobileMenu();
}
const heroSlider = new HeroSlider();
const search = new Search();
const myNotes = new MyNotes();
const like = new Like();

