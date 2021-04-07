
export const hideComment = () => {

    // Get the comments
    const commentContainer = document.getElementById('comments-container');
    commentContainer.classList.add('display-none');

    // Get the button
    const showButton = document.getElementById('show-comment-button');
    showButton.style.display = "inline-block";
}