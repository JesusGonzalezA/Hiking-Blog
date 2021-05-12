
const deleteEvent = ( idEvent ) => {
    window.location.replace(`/delete_event.php?event=${ idEvent }`)
}

const editEvent = ( idEvent ) => {
    window.location.href = `/admin/evento/${ idEvent }`
} 


// Add event
const submitButton     = document.getElementById("submit-button")
const photoInput       = document.getElementsByName('photo')[0]
const titleInput       = document.getElementsByName('title')[0]
const placeInput       = document.getElementsByName('place')[0]
const dateInput        = document.getElementsByName('date')[0]
const descriptionInput = document.getElementsByName('description')[0]

submitButton.onclick = ( event ) => {
    let error = ""

    if ( titleInput.value === '' )
        error = "El título es requerido"
    else if ( dateInput.value === '' )
        error = "La fecha es requerida"
    else if ( placeInput.value === '' )
        error = "El lugar es requerido"
    
    if ( error ) {
        event.preventDefault()

        Swal.fire({
            title: 'Error',
            text: error,
            icon: 'error'
        })
    }
}

