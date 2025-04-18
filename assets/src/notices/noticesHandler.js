import showNotice from './noticesEvents'

export default function initAdminNoticesHandler() {
    const notices = document.querySelectorAll('.notice.is-dismissible')

    notices.forEach((notice) => showNotice(notice))
}
