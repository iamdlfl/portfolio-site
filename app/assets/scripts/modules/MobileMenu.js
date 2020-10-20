class MobileMenu {
    constructor() {
        this.menuIcon = document.querySelector('.navbar__toggler');
        this.menuContent = document.querySelector('.navbar__collapse');
        this.menuLinks = document.querySelectorAll('.nav__item');
        this.menuNavlist = document.querySelector('.navbar__nav');
        this.menu = document.querySelector('.navbar');
        this.events();
    }

    events() {
        this.menuIcon.addEventListener('click', () => this.toggleTheMenu());
    }

    toggleTheMenu() {
        this.menuContent.classList.toggle('navbar__collapse--expanded');
        this.menuLinks.forEach((el) => {
            el.classList.toggle('nav__item--expanded');
        });
        this.menuNavlist.classList.toggle('navbar__nav--expanded');
        this.menu.classList.toggle('navbar--expanded');
        this.menuIcon.classList.toggle('navbar__toggler--close-x');

    }
}

export default MobileMenu;