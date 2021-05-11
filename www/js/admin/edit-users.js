
const editButtons = Array.from(document.getElementsByClassName('edit-button'))
const saveButtons = Array.from(document.getElementsByClassName('save-button'))
const rolSelects  = Array.from(document.getElementsByClassName('rol-select'))

const showUpdate = ( index ) => {
    rolSelects[index-1].disabled = false
    saveButtons[index-1].style.display = "inline-block"
    editButtons[index-1].style.display = "none"
}

const deleteUser = ( idUser ) => {
    window.location.replace(`/delete_user.php?user=${ idUser }`)
}

const updateUser = ( idUser, index ) => {
    const rol = rolSelects[index-1].value
    window.location.replace(`/change_user_role.php?user=${ idUser }&role=${ rol }`)
}