
//Get the button
const commentsArr        = Array.from(document.getElementsByClassName("comment"))
const commentsContentArr = Array.from(document.getElementsByClassName("comment-content-info"))
const editButtons        = Array.from(document.getElementsByClassName("edit-button"))
const saveButtons        = Array.from(document.getElementsByClassName("save-button"))


const editComment = ( event, index ) => {
    event.preventDefault()

    // Set editable
    const content = commentsContentArr[index-1]
    console.log(content.innerText);
    
    content.readOnly = false
    content.focus()

    // Change button
    const editButton = editButtons[index-1]
    const saveButton = saveButtons[index-1]
    editButton.classList.add('display-none')
    saveButton.classList.remove('display-none')
}

const deleteComment = ( event, idComment ) => {
    event.preventDefault()

    window.location.replace(`/delete_comment.php?comment=${ idComment }`)
}