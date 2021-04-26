
//Get the button
const commentsArr    = Array.from(document.getElementsByClassName("comment-content"))
const editButtons = Array.from(document.getElementsByClassName("edit-button"))
const saveButtons = Array.from(document.getElementsByClassName("save-button"))


const editComment = ( index ) => {
    const content = commentsArr[index-1]
    content.contentEditable = true
    content.focus()

    // Change button
    const editButton = editButtons[index-1]
    const saveButton = saveButtons[index-1]
    editButton.classList.add('display-none')
    saveButton.classList.remove('display-none')
}