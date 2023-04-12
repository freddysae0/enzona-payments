<?php
require_once(plugin_dir_path(__FILE__) . 'configPage.php');
/**
 * Plugin Name: Enzona Payments for WooCommerce
 * Plugin URI: https://freddyjsa.com/enzona-payments
 * Description: Este plugin añade enzona como metodo de pago a tu tienda WooCommerce
 * Version: 1.0.0
 * Author: Freddy Javier Saez Avila
 * Author URI: https://freddyjsa.com/
 */

// Aquí va el código de tu plugin
if (in_array('woocommerce/woocommerce.php', get_option('active_plugins'))) {

    if (!class_exists('WC_Discounts_Woo')) {

        class WC_Discounts_Woo
        {

            public function __construct()
            {
            }
        }
    }
}
// Agrega un menú de configuración para el plugin
function enzona_payments_menu()
{
    add_menu_page(
        'Enzona Payments',
        'Enzona Payments',
        'manage_options',
        'mi-plugin-configuracion',
        'config_page',
        'dashicons-admin-plugins',
        99
    );
}
add_action('admin_menu', 'enzona_payments_menu');