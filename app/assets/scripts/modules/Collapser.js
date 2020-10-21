/* 
To use: 

1. Create your button or whatever will be used to click to toggle
2. Make sure it has class of collapser
3. Make sure the target divs/sections have classes of collapsee
4. data-target= The element to show when your button is clicked
5. data-conflicts= The element(s) to hide when your button is clicked
6. Note that these two data attributes are designed to be used with IDs but can be used 
    with classes if only one exists (due to use of querySelector and not querySelectorAll)
    
*/

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