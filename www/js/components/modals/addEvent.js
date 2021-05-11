import { modal } from './modal.js'

const buttonOpenModal = document.getElementById('add_event')

buttonOpenModal.onclick = () => {
    modal.style.display = "flex"
}