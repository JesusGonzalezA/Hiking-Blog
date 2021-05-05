export const deleteCookie = ( name ) => {
    document.cookie = `${name}=; expires=Thu, 18 Dec 2013 12:00:00 UTC; path=/`;
}