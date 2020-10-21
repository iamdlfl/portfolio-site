import '../styles/styles.css';
import MobileMenu from './modules/MobileMenu';
import SlideShow from './modules/SlideShow';

new MobileMenu();
new SlideShow();

if (module.hot) {
    module.hot.accept();
}