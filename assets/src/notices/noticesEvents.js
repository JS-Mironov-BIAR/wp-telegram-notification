export default function showNotice(notice) {
    setTimeout(() => {
        notice.style.transition = 'opacity 0.5s ease'
        notice.style.opacity = '0'
        setTimeout(() => notice.remove(), 500)
    }, 4000)
}
