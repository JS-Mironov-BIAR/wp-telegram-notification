import { buttonSyncEventsClick, buttonTestEventsClick } from './buttonsEvents'

export default function initAdminButtonHandler() {
    const syncBtn = document.querySelector('#wtn-chat-sync-btn')
    const testBtn = document.querySelector('#wtn-test-send-btn')

    testBtn.addEventListener('click', async (e) => buttonTestEventsClick(e, testBtn))
    syncBtn.addEventListener('click', async (e) => buttonSyncEventsClick(e, syncBtn))
}
