
export const goTo = (position) => {
    document.body.scrollTop = position;
    document.documentElement.scrollTop = position;
}

export const goTop = () => {
    goTo(0);
}

export const goUp = () => {
    const vh = Math.max(document.documentElement.clientHeight, window.innerHeight);
    
    goTo(vh);
}