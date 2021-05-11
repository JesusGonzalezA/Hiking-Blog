const input       = document.getElementById('input_filter')
const eventNodes  = Array.from(document.getElementsByClassName("admin-event"))
const eventTitles = Array.from(document.getElementsByClassName("admin-event-title"))

const filter = () => {
    
    eventNodes.forEach( (eventNode, index) => {

        const display = ( eventTitles[index].innerText.toLowerCase().includes( input.value.toLowerCase() ) )
            ? "block" 
            : "none"
        
        eventNode.style.display = display 
    })
}

input.addEventListener('keyup',  filter )
input.addEventListener('change', filter )