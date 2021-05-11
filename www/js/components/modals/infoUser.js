import { modal } from './modal.js'

import { getCookie } from '../../helpers/getCookie.js'
import { deleteCookie } from '../../helpers/deleteCookie.js'

// Show an error
const error = getCookie("error_update")

if ( error ){
    Swal.fire({
        title: 'Error',
        text: error,
        icon: 'error'
    })
    deleteCookie("error_update")
}

// Start
const forms = {
    CHANGE_INFO: 'INFO',
    CHANGE_PASSWORD: 'CHANGE_PASSWORDS'
}
let typeForm = ""

// Get components
const changeInfoDiv = document.getElementById('change-info-div')
const changePassDiv = document.getElementById('change-pass-div')
const changeInfoButton = document.getElementById('change-info')
const changePassButton = document.getElementById('change-pass')
const emailInput  = document.getElementsByName('email')[0]
const nameInput   = document.getElementsByName('name')[0]
const passInputs  = document.getElementsByName('password')
const form        = document.getElementById('form')

// Actions to open modal
changeInfoButton.onclick =  () => { 
    typeForm = forms.CHANGE_INFO
    modal.style.display = "flex"
    changeInfoDiv.style.display = "block"
    changePassDiv.style.display = "none"
}
changePassButton.onclick =  () => { 
    typeForm = forms.CHANGE_PASSWORD
    modal.style.display = "flex" 
    changePassDiv.style.display = "block"
    changeInfoDiv.style.display = "none"
}

// Form

form.onsubmit = ( e ) => {

    let error = ""
    
    if ( typeForm === forms.CHANGE_INFO )
    {
        const re = /\S+@\S+\.\S+/;

        if ( emailInput.value === '' )
            error = "El email es requerido"
        else if ( !re.test(emailInput.value) )
            error = "El email no es correcto"
        else if ( nameInput.value === '' )
            error = "El nombre es requerido"
    }

    if ( typeForm === forms.CHANGE_PASSWORD )
    {
        if ( passInputs[0].value === '' )
            error = "La contraseña es requerida"
        else if ( passInputs[0].value !== passInputs[1].value )
            error = "Las contraseñas deben de coincidir"
    }
    
    
    if ( error ) {
        e.preventDefault()

        Swal.fire({
            title: 'Error',
            text: error,
            icon: 'error'
        })
    }
}