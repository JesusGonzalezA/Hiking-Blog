import { showComment } from '../../helpers/showComment.js';

//Get the button
const showButton = document.getElementById("show-comment-button");

// When the user clicks on the button, scroll to the top of the document
showButton.addEventListener('click', showComment);