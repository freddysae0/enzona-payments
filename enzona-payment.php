<?php


/**
 * Plugin Name: Enzona para WooCommerce
 * Plugin URI: https://freddyjsa.com/enzona-payments
 * Description: Este plugin añade enzona como metodo de pago a tu tienda WooCommerce
 * Version: 1.0.0
 * Author: Freddy Javier Saez Avila
 * Author URI: https://freddyjsa.com/
 *
 * WC requires at least: 7.0.0
 * WC tested up to: 7.5.1
 */


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';
$is_localhost = false;
if ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1') {
    $is_localhost = true;
}

require_once(ABSPATH . 'wp-admin/includes/plugin.php');
function noWooCommerce()
{
    ?>
    <div class="error">
        <p>
            <?php _e('Este plugin requiere que WooCommerce esté instalado y activado.', 'mi-textdomain'); ?>
        </p>
    </div>
    <?php
}
// Test to see if WooCommerce is active (including network activated).

$debug = true;


if (
    is_plugin_active('woocommerce/woocommerce.php') && ($is_localhost == false ||
        $debug == true)
) {
    // Aquí va el código del plugin

    require_once(plugin_dir_path(__FILE__) . 'configPage.php');
    require_once(plugin_dir_path(__FILE__) . 'paymentMethod.php');





    // ...
} else {
    add_action('admin_notices', 'mi_aviso');
    function mi_aviso()
    {
        ?>
        <div class="error">

            <p>
                <?php
                $is_localhost = false;
                if ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1') {
                    $is_localhost = true;
                }

                if ($is_localhost)
                    echo "El plugin Enzona para WooCommerce no funciona en localhost";
                else
                    _e('El plugin Enzona para WooCommerce requiere que WooCommerce esté instalado y activado en el sistema.', 'mi-textdomain'); ?>
            </p>
        </div>
        <?php
    }
}