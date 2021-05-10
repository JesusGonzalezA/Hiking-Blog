import { modal } from 'modal.js'

// Get elements
const addButton = document.getElementById('add-comment-button');
const addCommentForm = document.getElementById('add-comment-form');
const nameInput = document.getElementById('name');
const emailInput = document.getElementById('email');
const commentInput = document.getElementById('comment');

//**************************************************************************
// Open modal
addButton.onclick = () => {
    modal.style.display = "flex";
}


//**************************************************************************

const validateFields = () => {
    
    if ( nameInput.value === "" || emailInput.value === "" || commentInput.value === "" )
        return false;
    
    const re = /\S+@\S+\.\S+/;    
    
    return re.test(emailInput.value);
}

//**************************************************************************
// Banned comment

const invalidWords = document
                        .getElementById('banned').dataset.banned
                        .replaceAll("\"","")
                        .split(';')


const validateComment = () => {
    const comment = commentInput.value;
    const words   = comment.split(" ");

    
    const bannedComment = words.map( 
            word => (invalidWords.includes(word))
                    ? word.replaceAll(/./g, '*') 
                    : word
    )
    commentInput.value = bannedComment.join(" ");
}

commentInput.onchange = validateComment;
commentInput.onkeyup = validateComment;

//**************************************************************************
// Submit comment
addCommentForm.onsubmit = (e) => {
    if ( !validateFields() )
    {
        e.preventDefault();
        alert("Ha introducido los datos mal.");
        return;
    }

    alert("Su reseña ha sido enviada con éxito");
}