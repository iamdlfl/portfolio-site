class CodeBlock {
    constructor() {
        this.sections = document.querySelectorAll('.code-block__section');
        this.events();
    }

    events() {
        window.addEventListener('load', () => this.getDataLink());
    }

    getDataLink() {
        this.sections.forEach((el) => {
            let dLink = el.getAttribute('data-link');
            dLink = `assets/proj_files/` + dLink + `.txt`;
            $.ajax(dLink).done(function (data) {
                let children = el.childNodes;
                children.forEach(function (el) {
                    if (el.nodeName == "PRE") {
                        el.textContent = data;
                    }
                });
            }).fail(function () {
                alert('Could not get data');
            });
        });
    }

}

export default CodeBlock;