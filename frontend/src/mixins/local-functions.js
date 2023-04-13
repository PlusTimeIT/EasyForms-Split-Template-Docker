
window.setLocal = function setLocal(name, value) {
    localStorage.setItem(name, value)
}

window.getLocal = function getLocal(name) {
    return localStorage.getItem(name)
}

window.deleteLocal = function deleteLocal(name) {
    localStorage.removeItem(name)
}