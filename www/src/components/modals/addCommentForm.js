
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
    
    e.preventDefault();

    if ( !validateFields() )
    {
        alert("Ha introducido los datos mal.");
        return;
    }

    modal.style.display = "none";

    const date = new Date();
    const comment = document.createElement("div");
    comment.classList.add("comment");
    
    const commentTitle = document.createElement("div");
    commentTitle.classList.add("comment-title");

    const commentImg = document.createElement("img");
    commentImg.classList.add("rounded");
    commentImg.src = "../assets/avatars/avatar.png";
    commentImg.alt = "Avatar";
    
    const commentAuthor = document.createElement("span");
    commentAuthor.classList.add("comment-author");
    commentAuthor.innerText = nameInput.value;

    const commentDate = document.createElement("span");
    commentDate.classList.add("comment-date");
    commentDate.innerText = date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear() + ', '  + date.getHours() + ':' + date.getMinutes();

    const commentContent = document.createElement("p");
    commentContent.classList.add("comment-content");
    commentContent.innerText = commentInput.value;

    commentTitle.appendChild(commentImg);
    commentTitle.appendChild(commentAuthor);
    commentTitle.appendChild(commentDate);

    comment.appendChild(commentTitle);
    comment.appendChild(commentContent);

    comments.appendChild(comment);

    //--------------------------------------------------------------------------
    alert("Su reseña ha sido enviada con éxito");
    nameInput.value = "";
    emailInput.value = "";
    commentInput.value = "";
}