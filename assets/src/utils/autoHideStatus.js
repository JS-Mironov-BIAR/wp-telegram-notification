/**
 * Adds fade-out and clears the element text after 5 seconds
 *
 * @param {HTMLElement} element — DOM element that needs to hide the text
 * @param {number} delay — Time in ms (default 5000)
 */
export default function autoHideStatus(element, delay = 5000) {
    if (!element) return

    element.classList.add('fade-out')

    setTimeout(() => {
        element.textContent = ''
        element.classList.remove('fade-out')
    }, delay)
}
