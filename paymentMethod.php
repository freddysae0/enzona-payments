<?php
use daxslab\enzona\payment\api\PermiteCrearUnPagoApi;
use daxslab\enzona\payment\model\Payload;
use daxslab\enzona\payment\model\PaymentsAmount;
use daxslab\enzona\payment\model\PaymentsAmountDetails;
use daxslab\enzona\payment\model\PaymentsItems;
use daxslab\enzona\payment\ObjectSerializer;

function init_enzona_class()
{

    class Enzona_Payment extends WC_Payment_Gateway
    {
        public function __construct()
        {
            $this->id = "enzona_gateway";
            $this->icon = "https://www.enzona.net/images/favicon.png";
            $this->has_fields = false;
            $this->method_title = "Enzona";
            $this->method_description = "Obtén pagos mediante Enzona, plataforma de pagos en Cuba";

            $this->init_form_fields();
            $this->init_settings();
            $this->title = "Enzona";

            add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
        }
        public function get_buyer_id($order)
        {
            // Aquí implementa la lógica necesaria para obtener el ID del comprador
            // por ejemplo, podrías obtener el ID a partir del correo electrónico del comprador
            $buyer_id = $order->get_billing_email(); // ID del comprador es el correo electrónico
            return $buyer_id;
        }
        public function init_form_fields()
        {
            $this->form_fields = array(
                'enabled' => array(
                    'title' => __('Habilitar/Inhabilitar', 'woocommerce'),
                    'type' => 'checkbox',
                    'label' => __('Habilitar Enzona', 'woocommerce'),
                    'default' => 'no'
                ),
                'title' => array(
                    'title' => __('Título', 'woocommerce'),
                    'type' => 'text',
                    'description' => __('Este es el título que el usuario verá durante el proceso de pago', 'woocommerce'),
                    'default' => __('Enzona', 'woocommerce'),
                    'desc_tip' => true,
                ),
                'description' => array(
                    'title' => __('Descripción', 'woocommerce'),
                    'type' => 'textarea',
                    'description' => __('Esta es la descripción que el usuario verá durante el proceso de pago', 'woocommerce'),
                    'default' => __('Paga con Enzona, plataforma de pagos en Cuba', 'woocommerce'),
                ),
                'access_token' => array(
                    'title' => __('Access Token', 'woocommerce'),
                    'type' => 'text',
                    'description' => __('Introduce la clave API proporcionada por Enzona', 'woocommerce'),
                    'default' => '',
                    'desc_tip' => true,
                ),
                'merchant_uuid' => array(
                    'title' => __('Merchant UUID', 'woocommerce'),
                    'type' => 'text',
                    'description' => __('Introduce el secreto API proporcionado por Enzona', 'woocommerce'),
                    'default' => '',
                    'desc_tip' => true,
                ),

            );
        }
        function process_payment($order_id)
        {

            $is_localhost = false;
            if ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1') {
                $is_localhost = true;
            }

            global $woocommerce;
            #$order = new WC_Order($order_id);
            $order = wc_get_order($order_id);
            $items = array();
            $myItems = null;
            $it = new PaymentsItems;
            if ($order) {

                $myItems = $order->get_items(); // Obtiene los productos del pedido
                foreach ($myItems as $item) {
                    $product_name = $item->get_name(); // Obtiene el nombre del producto
                    $product_quantity = $item->get_quantity(); // Obtiene la cantidad del producto
                    $product_price = $item->get_total() / $product_quantity; // Obtiene el precio total del producto

                    #$product_description = $item->get_description(); // Obtiene el precio total del producto
                    $it->setName($product_name);
                    $it->setDescription("");
                    $it->setQuantity($product_quantity);
                    $it->setPrice(number_format($product_price, 2, '.', ''));

                    $it->setTax("0.00");
                    $items[] = $it;
                    // Realiza las operaciones necesarias con los productos del pedido
                }


                $config = daxslab\enzona\payment\Configuration::getDefaultConfiguration()->setAccessToken($this->get_option("access_token"));
                $apiInstance = new daxslab\enzona\payment\Api\PermiteCrearUnPagoApi(
                        // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
                        // This is optional, `GuzzleHttp\Client` will be used as default.
                    new GuzzleHttp\Client(),
                    $config
                );


                try {
                    // Inicializar sesión cURL
                    $amount = new PaymentsAmount;
                    $amountDetails = new PaymentsAmountDetails;
                    $amountDetails->setDiscount("0.00");
                    $amountDetails->setShipping("0.00");
                    $amountDetails->setTax("0.00");
                    $amountDetails->setTip("0.00");
                    $total = $order->get_total();
                    $amount->setTotal(strval($total));
                    $amount->setDetails($amountDetails);
                    $payload = new Payload;
                    $payload->setAmount($amount);
                    #$payload->setBuyerIdentityCode($this->get_buyer_id($order));
                    $payload->setBuyerIdentityCode("");
                    if ($is_localhost)
                        $payload->setCancelUrl("https://nofuncionaenlocalhost.cu/cancel");
                    else
                        $payload->setCancelUrl(get_site_url());

                    $payload->setCurrency("CUP");
                    $payload->setDescription("Pago con Enzona");
                    $payload->setInvoiceNumber($order_id);
                    $payload->setItems($items);
                    $payload->setMerchantOpId("000000000003");

                    $payload->setMerchant_uuid($this->get_option('merchant_uuid'));
                    $payload->setTerminalId(12121);


                    // Obtener la URL base de la página de finalización de compra
                    $return_url = get_site_url();


                    if ($is_localhost)
                        $payload->setReturnUrl("https://nofuncionaenlocalhost.cu/return");
                    else
                        $payload->setReturnUrl($return_url);


                    $result = $apiInstance->paymentsPostWithHttpInfo($payload);
                    $href = $result[0]['links'][0]->href;
                    $truuid = $result[0]['transaction_uuid'];

                    $meta_id = update_post_meta($order_id, 'transaction_uuid', $truuid);

                    $order->update_status('pending', 'Transaction uuid: ' . $truuid);

                    // Remove cart
                    return array(
                        // Return thankyou redirect
                        'result' => 'success',
                        'redirect' => $href
                    );


                } catch (Exception $e) {
                    echo 'Exception when calling ListaDeDevolucionesDeUnPagoApi->paymentsTransactionUuidRefundsGet: ', $e->getMessage(), PHP_EOL;
                }

            } else {

                // El pedido no existe
            }

        }

    }
}


