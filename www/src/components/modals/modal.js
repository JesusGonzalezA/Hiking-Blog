export const modal = document.getElementById('modal-form-comment');
export const closeButton = document.getElementById('close-modal');

// Close modal
window.onclick = (event) => {
    if (event.target == modal) 
        modal.style.display = "none";
}

closeButton.onclick = () => {
    modal.style.display = "none";
}