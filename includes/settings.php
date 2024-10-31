<?php
add_action( 'init', 'reskillify_load_textdomain' );
if ( !function_exists( 'reskillify_load_textdomain' ) ) {
    function reskillify_load_textdomain() {
      load_plugin_textdomain( 'reskillify', false, plugin_dir_path( 'reskillify.com/languages' ) ); 
    }
}

add_action( 'admin_menu', 'reskillify_add_admin_menu' );
add_action( 'admin_init', 'reskillify_settings_init' );

if ( !function_exists( 'reskillify_add_admin_menu' ) ) {
    function reskillify_add_admin_menu(  ) { 
        add_menu_page( 'Reskillify.com', 'Reskillify.com', 'manage_options', 'reskillify.com', 'reskillify_options_page', plugins_url( RESKILLIFY_PLUGIN_NAME.'/admin/images/logo.png') );
    }
}

if ( !function_exists( 'reskillify_settings_init' ) ) {
    function reskillify_settings_init(  ) { 
        register_setting( 'reskillify_settings', 'reskillify_settings' );
        add_settings_section(
            'reskillify_reskillify_settings_section', 
            '', 
            'reskillify_settings_section_callback', 
            'reskillify_settings'
        );
        add_settings_field( 
            'reskillify_text_field_0', 
            __( 'API Key', 'reskillify' ), 
            'reskillify_api_key_render', 
            'reskillify_settings', 
            'reskillify_reskillify_settings_section' 
        );
        add_settings_field( 
            'reskillify_text_field_1', 
            __( 'Secret Key', 'reskillify' ), 
            'reskillify_secret_key_render', 
            'reskillify_settings', 
            'reskillify_reskillify_settings_section' 
        );
    }
}

if ( !function_exists( 'reskillify_api_key_render' ) ) {
    function reskillify_api_key_render(  ) { 
        $options = get_option( 'reskillify_settings' );
        ?>
        <input type='text' name='reskillify_settings[api_key]' value='<?php echo isset($options['api_key']) ? sanitize_text_field($options['api_key']) : ''; ?>' class="regular-text">
        <?php
    }
}

if ( !function_exists( 'reskillify_secret_key_render' ) ) {
    function reskillify_secret_key_render(  ) { 
        $options = get_option( 'reskillify_settings' );
        ?>
        <input type='text' name='reskillify_settings[secret_key]' value='<?php echo isset($options['secret_key']) ? sanitize_text_field($options['secret_key']) : ''; ?>' class="regular-text">
        <?php

    }
}

if ( !function_exists( 'reskillify_settings_section_callback' ) ) {
    function reskillify_settings_section_callback(  ) { 
        echo __( 'API Key Settings', 'reskillify' );
    }
}

if ( !function_exists( 'reskillify_options_page' ) ) {
    function reskillify_options_page(  ) { 
            ?>
            <form action='options.php' method='post'>
                <h2><?php echo __("Reskillify.com", "reskillify"); ?></h2>
                <?php
                settings_fields( 'reskillify_settings' );
                do_settings_sections( 'reskillify_settings' );
                submit_button();
                ?>
            </form>
            <?php
    }
}