add_action('init', 'handle_payment_callback');
function handle_payment_callback()
{
    if (isset($_GET['transaction_uuid'])) {



        $available_gateways = WC()->payment_gateways()->get_available_payment_gateways();
        $enzona_instance = null;
        // Buscar tu método de pago personalizado por su ID (reemplaza 'your_gateway_id' con el ID de tu método de pago)
        if (isset($available_gateways['enzona_gateway'])) {
            $enzona_instance = $available_gateways['enzona_gateway'];

        }
        // Procesar la respuesta de la pasarela de pagos
        $config = daxslab\enzona\payment\Configuration::getDefaultConfiguration()->setAccessToken($enzona_instance->get_option("access_token"));
        $apiInstance = new daxslab\enzona\payment\Api\ObtieneLosDetallesDeUnPagoRealizadoApi(
                // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
                // This is optional, `GuzzleHttp\Client` will be used as default.
            new GuzzleHttp\Client(),
            $config
        );
        $result = $apiInstance->paymentsTransactionUuidGet($_GET['transaction_uuid']);
        $status = $result['status_code'];
        $order_id = intval($result['invoice_number']);
        $order = wc_get_order($order_id);
        $thank_you_page_url = $order->get_checkout_order_received_url();
        global $woocommerce;

        if ($status == 1116) {
            $order->update_status('completed', 'Transaction uuid: ' . $_GET['transaction_uuid']);
            $woocommerce->cart->empty_cart();

            wp_redirect($thank_you_page_url);
        }
        if ($status == 1112) {
            $order->update_status('failed', 'Transaction uuid: ' . $_GET['transaction_uuid']);
        }

        // Verificar la firma, el estado del pago, etc.
        // Actualizar el estado del pedido en WooCommerce
    }
}











add_action('plugins_loaded', 'init_enzona_class');




function add_enzona_class($methods)
{
    $methods[] = 'Enzona_Payment';
    return $methods;
}

add_filter('woocommerce_payment_gateways', 'add_enzona_class');


?>