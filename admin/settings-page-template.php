<?php
$chat_sync_success = isset($_GET['chat_sync']) && $_GET['chat_sync'] === 'success';
$test_success = isset($_GET['test_send']) && $_GET['test_send'] === 'success';

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
				<div class="postbox">
					<h2 class="hndle">Управление ID и отправкой</h2>
					<div class="inside">
						<form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" style="margin-bottom: 16px;">
							<input type="hidden" name="action" value="wtn_chat_sync">
							<?php submit_button('Обновить Chat ID из Telegram', 'primary', 'submit', false); ?>
						</form>

						<form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
							<input type="hidden" name="action" value="wtn_test_send">
							<?php submit_button('Отправить тестовое сообщение', 'secondary', 'submit', false); ?>
						</form>
					</div>
				</div>

				<div class="postbox">
					<h2 class="hndle">Настройки подключения</h2>
					<div class="inside">
                        <form method="post" action="options.php">
							<?php
							settings_fields('wtn_connection_group');
							$bot_token = get_option('wtn_bot_token', '');
							$chat_id = get_option('wtn_chat_id', '');
							?>
                            <table class="form-table">
                                <tr>
                                    <th><label for="wtn_bot_token">Bot Token</label></th>
                                    <td><input type="text" name="wtn_bot_token" id="wtn_bot_token" class="regular-text" value="<?php echo esc_attr($bot_token); ?>"></td>
                                </tr>
                                <tr>
                                    <th><label for="wtn_chat_id">Chat ID</label></th>
                                    <td><input type="text" name="wtn_chat_id" id="wtn_chat_id" class="regular-text" value="<?php echo esc_attr($chat_id); ?>"></td>
                                </tr>
                            </table>
							<?php submit_button('Сохранить настройки подключения'); ?>
                        </form>
					</div>
				</div>
            </div>
		</div>

		<div class="postbox-container" style="width: 28%;">
			<div class="meta-box-sortables">
				<div class="postbox">
					<h2 class="hndle">Информация</h2>
					<div class="inside">
						<p><strong>Плагин:</strong> WP Telegram Notification</p>
						<p><a href=" https://github.com/JS-Mironov-BIAR/wp-telegram-notification.git" target="_blank">Исходный код на GitHub</a></p>
						<p><a href=" https://github.com/JS-Mironov-BIAR/wp-custom-modal.git" target="_blank">Исходный код плагина модальных окон</a></p>
						<p>Поддержка множественных chat ID</p>
					</div>
				</div>

				<div class="postbox">
					<h2 class="hndle">Памятка</h2>
					<div class="inside">
						<ul>
							<li>Установите <strong>Custom Modal Controller</strong></li>
							<li>Укажите токен и chat_id</li>
						</ul>
					</div>
				</div>
            </div>
		</div>
	</div>

	<script>
        document.addEventListener('DOMContentLoaded', () => {
            const notices = document.querySelectorAll('.notice.is-dismissible')
            notices.forEach((notice) => {
                setTimeout(() => {
                    notice.style.transition = 'opacity 0.5s ease'
                    notice.style.opacity = '0'
                    setTimeout(() => notice.remove(), 500)
                }, 4000)
            })
        })
	</script>

    <style>
        .metabox-holder {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }

        .postbox-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const syncBtn = document.querySelector('#wtn-chat-sync-btn');
            const statusBox = document.createElement('div');
            syncBtn?.parentNode?.appendChild(statusBox);

            syncBtn?.addEventListener('click', async (e) => {
                e.preventDefault();
                statusBox.innerHTML = '⏳ Получение chat ID...';
                syncBtn.disabled = true;

                try {
                    const response = await fetch(ajaxurl, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: new URLSearchParams({
                            action: 'wtn_chat_sync_ajax',
                            _ajax_nonce: '<?php echo wp_create_nonce('wtn_chat_sync_nonce'); ?>'
                        })
                    });

                    const result = await response.json();
                    if (result.success && result.data) {
                        const field = document.querySelector('#wtn_chat_id');
                        if (field) field.value = result.data.join(', ');
                        statusBox.innerHTML = '✅ Chat ID успешно обновлены!';
                    } else {
                        statusBox.innerHTML = '⚠️ Не удалось получить chat ID.';
                    }
                } catch (err) {
                    statusBox.innerHTML = '🚫 Ошибка запроса.';
                } finally {
                    syncBtn.disabled = false;
                }
            });
        });
    </script>

</div>
