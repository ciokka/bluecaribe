<?php
/**
 * The template for displaying features content within single
 *
 * This template can be overridden by copying it to yourtheme/ovabrw-templates/single/features.php
 *
 */
if (!defined('ABSPATH'))
	exit();

// Get product_id from do_action - use when insert shortcode
if (isset($args['id']) && $args['id']) {
	$pid = $args['id'];
} else {
	$pid = get_the_id();
}

// Check product type: rental
$product = wc_get_product($pid);
if (!$product || $product->get_type() !== 'ovabrw_car_rental')
	return;

$ovabrw_features_desc = get_post_meta($pid, 'ovabrw_features_desc', true);
$ovabrw_features_label = get_post_meta($pid, 'ovabrw_features_label', true);
$ovabrw_features_icons = get_post_meta($pid, 'ovabrw_features_icons', true);
?>
<?php
	if( get_field( 'private' ) != 1 ){ ?>
		
<div class="operationDays">
	<span class="label">
		<?php esc_html_e('Operation days', 'hello-elementor-child'); ?>
	</span>


	<?php $days = get_field('days'); ?>
	<?php
	$giorni = get_terms(
		array(
			'taxonomy' => 'operation-days',
			'hide_empty' => false,
			'orderby' => 'id',
		)
	);
	?>
	<?php if ($days): ?>
		<?php foreach ($giorni as $giorno): ?>

			<?php $get_terms_args = array(
				'taxonomy' => 'product_tag',
				'hide_empty' => 0,
				'include' => $days,
			); ?>

			<?php $terms = get_terms($get_terms_args); ?>

			<?php if (in_array($giorno->term_id, $days)): ?>
				<span class="giorni ok">
					<?php echo esc_html(substr($giorno->name, 0, 1)); ?>
				</span>
			<?php else: ?>
				<span class="giorni">
					<?php echo esc_html(substr($giorno->name, 0, 1)); ?>
				</span>
			<?php endif; ?>

		<?php endforeach; ?>
	<?php endif; ?>

</div>
<div class="operationDays">
	<span class="label">
		<?php esc_html_e('Duration', 'hello-elementor-child'); ?>
	</span>
	<span class="duration">
		<?php echo esc_html_e(get_field( 'duration' ), 'acf-field-group-1574'); ?>
	</span>
</div>
<?php 
	$location = get_field( 'pick_up_location');
	if (isset($location)): ?>
	<div class="operationDays">
		<span class="label">
			<?php esc_html_e('Pick up location', 'hello-elementor-child'); ?>
		</span>
		<span class="duration">
		<?php the_field( 'pick_up_location' ); ?>
		</span>
	</div>
<?php endif; ?>
<div class="operationDays">
	<span class="label">
		<?php esc_html_e('Features', 'hello-elementor-child'); ?>:
	</span>
</div>
<?php if (!empty($ovabrw_features_desc)) { ?>
	<ul class="ovabrw_woo_features">
		<?php foreach ($ovabrw_features_desc as $key => $value) { ?>
			<li>
				<?php if (isset($ovabrw_features_icons[$key]) && !empty($ovabrw_features_icons[$key])): ?>
					<i aria-hidden="true" class="<?php esc_attr_e($ovabrw_features_icons[$key]); ?>"></i>
				<?php endif; ?>
				<?php if (isset($ovabrw_features_label[$key]) && !empty($ovabrw_features_label[$key])): ?>
					<label>
						<?php echo esc_html($ovabrw_features_label[$key]); ?>:
					</label>
				<?php endif; ?>
				<?php if (!empty($ovabrw_features_desc[$key])): ?>
					<span>
						<?php echo esc_html($value); ?>
					</span>
				<?php endif; ?>
			</li>
		<?php } ?>
	</ul>
<?php } ?>

<div class="extraInfo">
	<?php the_field('extra_info'); ?>
</div>

<?php } ?>