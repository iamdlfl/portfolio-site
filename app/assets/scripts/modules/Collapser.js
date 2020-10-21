class Collapser {
    constructor() {
        this.collapsers = document.querySelectorAll('.collapser');
        this.events();
    }

    events() {
        this.collapsers.forEach((el) => {
            el.addEventListener('click', () => this.toggleCollapsee(el));
        });
    }

    toggleCollapsee(el) {

        let target = el.getAttribute('data-target');
        let conflictsString = el.getAttribute('data-conflicts');
        let conflicts = conflictsString.split(' ');
        conflicts.forEach(function (con) {
            document.querySelector(con).classList.remove('collapsee--show');
        })
        document.querySelector(target).classList.toggle('collapsee--show');

    }

}

export default Collapser;