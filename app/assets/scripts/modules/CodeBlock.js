/* 
To use: 

1. Create a div with class of code-block
2. Create sub-divs with code-block__section for any sections of code
3. Create a <pre> tag to house the code
4. Set data-link to the name of the file minus the extension (currently must be a .txt)
5. See below to change any file locations - may separate this out as another data value in future

*/

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