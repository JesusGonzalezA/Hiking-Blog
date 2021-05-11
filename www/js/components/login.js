import { deleteCookie } from '../helpers/deleteCookie.js'
import { getCookie } from '../helpers/getCookie.js'

// Show an error
const error = getCookie("error_login")

if ( error ){
    Swal.fire({
        title: 'Error',
        text: error,
        icon: 'error'
    })
    deleteCookie("error_login")
}

// Check the form
const button      = document.getElementById('login-button')
const emailInput  = document.getElementsByName('email')[0]
const passInput   = document.getElementsByName('password')[0]

button.onclick = ( e ) => {
    let error = ""
    const re = /\S+@\S+\.\S+/    

    if ( emailInput.value === '' )
        error = "El email es requerido"
    else if ( !re.test(emailInput.value) )
        error = "El email no es correcto"
    else if ( passInput.value === '' )
        error = "La contraseña es requerida"
    
    if ( error ) {
        e.preventDefault()

        Swal.fire({
            title: 'Error',
            text: error,
            icon: 'error'
        })
    }
    
}


