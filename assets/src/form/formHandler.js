import formEventsClick from './formEvents'

export default function initFormHandler() {
    const forms = document.querySelectorAll('.wtn-form')
    if (!forms.length) return

    forms.forEach((form) => {
        form.addEventListener('submit', async (e) => formEventsClick(e, form))
    })
}
