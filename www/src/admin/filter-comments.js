const comments = {
    nodesSup: Array.from(document.getElementsByTagName('details')),
    nodes:    Array.from(document.getElementsByClassName('comment')),
    titles:   Array.from(document.getElementsByTagName('summary')),
    content:  Array.from(document.getElementsByClassName('comment-content'))
}

const input = document.getElementById('input_filter')

const filter = ( ) => {
    comments.nodesSup.forEach( (node) => node.style.display = "none")
    comments.nodes.forEach( (node) => node.style.display = "none")

    const value = input.value

    // Filter by content
    const resultsContent = []
    comments.content.forEach( ( content, index ) => {
        if (content.innerText.toLowerCase().includes( value.toLowerCase() ))
            resultsContent.push(index)
    })

    
    // Filter by title
    const resultsTitles = []
    comments.titles.forEach( ( title, index ) => {
        if (title.innerText.toLowerCase().includes( value.toLowerCase() ))
            resultsTitles.push(index)
    })

    // Show comments filtered by title
    resultsTitles.forEach( (result) => {
        const detailsNode = comments.nodesSup[result]
        detailsNode.style.display = "block"
        
        const children = Array.from(detailsNode.children) 
        
        children.forEach( (child) => {
            const display = ( child.className === "comment" ) 
                            ? "block" 
                            : "list-item"
            child.style.display = display
        })
    })

    // Show comments filtered by content
    resultsContent.map( (index) => {
        const comment     = comments.nodes[index]
        console.log(comments.nodes[0].parentNode);
        
        const detailsNode = comment.parentNode

        detailsNode.style.display = "block"
        comment.style.display     = "block"
    })
    //     // Show content
    // resultsContent.map( (result) => {
    //     comments.nodes[result].style.display = "block"
    // })
}

input.addEventListener('change', () => filter( event ) )
input.addEventListener('keyup',  () => filter( event ) )
