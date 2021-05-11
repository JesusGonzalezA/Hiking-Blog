import { goTop } from '../../helpers/goToFunctions.js';

//Get the button
const upButton = document.getElementById("up-button");

// When the user scrolls down 20px from the top of the document, show the button
window.onload = () => { scrollFunction() };
window.onscroll = () => { scrollFunction() };

const scrollFunction = () => {
    let style = "none";

    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100)
        style = "block";

    upButton.style.display = style;
}

// When the user clicks on the button, scroll to the top of the document
upButton.addEventListener('click', goTop );