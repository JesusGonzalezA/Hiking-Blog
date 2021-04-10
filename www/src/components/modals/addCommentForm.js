
// Get elements
const closeButton = document.getElementById('close-modal');
const addButton = document.getElementById('add-comment-button');
const modal = document.getElementById('modal-form-comment');
const addCommentForm = document.getElementById('add-comment-form');
const nameInput = document.getElementById('name');
const emailInput = document.getElementById('email');
const commentInput = document.getElementById('comment');
const comments = document.getElementById('comments');

//**************************************************************************
// Open modal
addButton.onclick = () => {
    modal.style.display = "flex";
}
    
// Close modal
window.onclick = (event) => {
    if (event.target == modal) 
        modal.style.display = "none";
}

closeButton.onclick = () => {
    modal.style.display = "none";
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

const invalidWords = [
    'tonto', 'idiota', 'feo', 'cállate', 'imbécil', 'cr7', 'lorem', 'ipsum'
]


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