<?php

function wtn_register_settings_page() {
	add_options_page(
		'Telegram Notification Settings',
		'Telegram Notification',
		'manage_options',
		'wtn-settings',
		'wtn_settings_page_html'
	);
}
add_action('admin_menu', 'wtn_register_settings_page');

function wtn_settings_page_html() {
	?>
	<div class="wrap">
		<h1>Telegram Notification Settings</h1>
		<form method="post" action="options.php">
			<?php
			settings_fields('wtn_settings_group');
			do_settings_sections('wtn-settings');
			submit_button();
			?>
		</form>
	</div>
	<?php
}

function wtn_register_settings() {
	register_setting('wtn_settings_group', 'wtn_bot_token');
	register_setting('wtn_settings_group', 'wtn_chat_id');

	add_settings_section('wtn_main_section', '', null, 'wtn-settings');

	add_settings_field(
		'wtn_bot_token',
		'Telegram Bot Token',
		'wtn_bot_token_field',
		'wtn-settings',
		'wtn_main_section'
	);
	add_settings_field(
		'wtn_chat_id',
		'Telegram Chat ID',
		'wtn_chat_id_field',
		'wtn-settings',
		'wtn_main_section'
	);
}
add_action('admin_init', 'wtn_register_settings');

function wtn_bot_token_field() {
	$value = get_option('wtn_bot_token');
	echo '<input type="text" name="wtn_bot_token" value="' . esc_attr($value) . '" class="regular-text">';
}

function wtn_chat_id_field() {
	$value = get_option('wtn_chat_id');
	echo '<input type="text" name="wtn_chat_id" value="' . esc_attr($value) . '" class="regular-text">';
	echo '<p class="description">Введите один или несколько chat ID, разделённых запятыми или пробелами.</p>';
}

