/**
 * Executes a POST request to admin-ajax.php with the passed parameters
 *
 * @param {string} action - action name
 * @param {Object} additionalParams - any additional parameters
 * @returns {Promise<object>} - JSON result
 */
export async function customFetch(action, additionalParams = {}) {
    const params = new URLSearchParams({
        action,
        _ajax_nonce: wtn_admin.nonce,
        ...additionalParams,
    })

    const response = await fetch(wtn_admin.ajaxUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: params,
    })

    return response.json()
}
