<?php if (!defined('ABSPATH'))
	exit(); ?>
<div class="ajaxprezzo">
	<div class="ajax_show_total prezzi">
		<!-- <div class="ajax_loading"></div> -->
		<div class="show_ajax_content prezzi">
			<div class="d-flex justify-content-between align-items-center">
			<?php esc_html_e('Total:', 'ova-brw'); ?>&nbsp;
			<span class="show_total"></span>
			<?php if (get_option('ova_brw_booking_form_show_availables_vehicle', 'yes') == 'yes'): ?>
				<?php esc_html_e('Available Vehicles:', 'ova-brw'); ?>
				<span class="show_availables_vehicle"></span>
			<?php endif; ?>
			</div>
			<span class="txtInfo"><?php esc_html_e("Prezzo finale senza spese aggiuntive al carrello", 'hello-elementor-child'); ?></span>
		</div>
		<div class="ajax-show-error"></div>

	</div>
</div>
