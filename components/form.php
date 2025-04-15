<?php

/**
 * Render feedback form via shortcode
 */
function wtn_render_form(): string {
	ob_start(); ?>
    <form class="wtn-form">
        <input type="text" name="name" placeholder="Ваше имя" required>
        <input type="tel" name="phone" placeholder="Ваш телефон" required>
        <textarea name="message" placeholder="Ваше сообщение" required></textarea>
        <button type="submit">Отправить</button>
    </form>
	<?php return ob_get_clean();
}

add_shortcode('wtn_feedback_form', 'wtn_render_form');
