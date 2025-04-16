import { customFetch } from '../utils/customFetch'

export async function buttonSyncEventsClick(e, syncBtn) {
    const statusBox = document.querySelector('#wtn-chat-sync-status')
    const field = document.querySelector('#wtn_chat_id')

    if (!syncBtn || !field) return

    e.preventDefault()
    syncBtn.disabled = true
    statusBox.textContent = '⏳ Получение ID...'

    try {
        const result = await customFetch('wtn_chat_sync_ajax')

        if (result.success && result.data) {
            field.value = result.data.join(', ')
            statusBox.textContent = '✅ Chat ID обновлены!'
        } else {
            statusBox.textContent = '⚠️ Не удалось получить ID'
        }
    } catch (err) {
        statusBox.textContent = '🚫 Ошибка запроса'
    } finally {
        syncBtn.disabled = false

        setTimeout(() => {
            statusBox.textContent = ''
            statusBox.classList.remove('fade-out')
        }, 500)
    }
}

export async function buttonTestEventsClick(e, testBtn) {
    const testStatus = document.querySelector('#wtn-test-send-status')

    if (!testStatus || !testBtn) return

    e.preventDefault()
    testStatus.textContent = '⏳ Отправка...'
    testBtn.disabled = true

    try {
        const result = await customFetch('wtn_test_send_ajax')

        if (result.success) {
            testStatus.textContent = '✅ Сообщение отправлено!'
        } else {
            testStatus.textContent = '⚠️ Не удалось отправить'
        }
    } catch (err) {
        testStatus.textContent = '🚫 Ошибка запроса'
    } finally {
        testBtn.disabled = false
        setTimeout(() => {
            testStatus.textContent = ''
            testStatus.classList.remove('fade-out')
        }, 500)
    }
}
