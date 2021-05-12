
const deleteEvent = ( idEvent ) => {
    window.location.replace(`/delete_event.php?event=${ idEvent }`)
}

const editEvent = ( idEvent ) => {
    window.location.href = `/admin/evento/${ idEvent }`
} 