<?php

require_once(plugin_dir_path(__FILE__) . 'vendor/autoload.php');

// Genera la página de configuración del plugin




function examplePay()
{
    // Configure OAuth2 access token for authorization: default
    $config = daxslab\enzona\payment\Configuration::getDefaultConfiguration()->setAccessToken(get_option("enzona_configuracion_merchantUUID", ""));

    $apiInstance = new daxslab\enzona\payment\Api\ListaDeDevolucionesDeUnPagoApi(
            // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
            // This is optional, `GuzzleHttp\Client` will be used as default.
        new GuzzleHttp\Client(),
        $config
    );
    $transaction_uuid = "transaction_uuid_example"; // string | 
    $limit = "limit_example"; // string | 
    $offset = "offset_example"; // string | 
    $status_filter = "status_filter_example"; // string | 
    $start_date_filter = "start_date_filter_example"; // string | 
    $end_date_filter = "end_date_filter_example"; // string | 
    $order_filter = "order_filter_example"; // string | 

    try {
        // Inicializar sesión cURL

        $result = $apiInstance->paymentsTransactionUuidRefundsGet($transaction_uuid, $limit, $offset, $status_filter, $start_date_filter, $end_date_filter, $order_filter);
        print_r($result);
    } catch (Exception $e) {
        echo 'Exception when calling ListaDeDevolucionesDeUnPagoApi->paymentsTransactionUuidRefundsGet: ', $e->getMessage(), PHP_EOL;
    }


}
function config_page()
{

    // Verifica que el usuario tenga permisos suficientes para acceder a la página
    if (!current_user_can('manage_options')) {
        wp_die(__('No tienes permisos suficientes para acceder a esta página.'));
    }

    // Verifica si se ha enviado el formulario de configuración
    if (isset($_POST['enzona_configuracion_enviar'])) {
        // Guarda las variables de configuración
        update_option('enzona_configuracion_accessToken', $_POST['enzona_configuracion_accessToken']);
        update_option('enzona_configuracion_merchantUUID', $_POST['enzona_configuracion_merchantUUID']);

        // Muestra un mensaje de éxito
        echo '<div class="notice notice-success is-dismissible"><p>La configuración ha sido guardada.</p></div>';




    }
    ?>
    <div class="wrap">
        <h1>Enzona Payments for WooCommerce
        </h1>
        <form method="post">
            <div>

                <p>Introduzca el merchant uuid de su negocio, después que haya creado su comercio en <a
                        href="http://enzona.net" target="_blank" rel="noopener noreferrer">Enzona</a> y este haya sido
                    previamente aprovado<br /> lo debe
                    encontrar en los <a href="http://enzona.net" target="_blank" rel="noopener noreferrer">detalles de su
                        comercio</a> </p>


                <img style="max-width: 500px" src="http://freddyjsa.com/wp-content/uploads/2023/04/enzona.jpg" />
            </div>
            <table class="form-table">
                <tbody>

                    <div>
                        <h3 for="enzona_configuracion_variable_1">Access Token
                        </h3>
                        <input type="text" name="enzona_configuracion_accessToken" id="accesstoken"
                            value="<?php echo esc_attr(get_option('enzona_configuracion_accessToken')); ?>"
                            class="regular-text">


                        <h3 for="enzona_configuracion_variable_2">Merchant UUID
                        </h3>
                        <input type="text" name="enzona_configuracion_merchantUUID" id="merchantuuid"
                            value="<?php echo esc_attr(get_option('enzona_configuracion_merchantUUID')); ?>"
                            class="regular-text">

                    </div>


                </tbody>
            </table>
            <?php wp_nonce_field('enzona_configuracion_guardar', 'enzona_configuracion_nonce'); ?>
            <p class="submit"><input type="submit" name="enzona_configuracion_enviar" id="enzona_configuracion_enviar"
                    class="button button-primary" value="Guardar cambios"></p>
        </form>
    </div>
    <?php
}