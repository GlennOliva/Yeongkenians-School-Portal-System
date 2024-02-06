const collElements = document.getElementsByClassName('collapsible');

for (let i = 0; i < collElements.length; i++) {
    collElements[i].addEventListener("click", function() {
        this.classList.toggle("active");

        const content = this.nextElementSibling;

        if (!!content.style.maxHeight) {
            content.style.maxHeight = null;
        } else {
            content.style.maxHeight = content.scrollHeight + "px";
        }
    });
}