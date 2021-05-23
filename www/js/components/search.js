$(document).ready(function() {
    searchInput.onchange = search
});

const search = () => {
    $("#loading").removeClass("hidden")
    $("#result").addClass('hidden')
}

const showRes = () => {
    $("#result").removeClass('hidden')
    $("#loading").addClass('hidden')
}