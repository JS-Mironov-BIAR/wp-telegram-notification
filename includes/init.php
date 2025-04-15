<?php
if (!defined('ABSPATH')) {
	exit;
}

require_once dirname(__DIR__) . '/components/form.php';
require_once dirname(__DIR__) . '/config/telegram.php';

add_action('wp_ajax_wtn_send_form', 'wtn_handle_ajax');
add_action('wp_ajax_nopriv_wtn_send_form', 'wtn_handle_ajax');

function wtn_handle_ajax(): void {
	check_ajax_referer('wtn_form_nonce');

	$name    = sanitize_text_field($_POST['name'] ?? '');
	$phone   = sanitize_text_field($_POST['phone'] ?? '');
	$message = sanitize_textarea_field($_POST['message'] ?? '');

	$text = "📩 *Новое обращение с сайта* \n\n👤 Имя: $name\n📱 Телефон: $phone\n💬 Сообщение: $message";

	if (wtn_send_telegram_message($text)) {
		wp_send_json_success();
	} else {
		wp_send_json_error('Ошибка отправки');
	}
}
