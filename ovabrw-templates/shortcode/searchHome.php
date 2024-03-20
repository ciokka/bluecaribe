<?php

extract($args);
$first_day = get_option('ova_brw_calendar_first_day', '0');
if (empty($first_day)) {
    $first_day = 0;
}

$class_modern = ovabrw_global_typography() ? ' ovabrw_search_modern' : '';

?>
<div class="ovabrw_wd_search">
    <form action="<?php echo esc_url(home_url()); ?>"
        class="ovabrw_search form_ovabrw row <?php echo esc_attr($class . $class_modern); ?>"
        enctype="multipart/form-data" data-mesg_required="<?php esc_html_e('This field is required.', 'ova-brw'); ?>">
        <div class="wrap_content <?php echo esc_attr($column); ?>">
            <?php if ($show_name_product === 'yes'): ?>
                <div class="s_field">
                    <div class="content">
                        <label>
                            <?php esc_html_e('Name Product', 'ova-brw'); ?>
                        </label>
                        <div class="wrap-error"></div>
                        <input type="text" name="ovabrw_name_product"
                            class="<?php echo esc_attr($name_product_required); ?>"
                            value="<?php echo esc_attr($name_product); ?>"
                            placeholder="<?php esc_html_e('Name Product', 'ova-brw'); ?>" autocomplete="off" />
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($show_cat === 'yes'): ?>
                <div class="s_field">
                    <svg id="Glyph" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 31.66 35.78" width="31.66"
                        height="35.78">
                        <path
                            d="m6.6,4.46c-.7-.04-1.29.49-1.33,1.19-.04.7.49,1.29,1.19,1.33.05,0,.1,0,.15,0,.7.04,1.29-.49,1.34-1.19.04-.7-.49-1.29-1.19-1.34-.05,0-.1,0-.15,0Z"
                            style="fill: #124b71;" />
                        <path
                            d="m25.37,23.14c-3.12,0-5.78,2.29-6.24,5.38H3.72c-.8.06-1.5-.54-1.57-1.34.08-.8.77-1.39,1.57-1.34h9.15c1.86.04,3.41-1.41,3.48-3.27-.06-1.86-1.62-3.32-3.48-3.27h-4.53c1.67-2.64,4.84-8.28,4.84-12.94C13.12,2.78,10.17-.06,6.6,0,3.02-.06.07,2.78,0,6.36c0,5.92,5.4,13.82,5.81,14.39.13.21.34.35.58.4.08.02.16.03.23.03h6.25c1.32-.04,2.15,1.44,1.16,2.33-.32.29-.73.44-1.16.44H3.72c-1.78-.12-3.32,1.22-3.45,3-.12,1.78,1.22,3.32,3,3.45.15.01.3.01.45,0h15.41c.47,3.09,3.12,5.38,6.24,5.38,8.38-.35,8.39-12.28,0-12.64h0ZM6.6,8.87c-1.74.04-3.17-1.34-3.21-3.08s1.34-3.17,3.08-3.21c.04,0,.09,0,.13,0,1.74-.04,3.17,1.34,3.21,3.08.04,1.74-1.34,3.17-3.08,3.21-.04,0-.09,0-.13,0Zm22.11,19.21l-3.92,4.07c-.36.37-.95.39-1.33.03-.06-.06-.12-.13-.16-.2l-1.4-2.34c-.26-.45-.1-1.03.35-1.29.44-.25,1.01-.11,1.27.32l.77,1.28,3.06-3.18c.37-.37.96-.37,1.33,0,.36.36.37.94.02,1.31h0Z"
                            style="fill: #124b71;" />
                        <div class="content">
                            <div class="wrap-error"></div>
                            <?php echo OVABRW_Get_Data::instance()->get_html_dropdown_categories($cat, $category_required, $remove_cats_id); ?>
                        </div>
                </div>
            <?php endif; ?>
            <?php if ($show_pickup_date === 'yes'): ?>
                <div class="s_field">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20.622" height="23.568" viewBox="0 0 20.622 23.568">
                        <path id="Icon_awesome-calendar-alt" data-name="Icon awesome-calendar-alt"
                            d="M0,21.359a2.21,2.21,0,0,0,2.21,2.21h16.2a2.21,2.21,0,0,0,2.21-2.21V8.838H0Zm14.73-9.022a.554.554,0,0,1,.552-.552h1.841a.554.554,0,0,1,.552.552v1.841a.554.554,0,0,1-.552.552H15.283a.554.554,0,0,1-.552-.552Zm0,5.892a.554.554,0,0,1,.552-.552h1.841a.554.554,0,0,1,.552.552V20.07a.554.554,0,0,1-.552.552H15.283a.554.554,0,0,1-.552-.552ZM8.838,12.337a.554.554,0,0,1,.552-.552h1.841a.554.554,0,0,1,.552.552v1.841a.554.554,0,0,1-.552.552H9.391a.554.554,0,0,1-.552-.552Zm0,5.892a.554.554,0,0,1,.552-.552h1.841a.554.554,0,0,1,.552.552V20.07a.554.554,0,0,1-.552.552H9.391a.554.554,0,0,1-.552-.552ZM2.946,12.337a.554.554,0,0,1,.552-.552H5.34a.554.554,0,0,1,.552.552v1.841a.554.554,0,0,1-.552.552H3.5a.554.554,0,0,1-.552-.552Zm0,5.892a.554.554,0,0,1,.552-.552H5.34a.554.554,0,0,1,.552.552V20.07a.554.554,0,0,1-.552.552H3.5a.554.554,0,0,1-.552-.552ZM18.413,2.946H16.2V.737A.739.739,0,0,0,15.467,0H13.994a.739.739,0,0,0-.737.737v2.21H7.365V.737A.739.739,0,0,0,6.629,0H5.156a.739.739,0,0,0-.737.737v2.21H2.21A2.21,2.21,0,0,0,0,5.156v2.21H20.622V5.156A2.21,2.21,0,0,0,18.413,2.946Z"
                            fill="#104b71" />
                    </svg>
                    <div class="content">
                        <div class="wrap-error"></div>
                        <input type="text" name="ovabrw_pickup_date"
                            class="ovabrw_datetimepicker ovabrw_start_date <?php echo esc_attr($pickup_date_required); ?>"
                            value="<?php echo esc_attr($pickup_date); ?>"
                            placeholder="<?php echo esc_attr(ovabrw_get_date_format()); ?>"
                            data-hour_default="<?php echo esc_attr($hour_default); ?>"
                            data-time_step="<?php echo esc_attr($time_step); ?>"
                            data-dateformat="<?php echo esc_attr($dateformat); ?>"
                            data-firstday="<?php echo esc_attr($first_day); ?>"
                            timepicker="<?php echo esc_attr($timepicker); ?>" data-error=".ovabrw_pickup_date"
                            autocomplete="off" onfocus="blur();" />
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($show_tag_product == 'yes'): ?>
                <?php
                $terms = get_terms(
                    array(
                        'taxonomy' => 'product_tag',
                        'hide_empty' => false,
                    )
                );

                $options = '<option value="">' . esc_html__('Select a feature', 'hello-elementor-child') . '</option>';

                foreach ($terms as $term) {
                    $options .= '<option value="' . $term->name . '">' . $term->name . "</option>";
                }
                ?>

                <div class="s_field">
                    <svg id="Capa_1" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 31.71 30.68"
                        width="31.71" height="30.68">
                        <path
                            d="m24.44,19.94l1.66,9.94c.09.54-.49.99-.99.72l-8.91-4.68c-.18-.09-.45-.09-.63,0l-8.95,4.63c-.49.27-1.08-.18-.99-.72l1.66-9.9c.04-.22-.04-.45-.18-.58L.19,12.34c-.36-.36-.18-1.08.36-1.12l9.67-1.48c.22-.04.4-.18.49-.36L15.21.37c.27-.49.94-.49,1.21,0l4.45,9c.09.18.27.36.49.36l9.76,1.48c.54.09.76.76.36,1.12l-6.88,7.02c-.13.13-.22.36-.18.58Z"
                            style="fill: #124b71;" />
                        <path
                            d="m22.82,14.86l-7.38,7.33c-.27.27-.67.27-.99,0l-4.27-4.27c-.27-.27-.27-.67,0-.99l1.21-1.21c.27-.27.67-.27.99,0l2.11,2.11c.27.27.67.27.99,0l5.13-5.17c.27-.27.67-.27.99,0l1.21,1.21c.22.31.22.72,0,.99Z"
                            style="fill: #fff;" />
                    </svg>
                    <div class="content">
                        <div class="wrap-error"></div>

                        <select class="<?php echo esc_attr($tag_product_required); ?>" name="ovabrw_tag_product">
                        <?php echo $options; ?>
                        </select>   

                    </div>
                </div>
            <?php endif; ?>
            <?php
            $list_taxonomy = array_key_exists('taxonomy_list_all', $taxonomy_list_wrap) ? $taxonomy_list_wrap['taxonomy_list_all'] : [];
            $arr_require_taxonomy_key = array_key_exists('taxonomy_require', $taxonomy_list_wrap) ? $taxonomy_list_wrap['taxonomy_require'] : [];
            $arr_hide_taxonomy_key = array_key_exists('taxonomy_hide', $taxonomy_list_wrap) ? $taxonomy_list_wrap['taxonomy_hide'] : [];
            $list_get_taxonomy = array_key_exists('taxonomy_get', $taxonomy_list_wrap) ? $taxonomy_list_wrap['taxonomy_get'] : [];

            if (!empty($list_taxonomy) && $show_tax == 'yes') {
                foreach ($list_taxonomy as $taxonomy) {

                    $required = '';
                    if (is_array($arr_require_taxonomy_key) && array_key_exists($taxonomy['slug'], $arr_require_taxonomy_key) && $arr_require_taxonomy_key[$taxonomy['slug']] == 'require') {
                        $required = 'required';
                    } else {
                        $required = '';
                    }

                    if (is_array($arr_hide_taxonomy_key) && array_key_exists($taxonomy['slug'], $arr_hide_taxonomy_key) && $arr_hide_taxonomy_key[$taxonomy['slug']] == 'hide') {
                        //
                    } else { ?>
                        <div class="s_field s_field_cus_tax <?php echo esc_attr($column . ' ' . $taxonomy['slug']); ?>">
                            <div class="content">
                                <label>
                                    <?php echo esc_html($taxonomy['name']); ?>
                                </label>
                                <div class="wrap-error"></div>
                                <?php echo OVABRW_Get_Data::instance()->get_html_dropdown_taxonomies($list_get_taxonomy[$taxonomy['slug']], $required, '', $taxonomy['slug'], $taxonomy['name']); ?>
                            </div>
                        </div>
                    <?php }
                }
            }
            ?>
            <input type="hidden" name="timepicker" value="<?php echo esc_attr($timepicker); ?>">
            <input type="hidden" name="order" value="<?php echo esc_attr($order); ?>">
            <input type="hidden" name="orderby" value="<?php echo esc_attr($orderby); ?>">
        </div>
        <div class="s_submit">
            <button class="ovabrw_btn_submit" type="submit">
                <?php esc_html_e('Search', 'ova-brw'); ?>
            </button>
        </div>
        <input type="hidden" name="ovabrw_search_product" value="ovabrw_search_product">
        <input type="hidden" name="ovabrw_search" value="search_item">
        <input type="hidden" name="post_type" value="product">
        <?php if (defined('ICL_LANGUAGE_CODE')): ?>
            <input type="hidden" name="lang" value="<?php echo esc_attr(ICL_LANGUAGE_CODE); ?>">
        <?php endif; ?>
    </form>
</div>