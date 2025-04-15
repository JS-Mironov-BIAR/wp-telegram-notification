/**
 * * * * Working with settings and integration with Totalcontroller
 * @parameter {Event} e
 * form @param {HTMLFormElement}
 */
export default async function formEventsClick(e, form) {
    e.preventDefault()

    if (typeof wtn_ajax === 'undefined') {
        // eslint-disable-next-line
        console.warn('wtn_ajax не определён')
        return
    }

    const data = new FormData(form)
    data.append('action', 'wtn_send_form')
    data.append('_ajax_nonce', wtn_ajax.nonce)

    try {
        const response = await fetch(wtn_ajax.url, {
            method: 'POST',
            body: data,
        })

        const result = await response.json()

        if (result.success) {
            // eslint-disable-next-line no-undef
            ModalControllers?.Status?.setSuccess?.()
            form.reset()
        } else {
            // eslint-disable-next-line no-undef
            ModalControllers?.Status?.setError?.()
        }
    } catch (error) {
        // eslint-disable-next-line no-undef
        ModalControllers?.Status?.setError?.()
    }
}
