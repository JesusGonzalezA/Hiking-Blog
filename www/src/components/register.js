import { deleteCookie } from "../helpers/deleteCookie.js"
import { getCookie } from "../helpers/getCookie.js"

// Show an error if the user has already been registered
const error = getCookie('error_register')

if ( error ) {
    Swal.fire({
        title: 'Error',
        text: error,
        icon: 'error'
    })

    deleteCookie('error_register')
}

// Check the form
const button      = document.getElementById('register-button')
const emailInput  = document.getElementsByName('email')[0]
const nameInput   = document.getElementsByName('name')[0]
const passInputs  = document.getElementsByName('password')

button.onclick = ( e ) => {

    let error = ""
    const re = /\S+@\S+\.\S+/;

    if ( emailInput.value === '' )
        error = "El email es requerido"
    else if ( !re.test(emailInput.value) )
        error = "El email no es correcto"
    else if ( nameInput.value === '' )
        error = "El nombre es requerido"
    else if ( passInputs[0].value === '' )
        error = "La contraseña es requerida"
    else if ( passInputs[0].value !== passInputs[1].value )
        error = "Las contraseñas deben de coincidir"
    
    if ( error ) {
        e.preventDefault()

        Swal.fire({
            title: 'Error',
            text: error,
            icon: 'error'
        })
    } 
}


