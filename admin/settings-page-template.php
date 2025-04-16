<?php
$chat_sync_success = isset($_GET['chat_sync']) && $_GET['chat_sync'] === 'success';
$test_success = isset($_GET['test_send']) && $_GET['test_send'] === 'success';
$bot_token = get_option('wtn_bot_token', '');
$chat_id   = get_option('wtn_chat_id', '');
?>

<div class="wrap">
	<?php if ($chat_sync_success): ?>
        <div class="notice notice-success is-dismissible"><p>✅ Chat ID успешно обновлён из Telegram!</p></div>
	<?php endif; ?>

	<?php if ($test_success): ?>
        <div class="notice notice-success is-dismissible"><p>✅ Тестовое сообщение успешно отправлено в Telegram!</p></div>
	<?php endif; ?>

    <h1>
        <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/img/telegram-logo.svg'; ?>" alt="Telegram" style="height: 32px; vertical-align: middle; margin-right: 10px;">
        Настройки уведомлений Telegram
    </h1>

    <div class="notice notice-info">
        <p><strong>1.</strong> Создайте бота в <a href="https://t.me/BotFather" target="_blank">@BotFather</a> → команда <code>/newbot</code> → получите токен.</p>
        <p><strong>2.</strong> Напишите что-нибудь своему боту в Telegram (например, <code>/start</code>).</p>
        <p><strong>3.</strong> Нажмите кнопку «Обновить Chat ID из Telegram» — бот подхватит ID.</p>
    </div>

    <div class="metabox-holder">
        <div class="postbox-container" style="width: 70%;">
            <div class="meta-box-sortables">
                <!-- Управление ID и отправкой -->
                <div class="postbox">
                    <h2 class="hndle">Управление ID и отправкой</h2>
                    <div class="inside">
                        <!-- Кнопка асинхронного получения Chat ID -->
                        <p>
                            <button id="wtn-chat-sync-btn" class="button button-primary">Обновить Chat ID из Telegram</button>
                            <span id="wtn-chat-sync-status" style="margin-left: 12px; font-size: 14px;"></span>
                        </p>

                        <!-- Асинхронная отправка теста -->
                        <p style="margin-top: 10px;">
                            <button id="wtn-test-send-btn" class="button">Отправить тестовое сообщение</button>
                            <span id="wtn-test-send-status" style="margin-left: 12px; font-size: 14px;"></span>
                        </p>
                    </div>
                </div>

                <!-- Настройки токена и Chat ID -->
                <div class="postbox">
                    <h2 class="hndle">Настройки подключения</h2>
                    <div class="inside">
                        <form method="post" action="options.php">
							<?php settings_fields('wtn_connection_group'); ?>
                            <table class="form-table">
                                <tr>
                                    <th><label for="wtn_bot_token">Bot Token</label></th>
                                    <td><input type="text" name="wtn_bot_token" id="wtn_bot_token" class="regular-text" value="<?php echo esc_attr($bot_token); ?>"></td>
                                </tr>
                                <tr>
                                    <th><label for="wtn_chat_id">Chat ID</label></th>
                                    <td>
                                        <input type="text" name="wtn_chat_id" id="wtn_chat_id" class="regular-text" value="<?php echo esc_attr($chat_id); ?>">
                                        <p class="description">Можно указать несколько, через запятую или пробел.</p>
                                    </td>
                                </tr>
                            </table>
							<?php submit_button('Сохранить настройки подключения'); ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Правая колонка с памяткой -->
        <div class="postbox-container" style="width: 28%;">
            <div class="meta-box-sortables">
                <div class="postbox">
                    <h2 class="hndle">Информация</h2>
                    <div class="inside">
                        <p><strong>Плагин:</strong> WP Telegram Notification</p>
                        <p><a href="https://github.com/JS-Mironov-BIAR/wp-telegram-notification.git" target="_blank">Исходный код на GitHub</a></p>
                        <p><a href="https://github.com/JS-Mironov-BIAR/wp-custom-modal.git" target="_blank">Плагин модальных окон</a></p>
                        <p>Поддержка множественных chat ID</p>
                    </div>
                </div>

                <div class="postbox">
                    <h2 class="hndle">Памятка</h2>
                    <div class="inside">
                        <ul>
                            <li>Установите <strong>Custom Modal Controller</strong></li>
                            <li>Укажите токен и chat ID</li>
                            <li>Тестовое сообщение помогает проверить подключение</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
