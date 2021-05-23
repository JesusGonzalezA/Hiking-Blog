$(document).ready(function() {
    searchInput.onchange = search
});

const search = () => {
   
    $("#result").empty()
    $("#result").addClass('hidden')
    $.ajax({
        data: { q: $("#searchInput").val() },
        url: 'search_event.php',
        type: 'get',
        beforeSend:  () => {
            $("#loading").removeClass("hidden")
        },
        success: ( res ) => {
          showRes( res )
        }
     });
}

const showRes = ( result ) => {
    $("#result").removeClass('hidden')
    $("#loading").addClass('hidden')
    
    result.forEach( ( res ) => {
        $("#result").append( 
            $(`<li>
                    <a href="/evento/${ res[0] }">
                        ${ res[1] }
                    </a>
                </li>`
            )
        )
    })
}