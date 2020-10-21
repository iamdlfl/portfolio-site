import '../styles/styles.css';
import MobileMenu from './modules/MobileMenu';
import SlideShow from './modules/SlideShow';
import CodeBlock from './modules/CodeBlock';
import Collapser from './modules/Collapser';

// Every page will have a menu
new MobileMenu();

// Check if these exist
let collapser = document.querySelector('.collapser');
let codeBlockTest = document.querySelector('.code-block');
let slideShowTest = document.querySelector('.slide-show');

// If they exist implement them
if (collapser != null) {
    new Collapser();
}
if (codeBlockTest != null) {
    new CodeBlock();
}
if (slideShowTest != null) {
    new SlideShow();
}

if (module.hot) {
    module.hot.accept();
}