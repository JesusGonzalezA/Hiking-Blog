import { deleteCookie } from '../helpers/deleteCookie.js'
import { getCookie } from '../helpers/getCookie.js'

// Show an error
const error = getCookie("error_update_event")

if ( error ){
    Swal.fire({
        title: 'Error',
        text: error,
        icon: 'error'
    })
    deleteCookie("error_update_event")
}