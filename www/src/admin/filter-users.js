const input     = document.getElementById('input_filter')
const usersNode = Array.from(document.getElementsByClassName("user"))
const users     = usersNode.map( ( userNode ) => {
    return userNode.childNodes[1].childNodes[1].innerText
})

const filter = () => {
    
    usersNode.forEach( (userNode, index) => {

        const display = ( users[index].includes( input.value ) )
            ? "block" 
            : "none"
        
        userNode.style.display = display 
    })
}

input.addEventListener('keyup',  filter )
input.addEventListener('change', filter )