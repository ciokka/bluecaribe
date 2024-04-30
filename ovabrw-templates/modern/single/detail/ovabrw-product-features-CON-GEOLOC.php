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

<?php

if(!(isset($_COOKIE["tourOperator"]) && $_COOKIE["tourOperator"]) && get_field( 'private' ) != 1 ) {
?>
<div class="show-code">
<?php
	$city = do_shortcode('[cfgeo return="city"]');
	$region = do_shortcode('[cfgeo return="region_code"]');
	if(!($city == 'Tulum' || !in_array($region,["YUC","ROO"]))) {
	echo '
			<a class="open-code" href="">'.__( 'I have a code', 'hello-elementor-child' ).' <b>'.__( 'click here', 'hello-elementor-child' ).'</b>
			<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
				<g>
					<g>
						<path d="M510.413,129.292c-3.705-7.409-12.713-10.413-20.124-6.708l-60,30c-7.41,3.705-10.413,12.715-6.708,20.125
							c3.704,7.409,12.713,10.413,20.124,6.708l60-30C511.115,145.712,514.118,136.702,510.413,129.292z"/>
					</g>
				</g>
				<g>
					<g>
						<path d="M503.705,302.583l-60-30c-7.406-3.703-16.418-0.702-20.124,6.708c-3.705,7.41-0.702,16.42,6.708,20.125l60,30
							c7.41,3.705,16.42,0.701,20.124-6.708C514.118,315.298,511.115,306.288,503.705,302.583z"/>
					</g>
				</g>
				<g>
					<g>
						<path d="M345.998,241H119.999v-76c0-41.355,34.094-75,76-75c41.355,0,75,33.645,75,75v30c0,8.284,6.716,15,15,15h60
							c8.284,0,15-6.716,15-15v-30c0-90.98-74.018-164.999-164.999-164.999C104.467,0.002,30,74.02,30,165.001v78.58
							C12.541,249.772,0,266.445,0,286v180.999c0,24.813,20.187,45,45,45h300.998c24.813,0,45-20.187,45-45V286
							C390.998,261.187,370.811,241,345.998,241z M60,165.001c0-74.439,61.01-134.999,135.999-134.999
							c74.439,0,134.999,60.561,134.999,134.999v15h-30v-15c0-57.897-47.103-104.999-104.999-104.999
							c-58.068,0-105.999,47.12-105.999,104.999v76H60V165.001z M360.998,466.999c0,8.271-6.729,15-15,15H45c-8.271,0-15-6.729-15-15
							V286c0-8.271,6.729-15,15-15c13.988,0,288.883,0,300.998,0c8.271,0,15,6.729,15,15V466.999z"/>
					</g>
				</g>
				<g>
					<g>
						<path d="M195.999,301c-24.813,0-45,20.187-45,45c0,19.555,12.541,36.228,30,42.42v48.58c0,8.284,6.716,15,15,15s15-6.716,15-15
							v-48.58c17.459-6.192,30-22.865,30-42.42C240.999,321.187,220.812,301,195.999,301z M195.999,360.999c-8.271,0-15-6.729-15-15
							s6.729-15,15-15s15,6.729,15,15S204.27,360.999,195.999,360.999z"/>
					</g>
				</g>
				<g>
					<g>
						<path d="M496.997,211h-60c-8.284,0-15,6.716-15,15s6.716,15,15,15h60c8.284,0,15-6.716,15-15S505.281,211,496.997,211z"/>
					</g>
				</g>
			</svg>
			</a>';
	}
?>
	<form class="pass-code mt-4" id="codeForm" method="post" style="display: none;">
		<div class="row">
				<div class="col-12 col-xl-7 mb-3">
					<input type="text" name="code" id="code">
				</div>
				<div class="col-12 col-xl-5">
					<button type="submit" name="tourOperatorLogin" id="tourOperatorLogin" class="btn btn-primary"><?= __( 'activate code', 'hello-elementor-child' ) ?></button>
				</div>
		</div>
	</form>
	<script type="text/javascript">
		jQuery(".open-code").click(function(e) {
			e.preventDefault();
			jQuery("#codeForm").fadeIn();
			return false;
		});
	</script>
</div>
<?php
}
?>