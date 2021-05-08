
//Get the button
const commentsArr        = Array.from(document.getElementsByClassName("comment"))
const commentsContentArr = Array.from(document.getElementsByClassName("comment-content"))
const editButtons        = Array.from(document.getElementsByClassName("edit-button"))
const saveButtons        = Array.from(document.getElementsByClassName("save-button"))


const editComment = ( index ) => {
    
    // Set editable
    const content = commentsContentArr[index-1]
    content.contentEditable = true
    content.focus()

    // Change button
    const editButton = editButtons[index-1]
    const saveButton = saveButtons[index-1]
    editButton.classList.add('display-none')
    saveButton.classList.remove('display-none')
}

const saveComment = ( index ) => {

    // Save 


    // Change button
    const editButton = editButtons[index-1]
    const saveButton = saveButtons[index-1]
    editButton.classList.remove('display-none')
    saveButton.classList.add('display-none')
}

const deleteComment = ( index ) => {

    const comment = commentsArr[index-1]

    // Delete comment front
    comment.remove()
    
}