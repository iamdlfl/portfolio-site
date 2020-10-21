class SlideShow {
    constructor() {
        this.slides = document.querySelectorAll('.slide-show__item');
        this.slideShow = document.querySelector('.slide-show');
        this.goBack = document.querySelector('.slide-show__control--prev');
        this.goForward = document.querySelector('.slide-show__control--next');
        this.events();
    }

    events() {
        var timer = window.setInterval(() => this.activateNextSlide(), 6000);
        this.goForward.addEventListener('click', () => {
            window.clearInterval(timer);
            this.activateNextSlide();
            timer = window.setInterval(() => this.activateNextSlide(), 6000);
        });
        this.goBack.addEventListener('click', () => {
            window.clearInterval(timer);
            this.activatePreviousSlide();
            timer = window.setInterval(() => this.activateNextSlide(), 6000);
        });
    }

    activateNextSlide() {
        let next = false;
        let slidesLength = this.slides.length;
        let position = 0;
        this.slides.forEach((el) => {
            if (el.classList.contains('slide-show__item--active')) {
                el.classList.remove('slide-show__item--active');
                if (position == (slidesLength - 1)) {
                    this.slides[0].classList.add('slide-show__item--active');
                } else {
                    next = true;
                }
            } else if (next) {
                next = false;
                el.classList.add('slide-show__item--active');
            }
            position++;
        });
    }

    activatePreviousSlide() {
        let slidesLength = this.slides.length;
        let position = 0;
        let activePosition;
        this.slides.forEach((el) => {
            if (el.classList.contains('slide-show__item--active')) {
                el.classList.remove('slide-show__item--active');
                activePosition = position;
            }
            position++;
        })
        if (activePosition == 0) {
            this.slides[slidesLength - 1].classList.add('slide-show__item--active');
        } else {
            this.slides[activePosition - 1].classList.add('slide-show__item--active');
        }
    }

}

export default SlideShow;