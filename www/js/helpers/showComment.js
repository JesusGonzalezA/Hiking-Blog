
export const showComment = () => {

    // Get the comments
    const commentContainer = document.getElementById('comments-container');
    commentContainer.classList.remove('display-none');

    // Get the button
    const showButton = document.getElementById('show-comment-button');
    showButton.style.display = "none";
}