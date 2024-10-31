<?php
add_action('woocommerce_product_options_general_product_data', 'reskillify_woocommerce_product_custom_fields');
if ( !function_exists( 'reskillify_woocommerce_product_custom_fields' ) ) {
    function reskillify_woocommerce_product_custom_fields()
    {
        global $woocommerce, $post;
        echo '<div class="product_custom_field">';
        woocommerce_wp_text_input(
            array(
                'id' => '_reskillify_product_id',
                'placeholder' => __('reskillify.com product ID', 'reskillify'),
                'label' => __('Product ID on reskillify.com', 'reskillify'),
                'type' => 'number'
            )
        );
        echo '</div>';
    }
}

add_action('woocommerce_process_product_meta', 'reskillify_woocommerce_product_custom_fields_save');
if ( !function_exists( 'reskillify_woocommerce_product_custom_fields_save' ) ) {
    function reskillify_woocommerce_product_custom_fields_save($post_id)
    {
        if(isset($_POST['_reskillify_product_id'])){
            $reskillify_product_id = sanitize_text_field($_POST['_reskillify_product_id']);
            update_post_meta($post_id, '_reskillify_product_id', $reskillify_product_id);
        }
    }
}