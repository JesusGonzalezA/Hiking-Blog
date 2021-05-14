import { modal } from './modal.js'
import { deleteCookie } from '../../helpers/deleteCookie.js'
import { getCookie } from '../../helpers/getCookie.js'

const buttonOpenModal = document.getElementById('add_event')

// Show an error
const error = getCookie("error_add_event")

if ( error ){
    Swal.fire({
        title: 'Error',
        text: error,
        icon: 'error'
    })
    deleteCookie("error_add_event")
}


buttonOpenModal.onclick = () => {
    modal.style.display = "flex"
}