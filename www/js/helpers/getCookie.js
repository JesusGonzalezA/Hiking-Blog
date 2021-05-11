export const getCookie = ( name ) => {
    const index = document.cookie.indexOf( name )
    let endIndex = (index===0)? document.cookie.length : document.cookie.indexOf( ';', index )
    if ( endIndex === -1 ) endIndex = document.cookie.length

    
    if ( index === -1 ) return ""

    const startIndex = index + name.length + 1
    return document.cookie
            .substr( startIndex, endIndex )
            .replaceAll('+', ' ')
}