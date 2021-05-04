export const getCookie = ( name ) => {
    const index = document.cookie.indexOf( name )
    const endIndex = (index===0)? document.cookie.length : document.cookie.indexOf( ';', index )
    
    if ( index === -1 ) return ""

    return document.cookie
            .substr( index + name.length + 1, endIndex )
            .replaceAll('+', ' ')
}