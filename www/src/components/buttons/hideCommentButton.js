import { hideComment } from '../../helpers/hideComment.js';

//Get the button
const hideButton = document.getElementById("hide-comment-button");

// When the user clicks on the button, scroll to the top of the document
hideButton.addEventListener('click', hideComment);