
const input = document.getElementById('filter')

const filter = ( event ) => {
    console.log(event);
}

input.addEventListener('change', ( event ) => filter( event ) )
