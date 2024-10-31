<?php
add_action("woocommerce_payment_complete", "reskillify_handle_order_items", 10, 1);
add_action("woocommerce_order_status_completed", "reskillify_handle_order_items", 10, 1);
if ( !function_exists( 'reskillify_handle_order_items' ) ) {
	function reskillify_handle_order_items ($order_id) {
		$options = get_option( 'reskillify_settings' );
		if(isset($options['api_key']) && isset($options['secret_key'])){
			$order = wc_get_order($order_id);
			$request_body = [];
			foreach ($order->get_items() as $item_key => $item ){
				$product_id = $item->get_product_id();
			    $course_id = get_post_meta($product_id, '_reskillify_product_id', true);
			    if($course_id)
			    	$request_body["courses[".$course_id."]"] = sanitize_text_field($course_id);
			}
			if(sizeof($request_body) > 0){
				$order_data = $order->get_data();
				$url = 'https://reskillify.com/IntegrationAPI';
				$request_body['api_key'] = sanitize_text_field($options['api_key']);
				$request_body['secret_key'] = sanitize_text_field($options['secret_key']);
				$request_body['first_name'] = sanitize_text_field($order_data['billing']['first_name']);
				$request_body['last_name'] = sanitize_text_field($order_data['billing']['last_name']);
				$request_body['email'] = sanitize_text_field($order_data['billing']['email']);
				wp_remote_post( $url, array(
				    'redirection' => 1,
				    'body'        => $request_body
				));				
			}
		}
	}
}